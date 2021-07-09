<?php

namespace Paytic\Payments\Simplify\Tests;

use ByTIC\Payments\Tests\Fixtures\Records\PaymentMethods\PaymentMethod;
use ByTIC\Payments\Tests\Gateways\GatewayTest as AbstractGatewayTest;
use Paytic\Payments\Simplify\Gateway;
use Paytic\Payments\Simplify\Tests\Fixtures\Records\SimplifyMethodData;

/**
 * Class GatewayTest
 * @package Paytic\Payments\Simplify\Tests
 */
class GatewayTest extends AbstractGatewayTest
{
    public function testIsActive()
    {
        $gateway = new Gateway();
        self::assertFalse($gateway->isActive());

        $gateway->setMerchant('999999');
        self::assertFalse($gateway->isActive());

        $gateway->setMerchantName('999999');
        self::assertFalse($gateway->isActive());

        $gateway->setApiPassword('999999');
        self::assertTrue($gateway->isActive());
    }

    public function test_gateway_from_method()
    {
        self::assertTrue($this->gateway->isActive());
    }


    protected function setUp(): void
    {
        parent::setUp();

        /** @var PaymentMethod $paymentMethod */
        $paymentMethod = $this->purchase->getPaymentMethod();
        $paymentMethod->options = trim(SimplifyMethodData::getMethodOptions());

        $this->purchase->created = date('Y-m-d H:i:s');

        $this->gateway = $paymentMethod->getType()->getGateway();
    }
}
