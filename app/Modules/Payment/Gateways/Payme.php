<?php

namespace App\Modules\Payment\Gateways;

use App\Modules\Payment\Gateways\Paycom\Application;
use App\Services\OrderService;
use Illuminate\Http\Request;

class Payme extends Gateway
{
    protected $view = 'payment::payme-form';

    public function process(Request $request)
    {
        $application = new Application;

        $application->run();
    }

    /**
     * @param int $orderId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showPaymentForm(int $orderId)
    {
        $order = (new OrderService)->getOrder($orderId);
        $config = $this->config;
        $amount = $order->amount * 100;

        return view($this->view, compact('amount', 'config', 'orderId'));
    }
}