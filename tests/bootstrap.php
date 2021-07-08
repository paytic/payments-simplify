<?php

$configData = [
    'gateways' => [
        Paytic\Payments\Simplify\Gateway::class
    ]
];

require __DIR__ . '/../vendor/bytic/payments-tests/src/boostrap/bootstrap.php';
