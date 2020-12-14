<?php

return [
    'store_id' => 'aamarpay',
    'signature_key' =>'28c78bb1f45112f5d40b956fe104645a',
    'sandbox' => true,
    'redirect_url' => [
        'success' => [
            'url' =>'payment.success' // payment.success
        ],
        'cancel' => [
            'url' =>'payment.cancel' // payment/cancel or you can use route also
        ]
    ]
];
