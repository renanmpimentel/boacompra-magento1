<?php

namespace Uol\BoaCompra\Infrastructure\Services;

/**
 * Class Http
 * @package Uol\BoaCompra\Infrastructure\Services
 */
class Http
{
    /**
     * @var resource
     */
    private $handler;

    /**
     * Http constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->handler = curl_init($url);

        return $this->handler;
    }

    /**
     * @param $name
     * @param $value
     * @return bool
     */
    public function setOptions($name, $value)
    {
        return curl_setopt($this->handler, $name, $value);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function execute()
    {
        $response = curl_exec($this->handler);
        if (curl_errno($this->handler)) {
            throw new \Exception(curl_error($this->handler));
        }

        return $response;
    }

    /**
     * @return string
     */
    public function error()
    {
        return curl_error($this->handler);
    }

    /**
     * @return mixed
     */
    public function info()
    {
        return curl_getinfo($this->handler);
    }

    /**
     *
     */
    public function close()
    {
        return curl_close($this->handler);
    }
}
