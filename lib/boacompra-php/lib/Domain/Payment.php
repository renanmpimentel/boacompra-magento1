<?php

namespace Uol\BoaCompra\Domain;

class Payment
{
    private $customer;
    private $order;
    private $payment_id;
    private $payment_group;

    /**
     * Payment constructor.
     *
     * @param $customer
     * @param $order
     * @param $payment_id
     * @param $payment_group
     */
    public function __construct(Customer $customer, Order $order, $payment_id = null, $payment_group = null)
    {
        $this->customer = $customer;
        $this->order = $order;
        $this->payment_id = $payment_id;
        $this->payment_group = $payment_group;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return mixed
     */
    public function getPaymentId()
    {
        return $this->payment_id;
    }

    /**
     * @return mixed
     */
    public function getPaymentGroup()
    {
        return $this->payment_group;
    }
}