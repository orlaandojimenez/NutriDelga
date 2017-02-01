<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'language' => 'es-MX',
        'pdf' => [
            'class' => kartik\mpdf\Pdf::classname(),
            'format' => kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => kartik\mpdf\Pdf::DEST_BROWSER,
            // refer settings section for all configuration options
        ],
        /*'docGenerator' =>[
            'class' => 'eold\apidocgen\src\ApiDocGenerator',
            'isActive'=>true,                      // Flag to set plugin active
            'versionRegexFind'=>'/(\w+)(\d+)/i',   // regex used in preg_replace function to find Yii api version format (usually 'v1', 'vX') ... 
            'versionRegexReplace'=>'${2}.0.0',     // .. and replace it in Apidoc format (usually 'x.x.x')
            'docDataAlias'=>'@runtime/data_path'   // Folder to save output. make sure is writable. 
        ],*/
    ],

];
