<?php

namespace Paytic\Payments\Librapay;

use ByTIC\Payments\Gateways\Providers\AbstractGateway\Form as AbstractForm;

/**
 * Class Form
 * @package Paytic\Payments\Euplatesc
 */
class Form extends AbstractForm
{
    public function initElements()
    {
        $this->initElementSandbox();

        $this->addInput('merchant', 'Merchant');
        $this->addInput('apiPassword', 'Api Password');
        $this->addInput('apiHost', 'Api Host');
    }
}
