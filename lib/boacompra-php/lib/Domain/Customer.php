<?php

namespace Uol\BoaCompra\Domain;

class Customer
{
    private $client_email;
    private $client_fisrtname;
    private $client_lastname;
    private $client_telephone;
    private $client_zip_code;
    private $client_street;
    private $client_suburb;
    private $client_number;
    private $client_city;
    private $client_state;
    private $client_country;

    /**
     * Customer constructor.
     *
     * @param      $client_email
     * @param      $client_fisrtname
     * @param      $client_lastname
     * @param null $client_telephone
     * @param null $client_zip_code
     * @param null $client_street
     * @param null $client_suburb
     * @param null $client_number
     * @param null $client_city
     * @param null $client_state
     * @param null $client_country
     */
    public function __construct(
        $client_email,
        $client_fisrtname = null,
        $client_lastname = null,
        $client_telephone = null,
        $client_zip_code = null,
        $client_street = null,
        $client_suburb = null,
        $client_number = null,
        $client_city = null,
        $client_state = null,
        $client_country = null
    ) {
        $this->client_email = $client_email;
        $this->client_fisrtname = $client_fisrtname;
        $this->client_lastname = $client_lastname;
        $this->client_telephone = $client_telephone;
        $this->client_zip_code = $client_zip_code;
        $this->client_street = $client_street;
        $this->client_suburb = $client_suburb;
        $this->client_number = $client_number;
        $this->client_city = $client_city;
        $this->client_state = $client_state;
        $this->client_country = $client_country;
    }

    /**
     * @return mixed
     */
    public function getClientEmail()
    {
        return $this->client_email;
    }

    /**
     * @return null
     */
    public function getClientFisrtname()
    {
        return $this->client_fisrtname;
    }

    /**
     * @return null
     */
    public function getClientLastname()
    {
        return $this->client_lastname;
    }

    /**
     * @return null
     */
    public function getClientTelephone()
    {
        return $this->client_telephone;
    }

    /**
     * @return null
     */
    public function getClientZipCode()
    {
        return $this->client_zip_code;
    }

    /**
     * @return null
     */
    public function getClientStreet()
    {
        return $this->client_street;
    }

    /**
     * @return null
     */
    public function getClientSuburb()
    {
        return $this->client_suburb;
    }

    /**
     * @return null
     */
    public function getClientNumber()
    {
        return $this->client_number;
    }

    /**
     * @return null
     */
    public function getClientCity()
    {
        return $this->client_city;
    }

    /**
     * @return null
     */
    public function getClientState()
    {
        return $this->client_state;
    }

    /**
     * @return null
     */
    public function getClientCountry()
    {
        return $this->client_country;
    }
}