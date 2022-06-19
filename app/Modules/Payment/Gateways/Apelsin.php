<?php

namespace App\Modules\Payment\Gateways;

use App\Services\OrderService;
use Payment;

class Apelsin extends Gateway
{
    protected $view = 'payment::apelsin-form';

    public function process()
    {
        $orderService = new OrderService();
        $request = json_decode(file_get_contents('php://input'));

        if (!isset($request->transactionId)) {
            $order = (new OrderService)->getOrder($request->order_id);

            if (!$order || $order->amount != $request->amount || $order->status != OrderService::STATUS_NOT_PAID) {
                return $this->response(false);
            }

            return $this->response();
        }

        Payment::makeTransaction([
            'gateway_transaction_id' => $request->transactionId,
            'gateway_time' => time(),
            'gateway_time_datetime' => date('Y-m-d H:i:s'),
            'created' => date('Y-m-d H:i:s'),
            'amount' => $request->amount,
            'state' => 2,
            'order_id' => $request->order_id,
            'gateway' => 'apelsin'
        ]);

        $order = $orderService->getOrder($request->order_id);

        if (!$order || $order->amount != $request->amount || $order->status != OrderService::STATUS_NOT_PAID) {
            return $this->response(false);
        }

        $orderService->markOrderAsPaid($order->id);

        return $this->response();
    }

    protected function response($status = true)
    {
        return json_encode(['status' => $status]);
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

        return view($this->view, compact('amount', 'config', 'order', 'orderId'));
    }
}