<?php

namespace Paytic\Payments\Simplify\Message;

use ByTIC\Payments\Gateways\Providers\AbstractGateway\Message\Traits\HasGatewayRequestTrait;
use ByTIC\Payments\Gateways\Providers\AbstractGateway\Message\Traits\HasModelRequest;
use Nip\Records\Record;
use Paytic\Omnipay\Simplify\Message\CompletePurchaseRequest as AbstractCompletePurchaseRequest;
use Paytic\Payments\Simplify\Gateway;

/**
 * Class PurchaseResponse
 * @package Paytic\Payments\Simplify\Message
 *
 * @method CompletePurchaseResponse send
 */
class CompletePurchaseRequest extends AbstractCompletePurchaseRequest
{
    use HasGatewayRequestTrait;
    use HasModelRequest;

    /**
     * @inheritdoc
     */
    public function getData()
    {
        $return = parent::getData();
        // Add model only if has data
        if (count($return) && $this->validateModel()) {
            $return['model'] = $this->getModel();
        }

        return $return;
    }

    /**
     * @inheritDoc
     */
    public function getModelIdFromRequest()
    {
        $modelId = $this->httpRequest->query->get($this->getModelManager()->getPrimaryKey());

        return $modelId;
    }


    /**
     * @return bool|mixed
     * @throws \Exception
     */
    protected function parseNotification()
    {
        if ($this->validateModel()) {
            /** @var Record $model */
            $model = $this->getModel();
            $this->updateParametersFromPurchase($model);
        }

        $this->setOrderId($model->getPrimaryKey());

        return parent::parseNotification();
    }

    /**
     * @param Gateway $modelGateway
     */
    protected function updateParametersFromGateway($modelGateway)
    {
        $this->setMerchant($modelGateway->getMerchant());
        $this->setMerchantName($modelGateway->getMerchantName());
        $this->setApiPassword($modelGateway->getApiPassword());
        $this->setApiHost($modelGateway->getApiHost());
    }
}
