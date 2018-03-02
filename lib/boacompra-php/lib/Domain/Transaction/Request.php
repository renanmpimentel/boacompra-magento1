<?php

namespace Uol\BoaCompra\Domain\Transaction;

use Exception;
use Uol\BoaCompra\Domain\BoaCompra;

/**
 * Class Request
 *
 * @package Uol\BoaCompra\Domain\Transaction
 */
class Request
{
    /**
     * @var BoaCompra
     */
    private $boaCompra;
    /**
     * @var string
     */
    private $endpoint;
    /**
     * @var
     */
    private $code;
    /**
     * @var
     */
    private $queryParams;

    /**
     * Request constructor.
     *
     * @param BoaCompra $boaCompra
     */
    public function __construct(BoaCompra $boaCompra)
    {
        $this->boaCompra = $boaCompra;
        $this->endpoint = 'https://api.boacompra.com/transactions';
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * @param null $initialOrderDate
     * @param null $finalOrderDate
     * @param null $initialPaymentDate
     * @param null $finalPaymentDate
     * @param null $initialLastStatusChangeDate
     * @param null $finalLastStatusChangeDate
     * @param null $status
     * @param int  $page
     * @param int  $maxPageResults
     *
     * @return array
     * @throws Exception
     */
    public function setQueryParams(
        $initialOrderDate = null,
        $finalOrderDate = null,
        $initialPaymentDate = null,
        $finalPaymentDate = null,
        $initialLastStatusChangeDate = null,
        $finalLastStatusChangeDate = null,
        $status = null,
        $page = 1,
        $maxPageResults = 10
    ) {
        if ($initialOrderDate === null && $initialPaymentDate === null && $initialLastStatusChangeDate) {
            throw new Exception('A date range is mandatory');
        }
        if ($initialOrderDate !== null && $finalOrderDate === null) {
            throw new Exception('Must set final order date');
        }
        if ($initialPaymentDate !== null && $finalPaymentDate === null) {
            throw new Exception('Must set final payment date');
        }
        if ($initialLastStatusChangeDate !== null && $finalLastStatusChangeDate === null) {
            throw new Exception('Must set final last status change date');
        }
        $this->queryParams = array(
            'initial-order-date' => $initialOrderDate,
            'final-order-date' => $finalOrderDate,
            'initial-payment-date' => $initialPaymentDate,
            'final-payment-date' => $finalPaymentDate,
            'initial-last-status-change-date' => $initialLastStatusChangeDate,
            'final-last-status-change-date' => $finalLastStatusChangeDate,
            'status' => $status,
            'page' => $page,
            'max-page-results' => $maxPageResults,
            'test-mode' => $this->boaCompra->getTestMode(),
        );

        return $this->queryParams;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @return BoaCompra
     */
    public function getBoaCompra()
    {
        return $this->boaCompra;
    }
}
