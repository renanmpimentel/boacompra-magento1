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
class Uol_BoaCompra_NotificationController extends Mage_Core_Controller_Front_Action
{
    protected $_order;
    /**
     * Notification main endpoint
     */
    public function indexAction()
    {
        try {
            $notification = Mage::getModel('uol_boacompra/notification');
            $notification->updateOrderData();
        } catch (Exception $exception) {
            Mage::log('[Boa Compra] Notification Exception: ' . $exception->getMessage());
            $this->getResponse()->setHttpResponseCode(503);
            return;
        }
   }
}
