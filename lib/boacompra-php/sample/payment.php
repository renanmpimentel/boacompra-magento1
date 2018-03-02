<?php

$then = microtime();
require_once 'bootstrap.php';
$customer = new \Uol\BoaCompra\Domain\Customer('thiago.pixelab@gmail.com');
$order = new \Uol\BoaCompra\Domain\Order(1, 'Teste', '22.00');
$payment = new \Uol\BoaCompra\Domain\Payment($customer, $order);
$requestAPayment = new \Uol\BoaCompra\Application\Payment\RequestAPayment(
    new \Uol\BoaCompra\Domain\Payment\Request($boaCompra, $payment)
);
$requestAPayment->execute();
