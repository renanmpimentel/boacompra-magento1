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
 * Model for Boa Compra default payment method
 *
 */
class Uol_BoaCompra_Model_Default extends Mage_Payment_Model_Method_Abstract
{

    protected $_code = 'boacompra_default';

    public function getOrderPlaceRedirectUrl()
    {
        return Mage::getUrl('boacompra/default/redirect');//, array('_secure' => false));
    }

}
