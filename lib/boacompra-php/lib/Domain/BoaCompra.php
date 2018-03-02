<?php

namespace Uol\BoaCompra\Domain;

use Uol\BoaCompra\Domain\Core\Currency;
use Uol\BoaCompra\Domain\Core\Language;

/**
 * Class BoaCompra
 *
 * @package Uol\BoaCompra\Domain
 */
class BoaCompra
{
    /**
     * @var
     */
    private $store_id;
    /**
     * @var
     */
    private $secret_key;
    /**
     * @var
     */
    private $return;
    /**
     * @var
     */
    private $notify_url;
    /**
     * @var Language
     */
    private $language;
    /**
     * @var
     */
    private $country_payment;
    /**
     * @var
     */
    private $currency_code;
    /**
     * @var
     */
    private $project_id;
    /**
     * @var
     */
    private $test_mode;
    /**
     * @var
     */
    private $mobile;

    /**
     * BoaCompra constructor.
     *
     * @param          $store_id
     * @param          $secret_key
     * @param          $return
     * @param          $notify_url
     * @param Language $language
     * @param          $country_payment
     * @param Currency $currency_code
     * @param          $project_id
     * @param          $test_mode
     * @param          $mobile
     */
    public function __construct(
        $store_id,
        $secret_key,
        $return,
        $notify_url,
        Language $language,
        $country_payment,
        Currency $currency_code,
        $project_id,
        $test_mode,
        $mobile
    )
    {
        $this->store_id = $store_id;
        $this->secret_key = $secret_key;
        $this->return = $return;
        $this->notify_url = $notify_url;
        $this->language = $language;
        $this->country_payment = $country_payment;
        $this->currency_code = $currency_code;
        $this->project_id = $project_id;
        $this->test_mode = $test_mode;
        $this->mobile = $mobile;

        try {
            $this->isValid();
        } catch (\Exception $exception) {
            echo 'Caught exception: ' . $exception->getMessage();
            return;
        }
    }

    /**
     * @return bool
     * @throws \Exception
     */
    protected function isValid()
    {
        if ($this->getMobile() === 1 && $this->getCountryPayment() !== 'BR') {
            throw new \Exception('Mobile flag only works with country_payment = "BR"');
        }
        return true;
    }

    /**
     * @return int
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @return mixed
     */
    public function getCountryPayment()
    {
        return $this->country_payment;
    }

    /**
     * @return mixed
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->secret_key;
    }

    /**
     * @return mixed
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->notify_url;
    }

    /**
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return Currency
     */
    public function getCurrencyCode()
    {
        return $this->currency_code;
    }

    /**
     * @return int
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * @return int
     */
    public function getTestMode()
    {
        return $this->test_mode;
    }
}
