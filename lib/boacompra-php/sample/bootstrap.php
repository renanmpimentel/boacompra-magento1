<?php

$composerAutoload = dirname(dirname(dirname(__DIR__))) . '/autoload.php';
if (!file_exists($composerAutoload)) {
    $composerAutoload = dirname(__DIR__) . '/vendor/autoload.php';
    if (!file_exists($composerAutoload)) {
        echo "Please read installation notes";
        exit(1);
    }
}
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once $composerAutoload;
$boaCompra = new \Uol\BoaCompra\Domain\BoaCompra(
    7,
    1234567890,
    'http://exemplo.com/return',
    'http://exemplo.com/notification',
    new \Uol\BoaCompra\Domain\Core\Language('pt_BR'),
    'BR',
    new \Uol\BoaCompra\Domain\Core\Currency('BRL'),
    1,
    0,
    0);
