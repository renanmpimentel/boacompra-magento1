<?php

namespace Uol\BoaCompra\Domain\Transaction;

/**
 * Class Status
 * @package Uol\BoaCompra\Domain\Transaction
 */
class Status
{
    /**
     *
     */
    const CANCELLED = 'CANCELLED';
    /**
     *
     */
    const COMPLETE = 'COMPLETE';
    /**
     *
     */
    const CHARGEBACK = 'CHARGEBACK';
    /**
     *
     */
    const EXPIRED = 'EXPIRED';
    /**
     *
     */
    const NOTPAID = 'NOT-PAID';
    /**
     *
     */
    const PENDING = 'PENDING';
    /**
     *
     */
    const REFUNDED = 'REFUNDED';
    /**
     *
     */
    const UNDERREVIEW = 'UNDER-REVIEW';
}
