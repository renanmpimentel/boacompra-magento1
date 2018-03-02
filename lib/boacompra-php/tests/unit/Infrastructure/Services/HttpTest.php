<?php
/**
 * Created by PhpStorm.
 * User: thiago.medeiros
 * Date: 25/10/2017
 * Time: 11:33
 */

namespace Uol\BoaCompra\Infrastructure\Services;

class HttpTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $http = new Http('htttp://github.com');
        self::assertNotNull($http);
    }
}
