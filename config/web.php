<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'aliases' => [
        '@uploadedFilesDir' => '@app/uploadedFiles'
    ],
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'timeZone' => 'GMT',
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'nz4H_EKn2VnYkbIaXL4ucu1TmDiif-gw',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'dbSqlite' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:' . dirname(__DIR__) . PATH_SEPARATOR . '..' . PATH_SEPARATOR . 'web' . PATH_SEPARATOR .'sqlite.db'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'enableStrictParsing' => true,
            'rules' => [
                'newws/index' => 'newws/index',
                'newws/<year:\d{4}>/items-list' => 'newws/items-list',
                [
                    'pattern' => 'newws/<category:\w+>/items-list',
                    'route' => 'newws/items-list',
                    'defaults' => ['category' => 'shopping'],
                    //'encodeParams' => true
                ],
                [
                    'pattern' => '<lang:\w+>/<controller>/<action>',
                    'route' => '<controller>/<action>'
                ],
                ['class' => 'app\components\NewwsUrlRule']
                //'newws/<category:\w+>/items-list' => 'newws/items-list'
            ]
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*']
    ];
}

return $config;
