<?php

return [
    'orders' => [
        'label' => 'Import Orders',
        'permission-required' => 'import-orders',
        'files' => [
            'file1' => [
                'label' => 'File 1',
                'headers_to_db' => [
                    'order_date' => [
                        'label' => 'Order Date',
                        'type' => 'date',
                        'validation' => ['required']
                    ],
                    'channel' => [
                        'label' => 'SKU',
                        'type' => 'string',
                        'validation' => ['required', 'in' => ['Amazon', 'PT']]
                    ],
                    'sku' => [
                        'label' => 'SKU',
                        'type' => 'string',
                        'validation' => ['required', 'exists' => ['table' => 'products', 'column' => 'sku']]
                    ],
                    'item_description' => [
                        'label' => 'Item Description',
                        'type' => 'string',
                        'validation' => ['nullable']
                    ],
                    'origin' => [
                        'label' => 'Origin',
                        'type' => 'string',
                        'validation' => ['required']
                    ],
                    'so_num' => [
                        'label' => 'SO#',
                        'type' => 'string',
                        'validation' => ['required']
                    ],
                    'coast' => [
                        'label' => 'Coast',
                        'type' => 'double',
                        'validation' => ['required']
                    ],
                    'shipping_cost' => [
                        'label' => 'Shipping Cost',
                        'type' => 'double',
                        'validation' => ['required']
                    ],
                    'total_price' => [
                        'label' => 'Total Price',
                        'type' => 'double',
                        'validation' => ['required']
                    ],
                ],
                'update_or_create' => ['sku', 'so_num'],
            ],
            'file2' => [
                'label' => 'File 2',
                'headers_to_db' => [
                    'order_date' => [
                        'label' => 'File 2 Order Date',
                        'type' => 'date',
                        'validation' => ['required']
                    ],
                    'channel' => [
                        'label' => 'SKU 2',
                        'type' => 'string',
                        'validation' => ['required', 'in' => ['amazon', 'PT']]
                    ],
                    'sku' => [
                        'label' => 'Label 2 SKU',
                        'type' => 'string',
                        'validation' => ['required', 'exists' => ['table' => 'products', 'column' => 'sku']]
                    ],
                    'item_description' => [
                        'label' => 'Item Description2',
                        'type' => 'string',
                        'validation' => ['nullable']
                    ],
                    'origin' => [
                        'label' => 'Origin',
                        'type' => 'string',
                        'validation' => ['required']
                    ],
                    'so_num' => [
                        'label' => 'SO#2',
                        'type' => 'string',
                        'validation' => ['required']
                    ],
                    'coast' => [
                        'label' => 'Coast2',
                        'type' => 'double',
                        'validation' => ['required']
                    ],
                    'shipping_cost' => [
                        'label' => 'Shipping Cost2',
                        'type' => 'double',
                        'validation' => ['required']
                    ],
                    'total_price' => [
                        'label' => 'Total Price2',
                        'type' => 'double',
                        'validation' => ['required']
                    ],
                ],
                'update_or_create' => ['sku', 'so_num'],
            ],
        ],
    ]
];
