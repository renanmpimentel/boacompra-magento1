<?php

namespace Uol\BoaCompra\Application\Transaction;

use Uol\BoaCompra\Domain\BoaCompra;
use Uol\BoaCompra\Domain\Transaction\Request;
use Uol\BoaCompra\Infrastructure\Services\HttpListener;

/**
 * Class StatusChangeNotification
 * @package Uol\BoaCompra\Application\Transaction
 */
class StatusChangeNotification
{
    /**
     * @var BoaCompra
     */
    private $boaCompra;
    /**
     * @var string
     */
    private $code;

    /**
     * StatusChangeNotification constructor.
     * @param BoaCompra $boaCompra
     * @throws \Exception
     */
    public function __construct(BoaCompra $boaCompra)
    {
        if (!HttpListener::hasPost()) {
            throw new \Exception('A post request is mandatory');
        }
        if (isset($_POST['notification-type']) && $_POST['notification-type'] == 'transaction') {
            $this->code = htmlspecialchars($_POST['transaction-code']);
        }
        $this->boaCompra = $boaCompra;
    }

    /**
     * @return bool|mixed
     */
    public function execute()
    {
        $request = new Request($this->boaCompra);
        $request->setCode($this->code);

        return (new SearchByCode($request))->execute();
    }
}
