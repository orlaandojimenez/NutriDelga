<?php
return [
    'components' => [
    	'user' => [
            'identityClass' => 'backend\models\Usuario',
            'enableAutoLogin' => false,
            'identityCookie' => [
                'name' => '_backendUser', // unique for frontend
            ]
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
    'language' => 'es-MX',
];
