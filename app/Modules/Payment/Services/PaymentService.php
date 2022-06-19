<?php

namespace App\Modules\Payment\Services;

use App\Modules\Payment\Gateways\Gateway;
use App\Modules\Payment\Gateways\Paycom\Format;
use App\Modules\Payment\Models\Transaction;
use Config;

class PaymentService
{
    protected $gateways;

    /**
     * PaymentService constructor.
     */
    public function __construct()
    {
        $this->gateways = collect();
        foreach (Config::get('gateways') as $name => $config) {
            $provider = 'App\\Modules\\Payment\\Gateways\\'.$config['provider'];

            $this->gateways->push(new $provider($config, $name));
        }
    }

    /**
     * @param             $id
     * @param string|null $gateway
     * @return Transaction|null
     */
    public function findTransaction($id, string $gateway = null)
    {
        if (is_array($id)) {
            if (isset($id['id'])) {
                return Transaction::where('gateway_transaction_id', $id['id'])
                                          ->where('gateway', $gateway)
                                          ->first();
            } elseif (isset($id['account'])) {
                return Transaction::where('order_id', $id['account']['order_id'])
                                          ->where('gateway', $gateway)
                                          ->first();
            } else {
                return null;
            }
        }

        $query = Transaction::where('id', $id);

        if ($gateway) {
            $query->where('gateway', $gateway);
        }

        return $query->first();
    }

    /**
     * @param string $slug
     * @return Gateway
     */
    public function getGateway(string $slug): Gateway
    {
        return $this->gateways->filter(function ($v) use ($slug) {
            return $v->getSlug() === $slug;
        })->first();
    }

    /**
     * @param string $paymentType
     * @param int    $orderId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makeGateway(string $paymentType, int $orderId)
    {
        $validatedGateways = $this->gateways->filter(function ($v) use ($paymentType) {
            return $v->getSlug() === $paymentType;
        });

        if ($validatedGateways->isEmpty()) {
            return redirect()->route('checkoutSuccess', ['id' => $orderId]);
        }

        return $validatedGateways->first()->showPaymentForm($orderId);
    }

    /**
     * @param array $data
     * @return Transaction
     */
    public function makeTransaction(array $data): Transaction
    {
        return Transaction::create($data);
    }

    /**
     * Проверка срока годности транзакции.
     *
     * @return bool
     */
    public function isExpired($transaction)
    {
        return $transaction->state == $transaction::STATE_CREATED && Format::datetime2timestamp($transaction->created_at) - time() > $transaction::TIMEOUT;
    }

    /**
     * @param $transaction
     * @return bool
     */
    public function allowCancel($transaction)
    {
        return true;
        //        return $transaction->state == $transaction::STATE_COMPLETED ? false : true;
    }

    /**
     * @param      $transaction
     * @param null $reason
     */
    public function cancel($transaction, $reason = null)
    {
        $transaction->state = (int)$transaction->state === 1 ? $transaction::STATE_CANCELLED : $transaction::STATE_CANCELLED_AFTER_COMPLETE;
        $transaction->reason = $reason;
        $transaction->canceled = date('Y-m-d H:i:s');
        $transaction->cancel_time = Format::timestamp(true);

        $transaction->save();
    }

    /**
     * @param $transaction
     * @return bool
     */
    public function isPaid($transaction)
    {
        return $transaction->state == $transaction::STATE_COMPLETED;
    }

    /**
     * @param $transaction
     * @return bool
     */
    public function isCancelled($transaction)
    {
        return $transaction->state < 0;
    }

    /**
     * @return Transaction
     */
    public function transaction()
    {
        return new Transaction;
    }

    public function confirmTransactionByGatewayId($id)
    {
        $this->transaction()->where('gateway_transaction_id', $id)->update([
            'state' => 2
        ]);
    }
}