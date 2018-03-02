<?php

namespace Uol\BoaCompra\Application\Transaction;

use Uol\BoaCompra\Domain\Transaction\Request;
use Uol\BoaCompra\Infrastructure\Services\Http;

/**
 * Class Search
 *
 * @package Uol\BoaCompra\Application\Transaction
 */
class Search
{
    /**
     * @var
     */
    private $http;
    /**
     * @var Request
     */
    private $request;

    /**
     * Search constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool|mixed
     */
    public function execute()
    {
        $url = $this->request->getEndpoint() . $this->generateQueryParams();
        $this->http = new Http($url);
        $this->http->setOptions(CURLOPT_HTTPHEADER, array(
            'Accept: application/vnd.boacompra.com.v1+json; charset=UTF-8',
            'Accept-Language: en-US',
            'Authorization: ' . $this->request->getBoaCompra()->getStoreId() . ':' . $this->generateAuthorization(),
            'Content-Type: application/json',
            'Content-MD5: ',
        ));
        $this->http->setOptions(CURLOPT_RETURNTRANSFER, 1);
        $this->http->setOptions(CURLOPT_CONNECTTIMEOUT, 30);

        try {
            return $this->http->execute();
        } catch (\Exception $exception) {
            echo 'Caught exception: ' . $exception->getMessage();
            return false;
        }
    }

    /**
     * @return string
     */
    private function generateQueryParams()
    {
        return '?' . urldecode(http_build_query($this->request->getQueryParams()));
    }

    /**
     * @return string
     */
    private function generateAuthorization()
    {
        return hash_hmac('sha256',
            parse_url($this->request->getEndpoint(), PHP_URL_PATH) . $this->generateQueryParams() . '',
            $this->request->getBoaCompra()->getSecretKey());
    }
}
