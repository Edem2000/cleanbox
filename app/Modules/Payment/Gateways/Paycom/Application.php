<?php

namespace App\Modules\Payment\Gateways\Paycom;

use App\Models\Order;
use App\Modules\Payment\Gateways\Paycom\Format;
use App\Services\OrderService;
use Config;
use Payment;

class Application
{
    public $config;
    public $request;
    public $response;
    public $merchant;

    /**
     * Application constructor.
     * @param array $config configuration array with <em>merchant_id</em>, <em>login</em>, <em>keyFile</em> keys.
     */
    public function __construct()
    {
        $this->config   = Config::get('gateways.payme');
        $this->request  = new Request();
        $this->response = new Response($this->request);
        $this->merchant = new Merchant($this->config);
    }

    /**
     * Authorizes session and handles requests.
     */
    public function run()
    {
        try {
            // authorize session
            $this->merchant->Authorize($this->request->id);

            // handle request
            switch ($this->request->method) {
                case 'CheckPerformTransaction':
                    $this->CheckPerformTransaction();
                    break;
                case 'CheckTransaction':
                    $this->CheckTransaction();
                    break;
                case 'CreateTransaction':
                    $this->CreateTransaction();
                    break;
                case 'PerformTransaction':
                    $this->PerformTransaction();
                    break;
                case 'CancelTransaction':
                    $this->CancelTransaction();
                    break;
                case 'ChangePassword':
                    $this->ChangePassword();
                    break;
                case 'GetStatement':
                    $this->GetStatement();
                    break;
                default:
                    $this->response->error(
                        PaycomException::ERROR_METHOD_NOT_FOUND,
                        'Method not found.',
                        $this->request->method
                    );
                    break;
            }
        } catch (PaycomException $exc) {
            $exc->send();
        }
    }

    private function CheckPerformTransaction()
    {
        $order = $this->findOrder($this->request->params['account']['order_id']);

        // validate parameters
        $this->validate($order, $this->request->params);

        // todo: Check is there another active or completed transaction for this order
        $transaction = Payment::findTransaction($this->request->params, 'payme');
        if ($transaction && ($transaction->state == $transaction::STATE_CREATED || $transaction->state == $transaction::STATE_COMPLETED)) {
            $this->response->error(
                PaycomException::ERROR_COULD_NOT_PERFORM,
                'There is other active/completed transaction for this order.'
            );
        }

        // if control is here, then we pass all validations and checks
        // send response, that order is ready to be paid.
        $this->response->send(['allow' => true]);
    }

    private function CheckTransaction()
    {
        // todo: Find transaction by id
        $transaction = Payment::findTransaction($this->request->params, 'payme');
        if (!$transaction) {
            $this->response->error(
                PaycomException::ERROR_TRANSACTION_NOT_FOUND,
                'Transaction not found.'
            );
        }

        // todo: Prepare and send found transaction
        $this->response->send([
            'create_time'  => (int)$transaction->create_time,
            'perform_time' => (int)$transaction->perform_time,
            'cancel_time'  => (int)$transaction->cancel_time,
            'transaction'  => "$transaction->id",
            'state'        => (int)$transaction->state,
            'reason'       => isset($transaction->reason) ? 1 * $transaction->reason : null,
        ]);
    }

