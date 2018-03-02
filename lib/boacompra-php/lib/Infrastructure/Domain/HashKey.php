<?php

namespace Uol\BoaCompra\Infrastructure\Domain;

/**
 * Class HashKey
 * @package Uol\BoaCompra\Infrastructure\Domain
 */
class HashKey
{
    /**
     * @var
     */
    private $hash_key;

    /**
     * HashKey constructor.
     *
     * @param $hash_key
     */
    public function __construct($hash_key)
    {
        $this->hash_key = $hash_key;
    }

    /**
     * @return mixed
     */
    public function getHashKey()
    {
        return $this->hash_key;
    }
}
