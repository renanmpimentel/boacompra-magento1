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

$installer = $this;

// Required tables
$statusTable = $installer->getTable('sales/order_status');
$statusStateTable = $installer->getTable('sales/order_status_state');

// Insert statuses
$installer->getConnection()->insertArray(
    $statusTable,
    array(
        'status',
        'label'
    ),
    array(
        array('status' => 'boacompra_cancelled', 'label' => 'Boa Compra Cancelled'),
        array('status' => 'boacompra_complete', 'label' => 'Boa Compra Complete'),
        array('status' => 'boacompra_chargeback', 'label' => 'Boa Compra Chargeback'),
        array('status' => 'boacompra_expired', 'label' => 'Boa Compra  Expired'),
        array('status' => 'boacompra_not_paid', 'label' => 'Boa Compra Not Paid'),
        array('status' => 'boacompra_pending', 'label' => 'Boa Compra Pending'),
        array('status' => 'boacompra_refunded', 'label' => 'Boa Compra Refunded'),
        array('status' => 'boacompra_under_review', 'label' => 'Boa Compra Under Review')
    )
);

// Insert states and mapping of statuses to states
$installer->getConnection()->insertArray(
    $statusStateTable,
    array(
        'status',
        'state',
        'is_default'
    ),
    array(
        array(
            'status' => 'boacompra_cancelled',
            'state' => 'canceled',
            'is_default' => 0
        ),
        array(
            'status' => 'boacompra_complete',
            'state' => 'processing',
            'is_default' => 0
        ),
        array(
            'status' => 'boacompra_chargeback',
            'state' => 'closed',
            'is_default' => 0
        ),
        array(
            'status' => 'boacompra_expired',
            'state' => 'canceled',
            'is_default' => 0
        ),
        array(
            'status' => 'boacompra_not_paid',
            'state' => 'processing',
            'is_default' => 0
        ),
        array(
            'status' => 'boacompra_pending',
            'state' => 'new',
            'is_default' => 0
        ),
        array(
            'status' => 'boacompra_refunded',
            'state' => 'closed',
            'is_default' => 0
        ),
        array(
            'status' => 'boacompra_under_review',
            'state' => 'payment_review',
            'is_default' => 0
        )
    )
);
