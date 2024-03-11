<?php

return [
    'email' => [
        'shipped' => [
            'customer' => [
                'header' => 'Спасибо вам за ваш заказ',
                'footer' => '',
            ],
            'admin' => [
                'header' => 'Новый заказ от :fullName',
                'footer' => '',
            ],
            'items' => [
                'count' => 'Количество :count',
            ],
        ]
    ],
    'status' => [
        'new' => 'Новое',
        'pending' => 'Ожидаемый',
        'success' => 'Успех',
        'delivered' => 'Доставлено',
        'failed' => 'Неудачный',
        'cancel' => 'Отменить',
    ],
    'customer' => [
        'type' => [
            'individual' => 'Физическое лицо',
            'entity' => 'Юридическое лицо',
        ],
    ],
    'reverse' => [
        'create' => [
            'success' => 'Ваш возврат средств был успешно обработан. Пожалуйста, дождитесь подтверждения от администратора.',
        ],
    ],
    'cancel' => [
        'fail' => 'Этот заказ не может быть отменен.',
    ],
];
