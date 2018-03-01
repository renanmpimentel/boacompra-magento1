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
 * Endpoint to receive the Boa Compra notifications
 */
class Uol_BoaCompra_ReturnController extends Mage_Core_Controller_Front_Action
{
    /**
     * Return url main endpoint
     */
    public function indexAction()
    {
        if ($this->getRequest()->get("order")) {
            $customerId = Mage::getSingleton('customer/session')->getCustomerId();
            $order = Mage::getModel('sales/order')->loadByIncrementId($this->getRequest()->get("order"));

            if ($customerId != $order->getCustomerId()) {
                $this->norouteAction();
                return;
            }

            $this->loadLayout();
            $block = $this->getLayout()->createBlock(
                'Mage_Core_Block_Template',
                'uol_boacompra_return',array('template' => 'uol/boacompra/return.phtml')
            );
            if ($order->getCustomerIsGuest() == 1) {
                    $block->setBlockData(array(
                    'increment_id' => $this->getRequest()->get("order"),
                    'view_order_url' => ''
                ));
            } else {
                $block->setBlockData(array(
                    'increment_id' => $this->getRequest()->get("order"),
                    'view_order_url' => sprintf(
                        '%s%s%s',
                        Mage::getBaseUrl(),
                        'sales/order/view/order_id/',
                        $order->getId()
                    )
                ));
            }

            $this->getLayout()->getBlock('content')->append($block);
            return $this->renderLayout();
        }
        $this->norouteAction();
        return;
   }
}
