<?php

namespace App\Services;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Omnipay;

class OmnipayService
{
    protected $gateway = '';

    public function __construct(string $paymentMethod = 'PayPal_Express')
    {
        if (is_null($paymentMethod) || $paymentMethod == 'PayPal_Express') {
            $this->gateway = Omnipay::create('PayPal_Express');
            $this->gateway->setUsername(config('services.paypal.username'));
            $this->gateway->setPassword(config('services.paypal.password'));
            $this->gateway->setSignature(config('services.paypal.signature'));
            $this->gateway->setTestMode(config('services.paypal.sandbox'));
        }
        return $this->gateway;
    }

    public function purchase(array $params): ResponseInterface
    {
        return $this->gateway->purchase($params)->send();
    }

    public function refund(array $params): ResponseInterface
    {
        return $this->gateway->refund($params)->send();
    }

    public function complete(array $params):ResponseInterface
    {
        return $this->gateway->completePurchase($params)->send();
    }

    public function getCancelUrl($orderId): string
    {
        return route('payment.cancelled', $orderId);
    }

    public function getReturnUrl($orderId): string
    {
        return route('payment.completed', $orderId);
    }

    public function getNotifyUrl($orderId): string
    {
        $env = config('services.paypal.sandbox') ? 'sandbox' : 'live';
        return route('payment.webhook.ipn', [$orderId, $env]);
    }
}
