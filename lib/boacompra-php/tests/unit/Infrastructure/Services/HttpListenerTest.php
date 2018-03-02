<?php
/**
 * Created by PhpStorm.
 * User: thiago.medeiros
 * Date: 25/10/2017
 * Time: 11:33
 */

namespace Uol\BoaCompra\Infrastructure\Services;

class HttpListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testReturn()
    {
        $httpListener = HttpListener::hasPost();
        self::assertNotNull($httpListener);
        self::assertTrue(is_bool($httpListener));
    }
}
