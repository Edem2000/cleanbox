<?php

namespace App\Modules\Payment\Gateways;

use App\Services\OrderService;

class Paynet extends Gateway
{
    protected $view = 'payment::paynet-form';

    /**
     * @param int $orderId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showPaymentForm(int $orderId)
    {
        $order = (new OrderService)->getOrder($orderId);
        $config = $this->config;
        $amount = $order->amount;

        return view($this->view, compact('amount', 'config', 'orderId'));
    }
}