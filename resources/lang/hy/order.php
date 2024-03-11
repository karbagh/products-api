<?php

return [
    'email' => [
        'shipped' => [
            'customer' => [
                'header' => 'Շնորհակալություն պատվերի համար',
                'footer' => '',
            ],
            'admin' => [
                'header' => 'Նոր պատվեր :fullName-ի Կողմից',
                'footer' => '',
            ],
            'items' => [
                'count' => 'Քանակ :count',
            ],
        ]
    ],
    'status' => [
        'new' => 'Նոր',
        'pending' => 'Ակնկալվող',
        'success' => 'Հաստատված',
        'delivered' => 'Առաքված',
        'failed' => 'Մերժված',
        'cancel' => 'Չեղարկված',
    ],
    'customer' => [
        'type' => [
            'individual' => 'Ֆիզիկական անձ',
            'entity' => 'Իրավաբանական անձ',
        ],
    ],
    'reverse' => [
        'create' => [
            'success' => 'Ձեր վերադարձը հաջողությամբ մշակվել է: Խնդրում ենք սպասել Ադմինիստրատորի հաստատմանը:',
        ],
    ],
    'cancel' => [
        'fail' => 'Այս պատվերը չի կարող չեղարկվել։',
    ],
];
