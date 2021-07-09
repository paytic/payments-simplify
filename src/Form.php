<?php

namespace Paytic\Payments\Simplify;

use ByTIC\Payments\Gateways\Providers\AbstractGateway\Form as AbstractForm;

/**
 * Class Form
 * @package Paytic\Payments\Simplify
 */
class Form extends AbstractForm
{
    public function initElements()
    {
        $this->initElementSandbox();

        $this->addInput('merchant', 'Merchant');
        $this->addInput('merchant_name', 'Merchant Name');
        $this->addInput('apiPassword', 'Api Password');
        $this->addInput('apiHost', 'Api Host');
    }
}
