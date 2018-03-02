<?php

namespace Uol\BoaCompra\Unit\Domain\BoaCompra;

use PHPUnit_Framework_TestCase;
use Uol\BoaCompra\Domain\BoaCompra;

class BoaCompraTest extends PHPUnit_Framework_TestCase
{
    public function testCreateAndGetters()
    {
        $obj = new BoaCompra(
            self::getData('store_id'),
            self::getData('secret_key'),
            self::getData('return'),
            self::getData('notify_url'),
            new \Uol\BoaCompra\Domain\Core\Language(self::getData('language')),
            self::getData('country_payment'),
            new \Uol\BoaCompra\Domain\Core\Currency(self::getData('currency_code')),
            self::getData('project_id'),
            self::getData('test_mode'),
            self::getData('mobile')
        );
        $this->assertNotNull($obj);
        $this->assertEquals(self::getData('store_id'), $obj->getStoreId());
        $this->assertEquals(self::getData('secret_key'), $obj->getSecretKey());
        $this->assertEquals(self::getData('return'), $obj->getReturn());
        $this->assertEquals(self::getData('notify_url'), $obj->getNotifyUrl());
        $this->assertEquals(self::getData('language'), $obj->getLanguage()->getIsoCode());
        $this->assertEquals(self::getData('country_payment'), $obj->getCountryPayment());
        $this->assertEquals(self::getData('currency_code'), $obj->getCurrencyCode()->getIsoCode());
        $this->assertEquals(self::getData('project_id'), $obj->getProjectId());
        $this->assertEquals(self::getData('test_mode'), $obj->getTestMode());
        $this->assertEquals(self::getData('mobile'), $obj->getMobile());
        self::assertNotNull($obj);
        self::assertInstanceOf(BoaCompra::class, $obj);

    }

    public static function getData($key)
    {
        $data = array(
            'store_id'        => 1,
            'secret_key'      => 1234567890,
            'return'          => 'http://example.com/return',
            'notify_url'      => 'http://example.com/notify',
            'language'        => 'pt_BR',
            'country_payment' => 'BR',
            'currency_code'   => 'BRL',
            'project_id'      => 1,
            'test_mode'       => 1,
            'mobile'          => 1,
        );

        return $data[$key];
    }
}
