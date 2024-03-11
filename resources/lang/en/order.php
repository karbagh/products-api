<?php

return [
    'email' => [
        'shipped' => [
            'customer' => [
                'header' => 'Thank you for your order',
                'footer' => '',
            ],
            'admin' => [
                'header' => 'New Order from :fullName',
                'footer' => '',
            ],
            'items' => [
                'count' => 'Quantity :count',
            ],
        ]
    ],
    'status' => [
        'new ' => 'New',
        'pending' => 'Pending',
        'success' => 'Success',
        'failed' => 'Failed',
        'cancel' => 'Cancel',
    ],
    'customer' => [
        'type' => [
            'individual' => 'Individual person',
            'entity' => 'Legal entity',
        ],
    ],
    'reverse' => [
        'create' => [
            'success' => 'Your refund has been successfully processed. Kindly wait for confirmation from the administrator.',
        ],
    ],
    'cancel' => [
        'fail' => 'This order cannot be cancelled.',
    ],
];