    private function CreateTransaction()
    {
        $order = $this->findOrder($this->request->params['account']['order_id']);

        // validate parameters
        $this->validate($order, $this->request->params);

        // todo: Find transaction by id
        $transaction = Payment::findTransaction($this->request->params, 'payme');

        if ($transaction) {
            if ($transaction->state != $transaction::STATE_CREATED) { // validate transaction state
                $this->response->error(
                    PaycomException::ERROR_COULD_NOT_PERFORM,
                    'Transaction found, but is not active.'
                );
            } elseif (Payment::isExpired($transaction)) { // if transaction timed out, cancel it and send error
                Payment::cancel($transaction, $transaction::REASON_CANCELLED_BY_TIMEOUT);
                $this->response->error(
                    PaycomException::ERROR_COULD_NOT_PERFORM,
                    'Transaction is expired.'
                );
            } else { // if transaction found and active, send it as response
                $this->response->send([
                    'create_time' => (int)$transaction->create_time,
                    'transaction' => "$transaction->id",
                    'state'       => (int)$transaction->state,
                    'receivers'   => $transaction->receivers,
                ]);
            }
        } else { // transaction not found, create new one
            // todo: Check, is there any other transaction for this order/service
            $transaction = Payment::findTransaction(['account' => $this->request->params['account']], 'payme');
            if ($transaction) {
                if (($transaction->state == $transaction::STATE_CREATED || $transaction->state == $transaction::STATE_COMPLETED)
                    && $transaction->paycom_transaction_id !== $this->request->params['id']) {
                    $this->response->error(
                        PaycomException::ERROR_INVALID_ACCOUNT,
                        'There is other active/completed transaction for this order.'
                    );
                }
            }

            $transaction = Payment::transaction();
            // validate new transaction time
            if (Format::timestamp2milliseconds(1 * $this->request->params['time']) - Format::timestamp(true) >= $transaction::TIMEOUT) {
                $this->response->error(
                    PaycomException::ERROR_INVALID_ACCOUNT,
                    PaycomException::message(
                        'С даты создания транзакции прошло ' . $transaction::TIMEOUT . 'мс',
                        'Tranzaksiya yaratilgan sanadan ' . $transaction::TIMEOUT . 'ms o`tgan',
                        'Since create time of the transaction passed ' . $transaction::TIMEOUT . 'ms'
                    ),
                    'time'
                );
            }

            // create new transaction
            // keep create_time as timestamp, it is necessary in response
            $create_time                        = Format::timestamp(true);
            $transaction->gateway_transaction_id = $this->request->params['id'];
            $transaction->gateway_time           = (string)$this->request->params['time'];
            $transaction->gateway_time_datetime  = Format::timestamp2datetime($this->request->params['time']);
            $transaction->create_time           = $create_time; //Format::timestamp2datetime($create_time);
            $transaction->state                 = $transaction::STATE_CREATED;
            $transaction->amount                = $this->request->amount;
            $transaction->order_id              = $this->request->account('order_id');
            $transaction->gateway = 'payme';
            $transaction->save(); // after save $transaction->id will be populated with the newly created transaction's id.

            // send response
            $this->response->send([
                'create_time' => $create_time,
                'transaction' => "$transaction->id",
                'state'       => $transaction->state,
                'receivers'   => null,
            ]);
        }
    }

    private function PerformTransaction()
    {
        $orderService = new OrderService();
        $transaction = Payment::findTransaction($this->request->params, 'payme');

        // if transaction not found, send error
        if (!$transaction) {
            $this->response->error(PaycomException::ERROR_TRANSACTION_NOT_FOUND, 'Transaction not found.');
        }

        switch ($transaction->state) {
            case $transaction::STATE_CREATED: // handle active transaction
                if (Payment::isExpired($transaction)) { // if transaction is expired, then cancel it and send error
                    Payment::cancel($transaction, $transaction::REASON_CANCELLED_BY_TIMEOUT);
                    $this->response->error(
                        PaycomException::ERROR_COULD_NOT_PERFORM,
                        'Transaction is expired.'
                    );
                } else { // perform active transaction
                    // todo: Mark order/service as completed
                    $orderService->markOrderAsPaid($transaction->order_id);

                    // todo: Mark transaction as completed
                    $perform_time        = Format::timestamp(true);
                    $transaction->state        = $transaction::STATE_COMPLETED;
                    $transaction->perform_time = $perform_time;
                    $transaction->save();

                    $this->response->send([
                        'transaction'  => "$transaction->id",
                        'perform_time' => $perform_time,
                        'state'        => (int)$transaction->state,
                    ]);
                }
                break;

            case $transaction::STATE_COMPLETED: // handle complete transaction
                // todo: If transaction completed, just return it
                $this->response->send([
                    'transaction'  => "$transaction->id",
                    'perform_time' => (int)$transaction->perform_time,
                    'state'        => (int)$transaction->state,
                ]);
                break;

            default:
                // unknown situation
                $this->response->error(
                    PaycomException::ERROR_COULD_NOT_PERFORM,
                    'Could not perform this operation.'
                );
                break;
        }
    }

