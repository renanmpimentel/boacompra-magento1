<?php

require_once 'bootstrap.php';
$request = new \Uol\BoaCompra\Domain\Transaction\Request($boaCompra);
$request->setQueryParams('2017-09-01T14:00:00.000-03:00', '2017-09-30T14:00:00.000-03:00');
$transactionSearch = new \Uol\BoaCompra\Application\Transaction\Search($request);
$result = [];
try {
    $result = $transactionSearch->execute();
} catch (Exception $exception) {
    $result = $exception;
}
echo '<pre>';
print_r($result);
