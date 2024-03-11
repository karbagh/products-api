<?php

return [
    'type' => [
        'legalEntity' => 'Юридическое лицо',
        'naturalPerson' => 'Физическое лицо',
    ],
    'delete' => [
        'success' => 'Аккаунт успешно удален.',
    ],
    'verify' => [
        'email' => [
            'header' => ' Электронная почта для подтверждения',
            'content' => 'Привет :fullName Вы зарегистрировали аккаунт на: ' . config('app.name') .
                ', прежде чем вы сможете использовать свою учетную запись, вам необходимо подтвердить, что
              Это ваш адрес электронной почты, нажав здесь. <a href=":link">:link</a>.',
            'footer' => ' С уважением',
        ],
    ],
    'reset' => [
        'email' => [
            'header' => 'Восстановление пароля',
            'content' => 'Уважаемый пользователь, вы отправили заявку' . config('app.name') .
                ' чтобы сбросить пароль, его необходимо подтвердить
               Это ваш адрес электронной почты, нажав здесь: <a href=":link">:link</a>',
            'footer' => ' С уважением',
        ],
    ],
    'gift' => [
        'email' => [
            'header' => 'Заявка на использование подарочной карты',
            'content' => 'Уважаемый пользователь, вы отправили заявку' . config('app.name') .
                ' активация вашей подарочной карты, его необходимо подтвердить
               Это ваш адрес электронной почты, нажав здесь: <a href=":link">:link</a>',
            'footer' => ' С уважением',
        ],
    ],
    'message' => [
        'email' => [
            'phone' => 'Номер телефона - :phone',
            'header' => 'Сообщение от :from',
            'footer' => 'Ответ можно получить прямо здесь или из панели администратора.',
        ],
    ],
];
