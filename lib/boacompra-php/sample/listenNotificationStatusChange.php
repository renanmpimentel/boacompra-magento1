<?php

require_once 'bootstrap.php';
$transactionSearch = new \Uol\BoaCompra\Application\Transaction\StatusChangeNotification($boaCompra);
$result = [];
try {
    $result = $transactionSearch->execute();
} catch (Exception $exception) {
    $result = $exception;
}
echo '<pre>';
print_r($result);
