<?php

namespace Uol\BoaCompra\Domain;

class Order
{
    private $order_id;
    private $order_description;
    private $amount;
    private $metadata;

    /**
     * Order constructor.
     *
     * @param $order_id
     * @param $order_description
     * @param $amount
     * @param $metadata
     */
    public function __construct($order_id, $order_description, $amount, $metadata = null)
    {
        $this->order_id = $order_id;
        $this->order_description = $order_description;
        $this->amount = $amount;
        $this->metadata = $metadata;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @return mixed
     */
    public function getOrderDescription()
    {
        return $this->order_description;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getMetadata()
    {
        return $this->metadata;
    }
}