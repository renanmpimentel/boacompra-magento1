<?php

namespace Uol\BoaCompra\Infrastructure\Domain;

class HashKeyTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $key = rand(1, 1000);
        $hashKey = new HashKey($key);
        self::assertTrue($key === $hashKey->getHashKey());
    }
}
