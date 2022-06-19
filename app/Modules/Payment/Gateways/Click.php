<?php

namespace App\Modules\Payment\Gateways;

use App\Services\OrderService;
use Illuminate\Http\Request;
use Payment;

class Click extends Gateway
{
    protected $messages = array(
        0 => array("error" => 0, "error_note" => "success"),
        1 => array("error" => -1, "error_note" => "SIGN CHECK FAILED!"),
        2 => array("error" => -2, "error_note" => "Incorrect parameter amount"),
        3 => array("error" => -3, "error_note" => "Action not found"),
        4 => array('error' => -4, 'error_note' => 'Already paid'),
        5 => array('error' => -5, 'error_note' => 'Order does not exist'),
        6 => array('error' => -6, 'error_note' => 'Transaction does not exist'),
        7 => array('error' => -7, 'error_note' => 'Failed to update order'),
        8 => array('error' => -8, 'error_note' => 'Error in request from Click'),
        9 => array('error' => -9, 'error_note' => 'Transaction cancelled')
    );

    protected $orderService;

    protected $view = 'payment::click-form';

    /**
     * @param Request $request
     * @return string
     */
    public function complete(Request $request)
    {
        $orderService = new OrderService();

        $clickTransId = request('click_trans_id');
        $serviceId = request('service_id');
        $merchantTransId = request('merchant_trans_id');
        $merchantPrepareId = request('merchant_prepare_id');
        $amount = request('amount');
        $action = request('action');
        $signTime = request('sign_time');
        $signString = request('sign_string');
        $error = request('error');
        $errorNote = request('error_note');

        $transaction = Payment::findTransaction($merchantPrepareId, 'click');

        if (!$transaction) {
            return $this->response($this->messages[6]);
        }

        if (Payment::isPaid($transaction)) {
            return $this->response($this->messages[4]);
        }

        if (Payment::isCancelled($transaction)) {
            return $this->response($this->messages[9]);
        }

        $order = $this->getOrder($merchantTransId);

        if (!$order) {
            return $this->response($this->messages[5]);
        }

        if ($error < 0) {
            if (Payment::allowCancel($transaction)) {
                Payment::cancel($transaction, 2);
                $orderService->cancelOrder($order->id);

                return $this->response($this->messages[9]);
            } else {
                return $this->response($this->messages[4]);
            }
        }

        $signStringVerified = md5(
            $clickTransId.
            $serviceId.
            $this->config['secret-key'].
            $merchantTransId.
            $merchantPrepareId.
            $amount.
            $action.
            $signTime
        );

        if ($signString !== $signStringVerified) {
            return $this->response($this->messages[1]);
        }

        if (!in_array($action, array(0, 1))) {
            return $this->response($this->messages[3]);
        }

        // заглушка для теста
        if ($amount < 500 || $amount * 100 != $transaction->amount) {
            return $this->response($this->messages[2]);
        }

        $transaction->state = $transaction::STATE_COMPLETED;
        $transaction->performed = date('Y-m-d H:i:s');
        $transaction->save();

        $orderService->markOrderAsPaid($order->id);

        $return = array(
            'click_trans_id' => $clickTransId,
            'merchant_trans_id' => $merchantTransId,
            'merchant_confirm_id' => $transaction->id
        );

        $result = array_merge($this->messages[0], $return);

        return $this->response($result);
    }

    /**
     * @param        $clickTransId
     * @param        $serviceId
     * @param        $merchantTransId
     * @param        $action
     * @param        $amount
     * @param        $signTime
     * @param string $merchantPrepareId
     * @return string
     */
    protected function createSign($clickTransId, $serviceId, $merchantTransId, $action, $amount, $signTime, $merchantPrepareId = '')
    {
        return md5($clickTransId.
            $serviceId.
            $this->config['secret-key'].
            $merchantTransId.
            //$merchantPrepareId.
            ($action == 1 ? $merchantPrepareId : '').
            $amount.
            $action.
            $signTime);
    }

    /**
     * @param int $id
     * @return \App\Models\Order|null
     */
    protected function getOrder(int $id)
    {
        return (new OrderService)->getOrder($id);
    }

    /**
     * @param Request $request
     */
    public function prepare(Request $request)
    {
        $clickTransId = request('click_trans_id');
        $serviceId = request('service_id');
        $merchantTransId = request('merchant_trans_id');
        $amount = request('amount');
        $action = request('action');
        $signTime = request('sign_time');
        $signString = request('sign_string');

        $order = $this->getOrder((int)$merchantTransId);

        if (!$order) {
            return $this->response($this->messages[5]);
        }

        $transaction = Payment::makeTransaction([
            'gateway_transaction_id' => $clickTransId,
            'gateway_time' => strtotime($signTime),
            'gateway_time_datetime' => $signTime,
            'created' => date('Y-m-d H:i:s'),
            'amount' => $amount * 100,
            'state' => 1,
            'order_id' => $merchantTransId,
            'gateway' => 'click'
        ]);

        $signStringVerified = $this->createSign(
            $clickTransId,
            $serviceId,
            $merchantTransId,
            $action,
            $amount,
            $signTime,
            $transaction->id
        );

        if ($signString !== $signStringVerified) {
            return $this->response($this->messages[1]);
        }

        if (!in_array($action, array(0, 1))) {
            return $this->response($this->messages[3]);
        }

        // заглушка для теста
        if ($amount < 500) {
            return $this->response($this->messages[2]);
        }

        $return = [
            'click_trans_id' => $clickTransId,
            'merchant_trans_id' => $merchantTransId,
            'merchant_prepare_id' => $transaction->id
        ];

        $result = array_merge($this->messages[0], $return);

        return $this->response($result);
    }

    /**
     * @param $message
     * @return string
     */
    protected function response($message)
    {
        return response()->json($message);
    }

    /**
     * @param int $orderId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showPaymentForm(int $orderId)
    {
        $order = (new OrderService)->getOrder($orderId);
        $config = $this->config;
        $amount = $order->amount;
        $time = date('Y-m-d H:i:s');
        $string = md5($time.$this->config['secret-key'].$this->config['service-id'].$orderId.$amount);

        return view($this->view, compact('amount', 'config', 'orderId', 'string', 'time'));
    }
}