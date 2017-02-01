<?php
return [
    'components' => [
    	'user' => [
            'identityClass' => 'frontend\models\Nutriologo',
            'enableAutoLogin' => false,
            'identityCookie' => [
                'name' => '_frontendUser', // unique for frontend
            ]
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
];
