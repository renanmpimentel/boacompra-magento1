<?php

namespace Uol\BoaCompra\Infrastructure\Domain\HashKey;

use Uol\BoaCompra\Domain\BoaCompra;
use Uol\BoaCompra\Domain\Payment;
use Uol\BoaCompra\Infrastructure\Domain\HashKey;

/**
 * Class Factory
 * @package Uol\BoaCompra\Infrastructure\Domain\HashKey
 */
class Factory
{
    /**
     * @param BoaCompra $boaCompra
     * @param Payment $payment
     * @return HashKey
     */
    public static function make(BoaCompra $boaCompra, Payment $payment)
    {
        return new HashKey(md5($boaCompra->getStoreId() . $boaCompra->getNotifyUrl() .
            $payment->getOrder()->getOrderId() . $payment->getOrder()->getAmount() . $boaCompra->getCurrencyCode()->getIsoCode() .
            $boaCompra->getSecretKey()));
    }
}
