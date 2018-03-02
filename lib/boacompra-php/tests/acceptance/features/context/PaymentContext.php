<?php

namespace Uol\BoaCompra\Acceptance;

use Behat\Behat\Context\Context;
use Uol\BoaCompra\Application\Payment\RequestAPayment;
use Uol\BoaCompra\Domain\BoaCompra;
use Uol\BoaCompra\Domain\Customer;
use Uol\BoaCompra\Domain\Order;
use Uol\BoaCompra\Domain\Payment;

class PaymentContext implements Context
{
    private $customer;
    private $order;
    private $payment;
    private $request;
    private $boaCompra;

    /**
     * PaymentContext constructor.
     */
    public function __construct()
    {
        $this->boaCompra = new BoaCompra(
            7,
            1234567890,
            'http://localhsot/return',
            'http://localhsot/notification',
            new \Uol\BoaCompra\Domain\Core\Language('pt_BR'),
            'BR',
            new \Uol\BoaCompra\Domain\Core\Currency('BRL'),
            1,
            1,
            0);
        $this->customer = new Customer('teste@boacompra.com.br', 'John', 'Doe');
        $this->order = new Order(1, 'Testing', 1000);
        $this->payment = new Payment($this->customer, $this->order);
        $this->request = new Payment\Request($this->boaCompra, $this->payment);
    }

    /**
     * @Given /^a customer with email (.*)$/
     */
    public function aCustomerWithEmail($email)
    {
        $this->customer = new Customer($email);
    }

    /**
     * @Then /^should return a customer$/
     */
    public function shouldReturnACustomer()
    {
        if (!$this->customer instanceof Customer) {
            throw new \Exception('Must be a instance of \Uol\BoaCompra\Domain\Customer');
        }
    }

    /**
     * @Given /^a order with (.*), (.*), (.*)$/
     */
    public function aOrderWith($id, $description, $amount)
    {
        return new Order($id, $description, $amount);
    }

    /**
     * @Given /^and amount must be grater than (\d+)$/
     */
    public function andAmountMustBeGraterThan($arg1)
    {
        if ($this->order->getAmount() <= $arg1) {
            throw new \Exception('Amount must be grater than 100');
        }
    }

    /**
     * @Then /^should return a order$/
     */
    public function shouldReturnAOrder()
    {
        if (!$this->order instanceof Order) {
            throw new \Exception('Must be a instance of \Uol\BoaCompra\Domain\Order');
        }
    }

    /**
     * @Given /^a payment with order and customer$/
     */
    public function aPaymentWithOrderAndCustomer()
    {
        return $this->payment = new Payment($this->customer, $this->order);
    }

    /**
     * @Then /^should return a payment$/
     */
    public function shouldReturnAPayment()
    {
        if (!$this->payment instanceof Payment) {
            throw new \Exception('Must be a instance of \Uol\BoaCompra\Domain\Payment');
        }
    }

    /**
     * @Given /^a payment request$/
     */
    public function aPaymentRequest()
    {
        if (!$this->boaCompra instanceof BoaCompra) {
            throw new \Exception('Must be a instance of \Uol\BoaCompra\Domain\BoaCompra');
        }
        if (!$this->payment instanceof Payment) {
            throw new \Exception('Must be a instance of \Uol\BoaCompra\Domain\Payment');
        }

        return $this->paymentRequest = new Payment\Request($this->boaCompra, $this->payment);
    }

    /**
     * @Given /^i get data$/
     */
    public function iGetData()
    {
        $this->request->make();
    }

    /**
     * @Then /^i submit a request payment$/
     */
    public function iSubmitARequestPayment()
    {
        return new RequestAPayment($this->request);
    }
}