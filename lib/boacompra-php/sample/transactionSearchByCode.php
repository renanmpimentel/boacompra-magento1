<?php

require_once 'bootstrap.php';
$request = new \Uol\BoaCompra\Domain\Transaction\Request($boaCompra);
$request->setCode('90197040');
$transactionSearch = new \Uol\BoaCompra\Application\Transaction\SearchByCode($request);
$result = [];
try {
    $result = $transactionSearch->execute();
} catch (Exception $exception) {
    $result = $exception;
}
echo '<pre>';
print_r($result);
