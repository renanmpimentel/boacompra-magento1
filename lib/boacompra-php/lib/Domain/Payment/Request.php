<?php

namespace Uol\BoaCompra\Domain\Payment;

use Uol\BoaCompra\Domain\BoaCompra;
use Uol\BoaCompra\Domain\Payment;
use Uol\BoaCompra\Infrastructure\Domain\HashKey\Factory as HashKeyFactory;

/**
 * Class Request
 * @package Uol\BoaCompra\Domain\Payment
 */
class Request
{
    /**
     * @var
     */
    private $paymentRequest;
    /**
     * @var BoaCompra
     */
    private $boaCompra;
    /**
     * @var Payment
     */
    private $payment;
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
     * @var
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
     * @var
     */
    private $order_id;
    /**
     * @var
     */
    private $order_description;
    /**
     * @var
     */
    private $amount;
    /**
     * @var
     */
    private $metadata;
    /**
     * @var
     */
    private $payment_id;
    /**
     * @var
     */
    private $payment_group;
    /**
     * @var
     */
    private $client_email;
    /**
     * @var
     */
    private $client_name;
    /**
     * @var
     */
    private $client_telephone;
    /**
     * @var
     */
    private $client_zip_code;
    /**
     * @var
     */
    private $client_street;
    /**
     * @var
     */
    private $client_suburb;
    /**
     * @var
     */
    private $client_number;
    /**
     * @var
     */
    private $client_city;
    /**
     * @var
     */
    private $client_state;
    /**
     * @var
     */
    private $client_country;
    /**
     * @var
     */
    private $hash_key;

    /**
     * Request constructor.
     *
     * @param $boaCompra
     * @param $payment
     */
    public function __construct(BoaCompra $boaCompra, Payment $payment)
    {
        $this->boaCompra = $boaCompra;
        $this->payment = $payment;
    }

    /**
     * @return \stdClass
     */
    public function make()
    {
        $this->paymentRequest = new \stdClass();
        $this->paymentRequest->store_id = $this->boaCompra->getStoreId();
        $this->paymentRequest->secret_key = $this->boaCompra->getSecretKey();
        $this->paymentRequest->return = $this->boaCompra->getReturn();
        $this->paymentRequest->notify_url = $this->boaCompra->getNotifyUrl();
        $this->paymentRequest->language = $this->boaCompra->getLanguage()->getIsoCode();
        $this->paymentRequest->country_payment = $this->boaCompra->getCountryPayment();
        $this->paymentRequest->currency_code = $this->boaCompra->getCurrencyCode()->getIsoCode();
        $this->paymentRequest->project_id = $this->boaCompra->getProjectId();
        $this->paymentRequest->test_mode = $this->boaCompra->getTestMode();
        $this->paymentRequest->mobile = $this->boaCompra->getMobile();
        $this->paymentRequest->order_id = $this->payment->getOrder()->getOrderId();
        $this->paymentRequest->order_description = $this->payment->getOrder()->getOrderDescription();
        $this->paymentRequest->amount = $this->payment->getOrder()->getAmount();
        $this->paymentRequest->metadata = $this->payment->getOrder()->getMetadata();
        if ($this->payment->getPaymentId()) {
            $this->paymentRequest->payment_id = $this->payment->getPaymentId();
        }
        if ($this->payment->getPaymentGroup()) {
            $this->paymentRequest->payment_group = $this->payment->getPaymentGroup();
        }
        $this->paymentRequest->client_email = $this->payment->getCustomer()->getClientEmail();
        $this->paymentRequest->client_name = $this->payment->getCustomer()->getClientFisrtname() . ' ' . $this->payment->getCustomer()->getClientLastname();
        $this->paymentRequest->client_telephone = $this->payment->getCustomer()->getClientTelephone();
        $this->paymentRequest->client_zip_code = $this->payment->getCustomer()->getClientZipCode();
        $this->paymentRequest->client_street = $this->payment->getCustomer()->getClientZipCode();
        $this->paymentRequest->client_suburb = $this->payment->getCustomer()->getClientSuburb();
        $this->paymentRequest->client_number = $this->payment->getCustomer()->getClientNumber();
        $this->paymentRequest->client_city = $this->payment->getCustomer()->getClientCity();
        $this->paymentRequest->client_state = $this->payment->getCustomer()->getClientState();
        $this->paymentRequest->client_country = $this->payment->getCustomer()->getClientCountry();
        $this->paymentRequest->hash_key = HashKeyFactory::make($this->boaCompra, $this->payment)->getHashKey();

        return $this->paymentRequest;
    }
}



























