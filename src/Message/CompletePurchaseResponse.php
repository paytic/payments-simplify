<?php

namespace Paytic\Payments\Simplify\Message;

use ByTIC\Payments\Gateways\Providers\AbstractGateway\Message\Traits\HasModelProcessedResponse;
use Paytic\Omnipay\Simplify\Message\CompletePurchaseResponse as AbstractCompletePurchaseResponse;

/**
 * Class CompletePurchaseResponse
 * @package Paytic\Payments\Simplify\Message
 */
class CompletePurchaseResponse extends AbstractCompletePurchaseResponse
{
    use HasModelProcessedResponse;

    /**
     * @inheritDoc
     */
    public function isPending()
    {
        $model = $this->getModel();
        if ($model) {
            $status = $model->status;
            if (empty($status) or $status == 'pending') {
                return true;
            }
        }
        return parent::isPending();
    }

    /**
     * @inheritDoc
     */
    public function isCancelled()
    {
        $model = $this->getModel();
        if ($model) {
            if ($model->status == 'canceled') {
                return true;
            }
        }
        return parent::isCancelled();
    }

    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        $model = $this->getModel();
        if ($model) {
            if ($model->status == 'active') {
                return true;
            }
        }
        return parent::isSuccessful();
    }

    /**
     * @return bool
     */
    protected function canProcessModel()
    {
        return true;
    }
}
