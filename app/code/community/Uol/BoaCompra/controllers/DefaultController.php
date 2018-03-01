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
 * Controller for Boa Compra default payment method
 *
 */
class Uol_BoaCompra_DefaultController extends Mage_Core_Controller_Front_Action
{
    protected $_order;

    /**
     * Get order placed and redirect user to Boa Compra or to error or to 'not found' page
     * @return redirect
     */
    public function redirectAction()
    {
        $this->_order = Mage::getModel('sales/order')->load(Mage::getSingleton('checkout/session')->getLastOrderId());
        $this->_library = Mage::getModel('uol_boacompra/library');

        if ($this->verifyNotAllowed($this->_order)) {
            return $this->norouteAction();
        }

        $this->loadLayout();

        if (! $this->_library->isValidBoaCompraRequiredParameters()) {
            $this->cancelOrderStatus($this->_order);
            Mage::getSingleton('checkout/session')->unsQuoteId();
            $block = $this->createErrorBlock();
        } else {
            $block = $this->createRedirectBlock();
        }

        $this->getLayout()->getBlock('content')->append($block);
        return $this->renderLayout();
    }

    /**
     * Do the boa compra checkout (POST in https://billing.boacompra.com/payment.php)
     * @return redirect to boa compra page | redirect to error page
     */
    public function checkoutAction()
    {
        try {
            $this->_order = Mage::getModel('sales/order')->load(
                Mage::getSingleton('checkout/session')->getLastOrderId()
            );

            if($this->verifyNotAllowed($this->_order)) {
                return $this->norouteAction();
            }
            /* build boa compra objects and prepare the request to boa compra service */
            $payment = Mage::getModel('uol_boacompra/payment', array('order' => $this->_order));
            $requestAPayment = $payment->requestAPayment();
            //@TODO ver como vai ficar o envio de email
            $this->_order->sendNewOrderEmail();
            //free cart
            Mage::getSingleton('checkout/session')->unsQuoteId();
            //redirect to boa compra
            return $requestAPayment->execute();
        } catch (Exception $exception) {
            Mage::logException($exception);
            $this->cancelOrderStatus($this->_order);
            $this->loadLayout();
            $block = $this->createErrorBlock();
            $this->getLayout()->getBlock('content')->append($block);
            return $this->renderLayout();
        }
    }
    
    /**
     * Cancel order
     * @param $order
     */
    private function cancelOrderStatus($order)
    {
        $order->cancel();
        $order->save();
    }

    /**
     * Redirect true if it is no allowed to access this cotroller
     * @param $order
     * @return boolean
     */
    private function verifyNotAllowed($order)
    {
        if (empty($order->getData()) || $order->getPayment()->getMethod() !== 'boacompra_default') {
            return true;
        }
        return false;
    }

    /**
     * Create dynamic error block
     * @return Mage_Core_Block_Template
     */
    private function createErrorBlock()
    {
        $block = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'uol_boacompra_error',array('template' => 'uol/boacompra/error.phtml')
        );

        $block->setBlockData(array(
            'increment_id' => $this->_order->getIncrementId()
        ));

        return $block;
    }

    /**
     * Create dynamic default payment redirect block
     * @return Mage_Core_Block_Template
     */
    private function createRedirectBlock()
    {
        $block = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'uol_boacompra_redirect',array('template' => 'uol/boacompra/redirect.phtml')
        );

        $block->setBlockData(array(
            'increment_id' => $this->_order->getIncrementId(),
            'checkout_url' => Mage::getBaseUrl() . 'boacompra/default/checkout/')
        );

        return $block;
    }
}
