<?php

return [
    'click' => [
        'provider' => 'Click',
        'route' => 'click.form',
        'merchant-id' => '13463',
        'service-id' => '18869',
        'secret-key' => 'wqZ4q4Ii6tfn',
        'url' => 'https://my.click.uz/pay/',
    ],
    'payme' => [
        'provider' => 'Payme',
        'route' => 'payme.form',
        'merchant-id' => '60f6ce9a7247f7532825c337',
        'secret-key' => 'i6MXs94ruz?SRX#&37xAzwQtuWGmbaMGVFKe',
        'url' => 'https://checkout.paycom.uz/',
        'login' => 'Paycom'
    ],
    'paynet' => [
        'provider' => 'Paynet',
        'route' => 'paynet.form'
    ],
    'apelsin' =>
    [
        'provider' => 'Apelsin',
        'client_id' => 'de71cbf3aca5450dace5e2c1540c48c0',
    ]
];