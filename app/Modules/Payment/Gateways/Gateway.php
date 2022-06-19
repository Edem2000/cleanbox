<?php

namespace App\Modules\Payment\Gateways;

use Arr;

class Gateway
{
    protected $slug;

    protected $config;

    /**
     * Gateway constructor.
     *
     * @param array $config
     * @param       $slug
     */
    public function __construct(array $config, $slug)
    {
        $this->slug = $slug;
        $this->config = Arr::except($config, ['provider']);
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param int $orderId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showPaymentForm(int $orderId)
    {
        $config = $this->config;

        return view($this->view, compact('config', 'orderId'));
    }
}