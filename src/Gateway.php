<?php

namespace Paytic\Payments\Simplify;

use ByTIC\Payments\Gateways\Providers\AbstractGateway\Traits\GatewayTrait;
use ByTIC\Payments\Gateways\Providers\AbstractGateway\Traits\OverwriteCompletePurchaseTrait;
use Omnipay\Common\Message\RequestInterface;
use Paytic\Omnipay\Simplify\Gateway as AbstractGateway;
use Paytic\Payments\Simplify\Message\PurchaseRequest;

/**
 * Class Gateway
 * @package Paytic\Payments\Simplify
 *
 * @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
 */
class Gateway extends AbstractGateway
{
    use GatewayTrait;

    /**
     * @inheritdoc
     * @return PurchaseRequest
     */
    public function purchase(array $parameters = []): RequestInterface
    {
        return $this->createRequestWithInternalCheck('PurchaseRequest', $parameters);
    }

    /**
     * @inheritDoc
     */
    public function setApiHost($value)
    {
        if (empty($value)) {
            return;
        }
        return parent::setApiHost($value);
    }


    /**
     * @return bool
     */
    public function isActive()
    {
        if (
            strlen($this->getMerchant()) > 5
            && strlen($this->getMerchantName()) > 5
            && strlen($this->getApiPassword()) > 5
            && strlen($this->getApiHost()) > 5
        ) {
            return true;
        }

        return false;
    }
}
