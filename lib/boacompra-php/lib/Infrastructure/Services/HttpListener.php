<?php

namespace Uol\BoaCompra\Infrastructure\Services;

/**
 * Class HttpListener
 * @package Uol\BoaCompra\Infrastructure\Services
 */
class HttpListener
{
    /**
     * @return bool
     */
    public static function hasPost()
    {
        if ($_POST) {
            return true;
        }

        return false;
    }
}
