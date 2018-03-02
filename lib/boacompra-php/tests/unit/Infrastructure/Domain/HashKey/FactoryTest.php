<?php

namespace Uol\BoaCompra\Infrastructure\Domain\HashKey;

use Uol\BoaCompra\Domain\BoaCompra;
use Uol\BoaCompra\Domain\Customer;
use Uol\BoaCompra\Domain\Order;
use Uol\BoaCompra\Domain\Payment;
use Uol\BoaCompra\Infrastructure\Domain\HashKey;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    private $boaCompra;
    private $customer;
    private $order;
    private $payment;

    public function __construct()
    {
        parent::__construct();
        $this->boaCompra = new BoaCompra(
            1,
            1234567890,
            'http://example.com/notify',
            'http://example.com/notify',
            new \Uol\BoaCompra\Domain\Core\Language('pt_BR'),
            'BR',
            new \Uol\BoaCompra\Domain\Core\Currency('BRL'),
            '1',
            '1',
            '0'
        );
        $this->customer = new Customer('test@example.com');
        $this->order = new Order(
            '1',
            'Testing',
            '1000'
        );
        $this->payment = new Payment($this->customer, $this->order);
    }

    public function testCreate()
    {
        $hashKey = Factory::make($this->boaCompra, $this->payment);
        self::assertNotNull($hashKey);
        self::assertInstanceOf(HashKey::class, $hashKey);
    }
}
