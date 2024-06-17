<?php

return [
     'order_status_admin' => [
        'pending' => [
            'status' => 'Pending',
            'details' => 'Your order is currenty pending',
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Processed and ready to ship',
            'details' => 'Your order has been processed and ready to delivery',
        ],
        'dropped_off' => [
            'status' => 'Dropped Off',
            'details' => 'Order dropped off by seller',
        ],
        'shipped' => [
            'status' => 'Shipped',
            'details' => 'Your order has arrived at our logistics facility',
        ],
        'out_for_delivery' => [
            'status' => 'Out For Delivery',
            'details' => 'Our delivery partner will attempt to delivery your order',
        ],
        'delivered' => [
            'status' => 'Delivered',
            'details' => 'Delivered',
        ],
     ],
     'vendor_order_status' => [
        'pending' => [
            'status' => 'Pending',
            'details' => 'Your order is currenty pending',
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Processed and ready to ship',
            'details' => 'Your order has been processed and ready to delivery',
        ],
     ],
];