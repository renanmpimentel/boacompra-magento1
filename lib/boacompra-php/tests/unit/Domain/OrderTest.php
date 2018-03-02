<?php
/**
 * Created by PhpStorm.
 * User: thiago.medeiros
 * Date: 23/10/2017
 * Time: 16:59
 */

namespace Uol\BoaCompra\Domain;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateAndGetters()
    {
        $obj = new Order(
            self::getData('order_id'),
            self::getData('order_description'),
            self::getData('amount'),
            self::getData('metadata')
        );
        $this->assertNotNull($obj);
        $this->assertEquals(self::getData('order_id'), $obj->getOrderId());
        $this->assertEquals(self::getData('order_description'), $obj->getOrderDescription());
        $this->assertEquals(self::getData('amount'), $obj->getAmount());
        $this->assertEquals(self::getData('metadata'), $obj->getMetadata());
        self::assertNotNull($obj);
        self::assertInstanceOf(Order::class, $obj);
    }

    public static function getData($key)
    {
        $data = array(
            'order_id'          => '1',
            'order_description' => 'Testing',
            'amount'            => '1000',
            'metadata'          => json_encode(array('player-level' => 100, 'account-id' => 1, 'gifting' => false)),
        );

        return $data[$key];
    }
}
