<?php

namespace Uol\BoaCompra\Domain\Core;

/**
 * Class Currency
 * @package Uol\BoaCompra\Domain\Core
 */
class Currency
{
    /**
     * @var
     */
    private $currency;

    /**
     * Currency constructor.
     * @param $currency
     */
    public function __construct($currency)
    {
        $this->currency = $currency;

        try {
            $this->isValid();
        } catch (\Exception $exception) {
            echo 'Caught exception: ' . $exception->getMessage();
        }
    }

    /**
     * @return bool
     * @throws \Exception
     */
    protected function isValid()
    {
        if (!array_key_exists($this->currency, $this->getAll())) {
            throw new \Exception("Must be a valid currency, see \Uol\BoaCompra\Domain\Core\Currency");
        }

        return true;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return array(
            'ARS' => 'Peso (Argentina)',
            'BRL' => 'Real (Brazil)',
            'CLP' => 'Peso (Chile)',
            'COP' => 'Peso (Colombia)',
            'CRC' => 'Colón (Costa Rica)',
            'EUR' => 'Euro',
            'MXN' => 'Peso (Mexico)',
            'PEN' => 'Nuevos Soles (Peru)',
            'TRY' => 'Liras (Turkey)',
            'USD' => 'Dolar',
        );
    }

    /**
     * @return mixed
     */
    public function getIsoCode()
    {
        return $this->currency;
    }
}
