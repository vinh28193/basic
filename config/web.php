<?php

$db = require(__DIR__ . '/db.php');
$urlManager = require(__DIR__ . '/urlManager.php');
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'Dev App',
    'version' => '0.1-dev',
    'charset' => 'UTF-8',
    'language' => 'en-US',
    'sourceLanguage' => 'en-US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'menuManager'
    ],
    'components' => [
        'request' => [
            'class' => 'yii\web\Request',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '4DRPNeVNJRNcfuxWF2cvZPO1AVCxH3a0',
        ],
        'response' => [
            'class' => 'yii\web\Response',
        ],
        'session' => [
            'class' => 'yii\web\Session',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'app\common\web\User',
            'identityClass' => 'app\models\UserIdentity',
            'loginUrl' => ['manage/secure/login'],
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity-user', 
                'httpOnly' => true
            ],
        ],
        'errorHandler' => [
            'class' => 'yii\web\ErrorHandler',
            'errorAction' => 'manage/error',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'class' => 'yii\log\Dispatcher',
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'categories' => [
                        'yii\db\*',
                        'yii\i18n\*',
                        'yii\web\HttpException:*',
                    ],
                    'except' => [
                        'yii\web\HttpException:404',
                    ],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => $urlManager,
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'appendTimestamp' => false,
            'hashCallback' => function ($path) {
                //return implode('/',[Yii::$app->id,hash('md4', $path)]);
                return hash('md4', $path);
            }
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@messages',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii/messages',
                    'fileMap' => [
                        'yii' => 'yii.php',
                    ],
                ],
            ],
        ],
        'menuManager' => [
            'class' => 'app\common\web\MenuManager',
            'collections' => [
                'frontMenu' => [
                    'class' => 'app\common\web\MainMenu'
                ],
                'articleCategory' => [
                    'class' => 'app\models\resources\ArticleCategory'
                ]
            ]
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '745003465706631',
                    'clientSecret' => '7c7ac46ea2e6a6a84b39fcbcdd69a9d5',
                ],
            ],
        ]
    ],
    'defaultRoute' => 'site/index',
    'modules' => [
        'manage' => [
            'class' => 'app\modules\manage\Manage',
        ],
        'maintenance' => [
            'class' => 'app\modules\maintenance\Maintenance',
        ],
        'api' => [
            'class' => 'app\modules\api\Service',
        ],
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.83.*'],
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.83.*'],
        ]
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
    ];
}

return $config;