    private function CancelTransaction()
    {
        $orderService = new OrderService();
        $transaction = Payment::findTransaction($this->request->params, 'payme');

        // if transaction not found, send error
        if (!$transaction) {
            $this->response->error(PaycomException::ERROR_TRANSACTION_NOT_FOUND, 'Transaction not found.');
        }

        switch ($transaction->state) {
            // if already cancelled, just send it
            case $transaction::STATE_CANCELLED:
            case $transaction::STATE_CANCELLED_AFTER_COMPLETE:
                $this->response->send([
                    'transaction' => "$transaction->id",
                    'cancel_time' => (int)$transaction->cancel_time,
                    'state'       => (int)$transaction->state,
                ]);
                break;

            // cancel active transaction
            case $transaction::STATE_CREATED:
                // cancel transaction with given reason
                Payment::cancel($transaction, 1 * $this->request->params['reason']);
                // after $found->cancel(), cancel_time and state properties populated with data

                // change order state to cancelled
                $orderService->cancelOrder($transaction->order_id);

                // send response
                $this->response->send([
                    'transaction' => "$transaction->id",
                    'cancel_time' => (int)$transaction->cancel_time,
                    'state'       => (int)$transaction->state,
                ]);
                break;

            case $transaction::STATE_COMPLETED:
                // find order and check, whether cancelling is possible this order
                $order = $orderService->getOrder($transaction->order_id);
                if (Payment::allowCancel($transaction)) {
                    // cancel and change state to cancelled
                    Payment::cancel($transaction, 1 * $this->request->params['reason']);
                    // after $found->cancel(), cancel_time and state properties populated with data

                    $orderService->cancelOrder($order->id);

                    // send response
                    $this->response->send([
                        'transaction' => "$transaction->id",
                        'cancel_time' => (int)$transaction->cancel_time,
                        'state'       => (int)$transaction->state,
                    ]);
                } else {
                    // todo: If cancelling after performing transaction is not possible, then return error -31007
                    $this->response->error(
                        PaycomException::ERROR_COULD_NOT_CANCEL,
                        'Could not cancel transaction. Order is delivered/Service is completed.'
                    );
                }
                break;
        }
    }

    private function ChangePassword()
    {
        // validate, password is specified, otherwise send error
        if (!isset($this->request->params['password']) || !trim($this->request->params['password'])) {
            $this->response->error(PaycomException::ERROR_INVALID_ACCOUNT, 'New password not specified.', 'password');
        }

        // if current password specified as new, then send error
        if ($this->merchant->config['secret-key'] == $this->request->params['password']) {
            $this->response->error(PaycomException::ERROR_INSUFFICIENT_PRIVILEGE, 'Insufficient privilege. Incorrect new password.');
        }

        // todo: Implement saving password into data store or file
        // example implementation, that saves new password into file specified in the configuration
        if (isset($this->config['keyFile']) && (!file_put_contents($this->config['keyFile'], $this->request->params['password']))) {
            $this->response->error(PaycomException::ERROR_INTERNAL_SYSTEM, 'Internal System Error.');
        }

        // if control is here, then password is saved into data store
        // send success response
        $this->response->send(['success' => true]);
    }

    private function GetStatement()
    {
        // validate 'from'
        if (!isset($this->request->params['from'])) {
            $this->response->error(PaycomException::ERROR_INVALID_ACCOUNT, 'Incorrect period.', 'from');
        }

        // validate 'to'
        if (!isset($this->request->params['to'])) {
            $this->response->error(PaycomException::ERROR_INVALID_ACCOUNT, 'Incorrect period.', 'to');
        }

        // validate period
        if (1 * $this->request->params['from'] >= 1 * $this->request->params['to']) {
            $this->response->error(PaycomException::ERROR_INVALID_ACCOUNT, 'Incorrect period. (from >= to)', 'from');
        }

        // get list of transactions for specified period
        $transaction  = new Transaction();
        $transactions = $transaction->report($this->request->params['from'], $this->request->params['to']);

        // send results back
        $this->response->send(['transactions' => $transactions]);
    }

    /**
     * @param $id
     * @return \App\Models\Order|null
     */
    protected function findOrder($id)
    {
        return (new OrderService)->getOrder($id);
    }

    /**
     * @param $order
     * @param $params
     * @return bool
     * @throws PaycomException
     */
    protected function validate($order, $params)
    {
        $orderService = new OrderService();

        if (!$order) {
            throw new PaycomException(
                $this->request->id,
                PaycomException::message(
                    'Неверный ID пользвоателя/номер счета.',
                    'Неверный ID пользвоателя/номер счета.',
                    'Incorrect user ID/order code.'
                ),
                PaycomException::ERROR_INVALID_ACCOUNT,
                'order_id'
            );
        }

        if ($orderService->isOrderPaid($order->id) || $orderService->isOrderCanceled($order->id)) {
            throw new PaycomException(
                $this->request->id,
                'Order state is invalid.',
                PaycomException::ERROR_COULD_NOT_PERFORM
            );
        }

        if (isset($params['amount']) && (!is_numeric($params['amount']) || ($order->amount * 100) != ($params['amount'] * 1))) {
            throw new PaycomException(
                $this->request->id,
                'Incorrect amount.',
                PaycomException::ERROR_INVALID_AMOUNT
            );
        }

        return true;
    }
}
