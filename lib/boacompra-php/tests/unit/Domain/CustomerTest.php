<?php
/**
 * Created by PhpStorm.
 * User: thiago.medeiros
 * Date: 23/10/2017
 * Time: 16:59
 */

namespace Uol\BoaCompra\Domain;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateAndGetters()
    {
        $obj = new Customer(
            self::getData('client_email'),
            self::getData('client_fisrtname'),
            self::getData('client_lastname'),
            self::getData('client_telephone'),
            self::getData('client_zip_code'),
            self::getData('client_street'),
            self::getData('client_suburb'),
            self::getData('client_number'),
            self::getData('client_city'),
            self::getData('client_state'),
            self::getData('client_country')
        );
        $this->assertNotNull($obj);
        $this->assertEquals(self::getData('client_email'), $obj->getClientEmail());
        $this->assertEquals(self::getData('client_fisrtname'), $obj->getClientFisrtname());
        $this->assertEquals(self::getData('client_lastname'), $obj->getClientLastname());
        $this->assertEquals(self::getData('client_telephone'), $obj->getClientTelephone());
        $this->assertEquals(self::getData('client_zip_code'), $obj->getClientZipCode());
        $this->assertEquals(self::getData('client_street'), $obj->getClientStreet());
        $this->assertEquals(self::getData('client_suburb'), $obj->getClientSuburb());
        $this->assertEquals(self::getData('client_number'), $obj->getClientNumber());
        $this->assertEquals(self::getData('client_city'), $obj->getClientCity());
        $this->assertEquals(self::getData('client_state'), $obj->getClientState());
        $this->assertEquals(self::getData('client_country'), $obj->getClientCountry());
        self::assertNotNull($obj);
        self::assertInstanceOf(Customer::class, $obj);
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
}
