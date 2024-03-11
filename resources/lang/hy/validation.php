<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'accepted' => ':attribute-ը պետք է ընդունվի։',
    'accepted_if' => ':attribute-ը պետք է ընդունվի, երբ :other-ը :value է:',
    'active_url' => ':attribute-ը վավեր URL չէ:',
    'after' => ':attribute-ը պետք է լինի :date-ից հետո ամսաթիվ:',
    'after_or_equal' => ':attribute-ը պետք է լինի :date-ին հաջորդող կամ հավասար ամսաթիվ:',
    'alpha' => ':attribute-ը պետք է միայն տառեր պարունակի:',
    'alpha_dash' => ':attribute-ը պետք է պարունակի միայն տառեր, թվեր, գծիկներ և ընդգծումներ:',
    'alpha_num' => ':attribute-ը պետք է պարունակի միայն տառեր և թվեր:',
    'array' => ':attribute-ը պետք է զանգված լինի:',
    'before' => ':attribute-ը պետք է լինի :date-ից առաջ ամսաթիվ:',
    'before_or_equal' => ':attribute-ը պետք է լինի :date-ին նախորդող կամ հավասար ամսաթիվ:',
    'between' => [
        'array' => ':attribute-ը պետք է ունենա :min և :max տարրեր:',
        'file' => ':attribute-ը պետք է լինի :min և :max կիլոբայթների միջև:',
        'numeric' => ':attribute-ը պետք է լինի :min-ի և :max-ի միջև:',
        'string' => ':attribute-ը պետք է լինի :min և :max նիշերի միջև:',
    ],
    'boolean' => ':attribute-ը պետք է լինի ճշմարիտ կամ կեղծ:',
    'confirmed' => ':attribute հաստատումը չի համընկնում:',
    'current_password' => 'Գաղտնաբառը սխալ է:',
    'date' => ':attribute-ը վավեր ամսաթիվ չէ:',
    'date_equals' => ':attribute-ը պետք է լինի :date-ին հավասար ամսաթիվ:',
    'date_format' => ':attribute-ը չի համապատասխանում :format ձևաչափին:',
    'declined' => ':attribute-ը պետք է մերժվի:',
    'declined_if' => ':attribute-ը պետք է մերժվի, երբ :other-ը :value է:',
    'different' => ':attribute-ը և :other-ը պետք է տարբեր լինեն:',
    'digits' => ':attribute-ը պետք է լինի :digits թվանշան:',
    'digits_between' => ':attribute-ը պետք է լինի :min և :max թվանշանների միջև:',
    'dimensions' => ':attribute-ն անվավեր պատկերի չափեր ունի:',
    'distinct' => ':attribute-ն ունի կրկնօրինակ արժեք:',
    'doesnt_end_with' => ':attribute-ը չի կարող ավարտվել հետևյալներից որևէ մեկով. :values:',
    'doesnt_start_with' => ':attribute-ը չի կարող սկսվել հետևյալից որևէ մեկով. :values:',
    'email' => ':attribute-ը պետք է վավեր էլփոստի հասցե լինի:',
    'ends_with' => ':attribute-ը պետք է ավարտվի հետևյալներից մեկով. :values:',
    'enum' => 'Ընտրված :attribute-ն անվավեր է:',
    'exists' => 'Ընտրված :attribute-ն անվավեր է:',
    'file' => ':attribute-ը պետք է լինի ֆայլ:',
    'filled' => ':attribute-ը պետք է արժեք ունենա:',
    'gt' => [
        'array' => ':attribute-ը պետք է ունենա ավելի քան :value տարրեր:',
        'file' => ':attribute-ը պետք է լինի :value կիլոբայթից մեծ:',
        'numeric' => ':attribute-ը պետք է մեծ լինի :value-ից:',
        'string' => ':attribute-ը պետք է մեծ լինի :value նիշերից:',
    ],
    'gte' => [
        'array' => ':attribute-ը պետք է ունենա :value տարրեր կամ ավելին:',
        'file' => ':attribute-ը պետք է մեծ կամ հավասար լինի :value կիլոբայթին:',
        'numeric' => ':attribute-ը պետք է մեծ կամ հավասար լինի :value-ին:',
        'string' => ':attribute-ը պետք է մեծ կամ հավասար լինի :value նիշերին:',
    ],
    'image' => ':attribute-ը պետք է պատկեր լինի։',
    'in' => 'Ընտրված :attribute-ն անվավեր է:',
    'in_array' => ':attribute-ը գոյություն չունի :other-ում:',
    'integer' => ':attribute-ը պետք է լինի ամբողջ թիվ:',
    'ip' => ':attribute-ը պետք է վավեր IP հասցե լինի:',
    'ipv4' => ':attribute-ը պետք է լինի վավեր IPv4 հասցե:',
    'ipv6' => ':attribute-ը պետք է վավեր IPv6 հասցե լինի:',
    'json' => ':attribute-ը պետք է լինի վավեր JSON տող:',
    'lt' => [
        'array' => ':attribute-ը պետք է ունենա :value-ից պակաս տարրեր:',
        'file' => ':attribute-ը պետք է լինի :value կիլոբայթից փոքր:',
        'numeric' => ':attribute-ը պետք է լինի :value-ից փոքր:',
        'string' => ':attribute-ը պետք է լինի :value նիշից փոքր:',
    ],
    'lte' => [
        'array' => ':attribute-ը չպետք է ունենա ավելի քան :value տարրեր:',
        'file' => ':attribute-ը պետք է լինի :value կիլոբայթից փոքր կամ հավասար:',
        'numeric' => ':attribute-ը պետք է լինի :value-ից փոքր կամ հավասար:',
        'string' => ':attribute-ը պետք է լինի փոքր կամ հավասար :value նիշերին:',
    ],
    'mac_address' => ':attribute-ը պետք է վավեր MAC հասցե լինի:',
    'max' => [
        'array' => ':attribute-ը չպետք է ունենա ավելի քան :max տարրեր:',
        'file' => ':attribute-ը չպետք է լինի :max կիլոբայթից մեծ:',
        'numeric' => ':attribute-ը չպետք է մեծ լինի :max-ից:',
        'string' => ':attribute-ը չպետք է լինի :max նիշից մեծ:',
    ],
    'mimes' => ':attribute-ը պետք է լինի :values տեսակի ֆայլ:',
    'mimetypes' => ':attribute-ը պետք է լինի :values տեսակի ֆայլ:',
    'min' => [
        'array' => ':attribute-ը պետք է ունենա առնվազն :min տարրեր:',
        'file' => ':attribute-ը պետք է լինի առնվազն :min կիլոբայթ:',
        'numeric' => ':attribute-ը պետք է լինի առնվազն :min:',
        'string' => ':attribute-ը պետք է լինի առնվազն :min նիշ:',
    ],
    'multiple_of' => ':attribute-ը պետք է լինի :value-ի բազմապատիկ:',
    'not_in' => 'Ընտրված :attribute-ն անվավեր է:',
    'not_regex' => ':attribute ձևաչափն անվավեր է:',
    'numeric' => ':attribute-ը պետք է լինի թիվ:',
    'password' => [
        'letters' => ':attribute-ը պետք է պարունակի առնվազն մեկ տառ:',
        'mixed' => ':attribute-ը պետք է պարունակի առնվազն մեկ մեծատառ և մեկ փոքրատառ:',
        'numbers' => ':attribute-ը պետք է պարունակի առնվազն մեկ թիվ:',
        'symbols' => ':attribute-ը պետք է պարունակի առնվազն մեկ նշան:',
        'uncompromised' => 'Տվյալ :attribute-ը հայտնվել է տվյալների արտահոսքի մեջ։ Խնդրում եմ ընտրել այլ :attribute.',
    ],
    'present' => ':attribute-ը պետք է լինի:',
    'prohibited' => ':attribute-ն արգելված է։',
    'prohibited_if' => ':attribute-ն արգելված է, երբ :other-ը :value է:',
    'prohibited_unless' => ':attribute-ն արգելված է, եթե :other-ը :values-ում չէ:',
    'prohibits' => ':attribute-ն արգելում է :other-ին ներկա լինել:',
    'regex' => ':attribute ձևաչափն անվավեր է:',
    'required' => ':attribute-ը պարտադիր է:',
    'required_array_keys' => ':attribute-ը պետք է պարունակի գրառումներ՝ :values-ի համար:',
    'required_if' => ':attribute-ը պարտադիր է, երբ :other-ը :value է:',
    'required_unless' => ':attribute-ը պարտադիր է, եթե :other-ը :values-ում չէ:',
    'required_with' => ':attribute-ը պարտադիր է, երբ առկա է :values:',
    'required_with_all' => ':attribute-ը պարտադիր է, երբ առկա են :values:',
    'required_without' => ':attribute-ը պարտադիր է, երբ :values չկա:',
    'required_without_all' => ':attribute-ը պարտադիր է, երբ :արժեքներից ոչ մեկը չկա:',
    'same' => ':attribute-ը և :other-ը պետք է համապատասխանեն:',
    'size' => [
        'array' => ':attribute-ը պետք է պարունակի :size տարրեր:',
        'file' => ':attribute-ը պետք է լինի :size կիլոբայթ:',
        'numeric' => ':attribute-ը պետք է լինի :size:',
        'string' => ':attribute-ը պետք է լինի :size նիշ:',
    ],
    'starts_with' => ':attribute-ը պետք է սկսվի հետևյալներից մեկով. :values:',
    'string' => ':attribute-ը պետք է լինի տող:',
    'timezone' => ':attribute-ը պետք է վավեր ժամային գոտի լինի:',
    'unique' => ':attribute-ն արդեն վերցված է։',
    'uploaded' => ':attribute-ը չհաջողվեց վերբեռնել:',
    'url' => ':attribute-ը պետք է վավեր URL լինի:',
    'uuid' => ':attribute-ը պետք է վավեր UUID լինի:',
    'username' => [
        'exists' => [
            'false' => 'Ձեր տվյալները չեն համապատասխանում մեր գրառումների հետ:'
        ],
    ],
    'greater' => [
        'order_item' => [
            'count' => ':attribute-ը պետք է չգերազանցի պատվերի քանակը:'
        ],
        'gift' => [
            'balance' => ':attribute-ը պետք է չգերազանցի նվեր քարտի հաշվեկշիռը:'
        ],
        'order' => [
            'price' => ':attribute-ը պետք է չգերազանցի պատվերի հանրագումարը:'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'fullName' => 'Անուն Ազգանուն',
        'phone' => 'Հեռախոսահամար',
        'email' => 'Էլ․ Փոստ',
        'password' => 'Գաղտնաբառ',
        'passwordConfirmation' => 'Հաստատել գաղտնաբառ',
        'profession' => 'Մասնագիտություն',
        'sphere' => 'Ոլորտ',
        'about' => 'Չեր Մասին',
        'tin' => 'ՀՎՀՀ',
        'company' => 'Ընկերության անվանում',
        'certificate' => 'Ֆայլ',
        'start' => 'Առաքման ժամ',
        'end' => 'Առաքման ժամ',
        'items' => 'Ապրանքներ',
        'newPassword' => 'Նոր Գաղտնաբառ',
        'newPasswordConfirmation' => 'Գաղտնաբառ-ի հաստատում',
        'regionId' => 'Տարածաշրջան',
        'address' => 'Հասցե',
        'details' => 'Մանրամասներ',
        'token' => 'Տոկեն',
        'orderId' => 'Պատվեր',
        'type' => 'Տեսակ',
        'referralCode' => 'Ռեֆեռալ Կոդ',
        'name' => 'Անուն',
        'first_name' => 'Անուն',
        'last_name' => 'Ազգանուն',
        'count' => 'Քանակ',
        'gift' => [
            'id' => 'Նվեր քարտ-ի ID',
            'use' => 'Օգտագործվող գումարը',
        ]
    ],

];
