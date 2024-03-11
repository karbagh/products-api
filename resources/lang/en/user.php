<?php

return [
    'type' => [
        'legalEntity' => 'Legal entity',
        'naturalPerson' => 'A natural person',
    ],
    'verify' => [
        'email' => [
            'header' => ' Verification mail',
            'content' => 'Hello :fullName You registered an account on ' . config('app.name') .
                ', before being able to use your account you need to verify that
             this is your email address by clicking here: <a href=":link">:link</a>.',
            'footer' => ' Kind Regards',
        ],
    ],
    'reset' => [
        'email' => [
            'header' => 'Password recovery',
            'content' => 'Dear user, you have sent a request' . config('app.name') .
                ' to reset your password, you must confirm it
                This is your email address by clicking here: <a href=":link">:link</a>',
            'footer' => ' Kind Regards',
        ],
    ],
    'gift' => [
        'email' => [
            'header' => 'Application for the use of a gift card',
            'content' => 'Dear user, you have sent a request' . config('app.name') .
                ' activating your gift card, you must confirm it
                This is your email address by clicking here: <a href=":link">:link</a>',
            'footer' => ' Kind Regards',
        ],
    ],
    'message' => [
        'email' => [
            'phone' => 'Phone number - :phone',
            'header' => 'Message from :from',
            'footer' => 'You can get the answer right here or from the admin panel.',
        ],
    ],
];
