<?php

namespace Uol\BoaCompra\Acceptance;

use Behat\Behat\Context\Context;
use Uol\BoaCompra\Application\Transaction\Search;
use Uol\BoaCompra\Application\Transaction\SearchByCode;
use Uol\BoaCompra\Domain\BoaCompra;
use Uol\BoaCompra\Domain\Transaction\Request;

class TransactionNotificationContext implements Context
{
    private $boaCompra;
    private $request;
    private $search;
    private $searchByCode;

    /**
     * TransactionNotificationContext constructor.
     */
    public function __construct()
    {
        $this->boaCompra = new BoaCompra(
            7,
            1234567890,
            'http://localhsot/return',
            'http://localhsot/notification',
            new \Uol\BoaCompra\Domain\Core\Language('pt_BR'),
            'BR',
            new \Uol\BoaCompra\Domain\Core\Currency('BRL'),
            1,
            1,
            0);
        $this->request = new Request($this->boaCompra);
        $this->search = new Search($this->request);
        $this->searchByCode = new SearchByCode($this->request);
    }

    /**
     * @Given /^request transactions between (.*), (.*) dates$/
     */
    public function requestTransactionsBetweenDates($initialOrderDate, $finalOrderDate)
    {
        $this->request->setQueryParams($initialOrderDate, $finalOrderDate);
    }

    /**
     * @When /^require transactions list$/
     */
    public function requireTransactionsList()
    {
        $this->request->setQueryParams('2017-09-01T14:00:00.000-03:00', '2017-09-30T14:00:00.000-03:00');
        return new Search($this->request);
    }

    /**
     * @Then /^should return transactions$/
     */
    public function shouldReturnTransactions()
    {
        $this->request->setQueryParams('2017-09-01T14:00:00.000-03:00', '2017-09-30T14:00:00.000-03:00');
        $this->search = new Search($this->request);
        return $this->search->execute();
    }

    /**
     * @Given /^a transaction code (.*)$/
     */
    public function aTransactionCode($code)
    {
        $this->request->setCode($code);
    }

    /**
     * @When /^require transactions$/
     */
    public function requireTransactions()
    {
        $this->request->setCode('90197069');
        return new SearchByCode($this->request);
    }

    /**
     * @Then /^should return transaction$/
     */
    public function shouldReturnTransaction()
    {
        $this->request->setCode('90197069');
        $this->searchByCode = new SearchByCode($this->request);
        return $this->searchByCode->execute();
    }
}