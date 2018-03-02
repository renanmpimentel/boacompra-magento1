<?php

namespace Uol\BoaCompra\Domain;

class PaymentTest extends \PHPUnit_Framework_TestCase
{
    private $customer;
    private $order;
    private $payment_id;
    private $payment_group;

    public function __construct()
    {
        parent::__construct();
        $this->customer = new Customer('teste@boacompra.com');
        $this->order = new Order(1, 'Testing', 1000);
        $this->payment_id = null;
        $this->payment_group = null;
    }

    public static function getData($key)
    {
        $data = array(
            'client_email'     => 'john@doe.com',
            'client_fisrtname' => 'John',
            'client_lastname'  => 'Doe',
            'client_telephone' => '+551134567890',
            'client_zip_code'  => '13000000',
            'client_street'    => '1',
            'client_suburb'    => 'Central',
            'client_number'    => '19',
            'client_city'      => 'Mos Eisley',
            'client_state'     => 'Tatooine',
            'client_country'   => 'Galaxy',
        );

        return $data[$key];
    }

    public function testCreateAndGetters()
    {
        $objCustomer = new Customer(
            self::getCustomerData('client_email'),
            self::getCustomerData('client_fisrtname'),
            self::getCustomerData('client_lastname'),
            self::getCustomerData('client_telephone'),
            self::getCustomerData('client_zip_code'),
            self::getCustomerData('client_street'),
            self::getCustomerData('client_suburb'),
            self::getCustomerData('client_number'),
            self::getCustomerData('client_city'),
            self::getCustomerData('client_state'),
            self::getCustomerData('client_country')
        );
        $objOrder = new Order(
            self::getOrderData('order_id'),
            self::getOrderData('order_description'),
            self::getOrderData('amount'),
            self::getOrderData('metadata')
        );
        $obj = new Payment($objCustomer, $objOrder);
        $this->assertNotNull($obj);
        self::assertInstanceOf(Customer::class, $obj->getCustomer());
        self::assertInstanceOf(Order::class, $obj->getOrder());
        self::assertInstanceOf(Payment::class, $obj);
    }

    public static function getCustomerData($key)
    {
        $data = array(
            'client_email'     => 'john@doe.com',
            'client_fisrtname' => 'John',
            'client_lastname'  => 'Doe',
            'client_telephone' => '+551134567890',
            'client_zip_code'  => '13000000',
            'client_street'    => '1',
            'client_suburb'    => 'Central',
            'client_number'    => '19',
            'client_city'      => 'Mos Eisley',
            'client_state'     => 'Tatooine',
            'client_country'   => 'Galaxy',
        );

        return $data[$key];
    }

    public static function getOrderData($key)
    {
        $data = array(
            'order_id'          => '1',
            'order_description' => 'Testing',
            'amount'            => '1000',
            'metadata'          => json_encode(array('player-level' => 100, 'account-id' => 1, 'gifting' => false)),
        );

        return $data[$key];
    }

    public function testGetPaymentId()
    {
        self::assertEquals(null, $this->payment_id);
    }

    public function testGetPaymentGroup()
    {
        self::assertEquals(null, $this->payment_id);
    }
}
