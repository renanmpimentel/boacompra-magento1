<?php

/*
 * Copyright 2017 BoaCompra S/A.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Initialize Boa Compra SDK, and including it's autoload.php
 */
class Uol_BoaCompra_Model_Library
{
    /* Boa Compra Statuses*/
    const CANCELLED = 'boacompra_cancelled';
    const COMPLETE = 'boacompra_complete';
    const CHARGEBACK = 'boacompra_chargeback';
    const EXPIRED = 'boacompra_expired';
    const NOT_PAID = 'boacompra_not_paid';
    const PENDING = 'boacompra_pending';
    const REFUNDED = 'boacompra_refunded';
    const UNDER_REVIEW = 'boacompra_under_review';
    /* Path to autoload from boa compra sdk*/
    protected $_lib_path;
    /* Order increment id to be used in return url, to redirect to order page */
    protected $_increment_id;

    public function __construct()
    {
        $this->lib_path = Mage::getBaseDir('lib'). '/boacompra-php/vendor/autoload.php';
        include_once($this->lib_path);
    }
    
    /**
     * Create a BoaCompra bootstrap object
     * @param string $incrementId
     * @return \Uol\BoaCompra\Domain\BoaCompra
     */
    public function createBoaCompraObject($incrementId = '')
    {
        $this->_increment_id = $incrementId;
        return new \Uol\BoaCompra\Domain\BoaCompra(
            $this->getStoreId(),
            $this->getSecretKey(),
            $this->getReturnUrl(),
            $this->getNotifyUrl(),
            new \Uol\BoaCompra\Domain\Core\Language(Mage::getStoreConfig('general/locale/code')),
            Mage::getStoreConfig('general/country/default'),
            new \Uol\BoaCompra\Domain\Core\Currency(Mage::app()->getStore()->getCurrentCurrencyCode()),
            $this->getProjectId(),
            $this->getTestMode(),
            $this->isMobile()
        );
    }
    
    public function getStoreId()
    {
        return Mage::getStoreConfig('payment/boacompra_settings/store_id');
    }
    
    public function getSecretKey()
    {
        return Mage::getStoreConfig('payment/boacompra_settings/secret_key');
    }

    public function getTestMode()
    {
        return Mage::getStoreConfig('payment/boacompra_settings/test_mode');
    }
    
    public function getProjectId()
    {
        if (Mage::getStoreConfig('payment/boacompra_settings_advanced/project_id')) {
            return Mage::getStoreConfig('payment/boacompra_settings_advanced/project_id');
        }
        return 1;
    }
    
    public function getNotifyUrl()
    {
        if (Mage::getStoreConfig('payment/boacompra_settings_advanced/notify_url') === 'edit') {
            return Mage::getStoreConfig('payment/boacompra_settings_advanced/notify_url_edited');
        }

        return Mage::getBaseUrl() . 'boacompra/notification/';
    }

    public function getReturnUrl()
    {
        if (Mage::getStoreConfig('payment/boacompra_settings_advanced/project_id')) {
            return Mage::getStoreConfig('payment/boacompra_settings_advanced/return_url_edited');
        }

        return ($this->_increment_id === '') ?
            Mage::getBaseUrl() . 'boacompra/return/'
            : Mage::getBaseUrl() . 'boacompra/return/?order=' . $this->_increment_id;
    }
    
    public function getLog()
    {
        return Mage::getStoreConfig('payment/boacompra_settings/log');
    }
    
    /**
     * Return 1 case the request is from mobile user agent and 0 if not
     * @return int, 1 | 0
     */
    public function isMobile()
    {
        return (int)(Zend_Http_UserAgent_Mobile::match(
            Mage::helper('core/http')->getHttpUserAgent(),
            $_SERVER
            )
        );
    }

    /**
     * Get magento boa compra status by boa compra notification transaction status
     * @param string $boaCompraStatus
     * @return string
     */
    public function boaCompraToMagentoStatus($boaCompraStatus)
    {
        switch ($boaCompraStatus) {
            case \Uol\BoaCompra\Domain\Transaction\Status::CANCELLED:
                return self::CANCELLED;
                break;
            case \Uol\BoaCompra\Domain\Transaction\Status::CHARGEBACK:
                return self::CHARGEBACK;
                break;
            case \Uol\BoaCompra\Domain\Transaction\Status::COMPLETE:
                return self::COMPLETE;
                break;
            case \Uol\BoaCompra\Domain\Transaction\Status::EXPIRED:
                return self::EXPIRED;
                break;
            case \Uol\BoaCompra\Domain\Transaction\Status::NOTPAID:
                return self::NOT_PAID;
                break;
            case \Uol\BoaCompra\Domain\Transaction\Status::PENDING:
                return self::PENDING;
                break;
            case \Uol\BoaCompra\Domain\Transaction\Status::REFUNDED:
                return self::REFUNDED;
                break;
            case \Uol\BoaCompra\Domain\Transaction\Status::UNDERREVIEW:
                return self::UNDER_REVIEW;
                break;
        }
    }

    /**
     * Do a serch transactiont to if validate Boa Compra required parameters are correct
     * @return boolean
     */
    public function isValidBoaCompraRequiredParameters()
    {
        $date = new DateTime('yesterday');
        $result = array();
        $request = new \Uol\BoaCompra\Domain\Transaction\Request($this->createBoaCompraObject());
        $request->setQueryParams($date->format('Y-m-d\TH:m:s\.000-00:00'), $date->format('Y-m-d\TH:m:s\.000-00:00'));
        $transactionSearch = new \Uol\BoaCompra\Application\Transaction\Search($request);

        try {
            $result = json_decode($transactionSearch->execute());
        } catch (Exception $exception) {
            Mage::log('[Boa Compra] [Exception] - code: ' . $exception->getCode() . ', message: ' . $exception->getMessage());
            return false;
        }

        if (isset($result->errors)) {
            Mage::log('[Boa Compra] [Error] - code: ' . $result->errors[0]->code . ', description: ' . $result->errors[0]->description);
            return false;
        }
        return true;
    }
}
