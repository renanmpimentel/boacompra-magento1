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
 * Model for Boa Compra notifications
 *
 * @author BoaCompra S/A.
 */
class Uol_BoaCompra_Model_Notification
{
    protected $_library;

    public function __construct()
    {
        $this->_library = Mage::getModel('uol_boacompra/library');
    }

    /**
     * Get transaction data from notification and update order status
     */
    public function updateOrderData()
    {
        $transactionSearch = new \Uol\BoaCompra\Application\Transaction\StatusChangeNotification(
            $this->_library->createBoaCompraObject()
        );
        $post = json_encode($_POST);
        //Mage::log('[Boa Compra] POST:' . $post);
        try {
            $result = $transactionSearch->execute();
            //Mage::log('[Boa Compra] Notification results:::' . "$result");
            $result = json_decode($result);
            if (isset($result->errors)) {
                throw new Exception(json_encode($result->errors));
            }
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        foreach($result->{'transaction-result'}->transactions as $transaction) {
            $order = Mage::getModel('sales/order')->load(
                $transaction->{'order-id'}
            );

            if ($order->getStatus() !== $this->_library->boaCompraToMagentoStatus($transaction->status)) {
                $this->updateOrderStatus(
                    $order,
                    $this->_library->boaCompraToMagentoStatus($transaction->status)
                );
            }
        }
    }

    /**
     * Update order status and history
     * @param Mage_Sales_Order_Model $order
     * @param string $status
     * @param string $comment
     * @param boolean $notify
     */
    private function updateOrderStatus($order, $status, $comment = '', $notify = true)
    {
        $order->setStatus($status, true);
        $order->addStatusToHistory($status, $comment, $notify);
        $order->save();
    }
}
