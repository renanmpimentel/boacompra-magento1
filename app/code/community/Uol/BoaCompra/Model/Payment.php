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
 * Description of Payment
 *
 * @author BoaCompra S/A.
 */
class Uol_BoaCompra_Model_Payment
{
    protected $_library;
    /* Mage sales/order model*/
    protected $_order;

    public function __construct($data)
    {
        $this->_library = Mage::getModel('uol_boacompra/library');
        $this->_order = $data['order'];
    }

    /**
     * Create boa compra request required objects and return an object able to to
     * a payment request to Boa Compra
     * @return \Uol\BoaCompra\Application\Payment\RequestAPayment
     */
    public function requestAPayment()
    {
        $boaCompra = $this->_library->createBoaCompraObject($this->_order->getIncrementId());
        $boaCompraCustomer = $this->createBoaCompraCustomerObject();
        $boaCompraOrder =  $this->createBoaCompraOrderObject();
        
        return $this->createBoaCompraRequestAPaymentObject($boaCompra, $boaCompraCustomer, $boaCompraOrder);
    }

    /**
     * Create boa compra customer object
     * @return \Uol\BoaCompra\Domain\Customer
     */
    private function createBoaCompraCustomerObject()
    {
        $address = $this->getCustomerAddress();

        return new \Uol\BoaCompra\Domain\Customer(
            $this->_order->getCustomerEmail(),
            $this->_order->getData()['customer_firstname'],
            $this->_order->getData()['customer_lastname'],
            $address['phone'],
            $address['zip_code'],
            $address['street'],
            $address['suburb'],
            $address['number'],
            $address['city'],
            $address['state'],
            $address['country']
        );
    }

    /**
     * Get magento billing address and return boa compra required info from it in
     * an array
     * @return array
     */
    private function getCustomerAddress()
    {
        $addressArray = array(
            'zip_code' => null,
            'street' => null,
            'suburb' => null,
            'number' => null,
            'city' => null,
            'state' => null,
            'country' => null,
            'phone' => null
        );

        $address = $this->_order->getBillingAddress();

        if($address) {
            if (count($address->getStreet()) === 4) {
                $addressArray['street'] = $address->getStreet1();
                $addressArray['number'] = $address->getStreet2();
                $addressArray['suburb'] = $address->getStreet4();
            }

            $addressArray['city'] = ($address->getCity()) ? $address->getCity() : null;
            $addressArray['zip_code'] = ($address->getPostcode()) ? $address->getPostcode() : null;
            $addressArray['state'] = ($address->getRegionCode()) ? $address->getRegionCode() : null;
            $addressArray['country'] = ($address->getCountry()) ? $address->getCountry() : null;
            $addressArray['phone']  = ($address->getTelephone()) ? $address->getTelephone() : null;
        }

        return $addressArray;
    }

    /**
     * Create boa compra order object
     * @return \Uol\BoaCompra\Domain\Order
     */
    private function createBoaCompraOrderObject()
    {
        $description = '';
        foreach ($this->_order->getAllVisibleItems() as $product) {
            $description = $this->buildDescription($product, $description);
        }

        return new \Uol\BoaCompra\Domain\Order(
            $this->_order->getId(),
            $this->limitDescriptionSize($description),
            number_format((float)$this->_order->getGrandTotal(), 2, '.', '')
        );
    }

    /**
     * Concatenate products name to build description
     * @param Mage_Catalog_Product_Model $product
     * @param string $description
     * @return string
     */
    private function buildDescription($product, $description)
    {
        if ($description === '') {
            return sprintf(
                '%s%s',
                $product->getName(),
                $this->addQuantityLabel(intval($product->getQtyOrdered()))
            );
        }
        return sprintf(
                '%s%s%s%s',
                $description,
                ', ',
                $product->getName(),
                $this->addQuantityLabel(intval($product->getQtyOrdered()))
            );
    }

    /**
     * If there is more than one item, add a quantity label
     * @param string $quantity
     * @return string
     */
    private function addQuantityLabel($quantity)
    {
        return ($quantity > 1) ? sprintf('%s%s%s', '(', $quantity, ')') : '';
    }

    /**
     * Validate and limits description size to 200 characters, adding 3 dots in the end
     * @param string $description
     * @return string
     */
    private function limitDescriptionSize($description)
    {
        return (strlen($description) > 200) ?
            sprintf('%s%s', substr($description, 0, 197) . '...')
            : $description;
    }
    
    /**
     * Create boa compra payment request object
     * @param \Uol\BoaCompra\Domain\BoaCompra $boacompra
     * @param \Uol\BoaCompra\Domain\Customer $customer
     * @param \Uol\BoaCompra\Domain\Order $order
     */
    private function createBoaCompraRequestAPaymentObject($boaCompra, $customer, $order)
    {
        $payment = new \Uol\BoaCompra\Domain\Payment($customer, $order);
        return new \Uol\BoaCompra\Application\Payment\RequestAPayment(
            new \Uol\BoaCompra\Domain\Payment\Request($boaCompra, $payment)
        );
    }
}
