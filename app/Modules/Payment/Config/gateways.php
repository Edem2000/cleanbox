<?php

return [
    'click' => [
        'provider' => 'Click',
        'route' => 'click.form',
        'merchant-id' => '12276',
        'service-id' => '17240',
        'secret-key' => 'hoIEOjDzom',
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
];