<?php

$db = require(__DIR__ . '/db.php');
$urlManager = require(__DIR__ . '/urlManager.php');
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 1,
    'name' => 'Dev App',
    'version' => '0.1-dev',
    'charset' => 'UTF-8',
    'language' => 'en-US',
    'sourceLanguage' => 'en-US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'debug'
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
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\UserIdentity',
            'loginUrl' => ['site/login'],
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
            'appendTimestamp' => true,
            'hashCallback' => function ($path) {
                //return implode('/',[Yii::$app->id,hash('md4', $path)]);
                return hash('md4', $path);
            }
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'db' => 'db',
                    'sourceLanguage' => 'en-US', // Developer language
                    'sourceMessageTable' => '{{%language_source}}',
                    'messageTable' => '{{%language_translate}}',
                    'cachingDuration' => 86400,
                    'enableCaching' => true,
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
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '745003465706631',
                    'clientSecret' => '7c7ac46ea2e6a6a84b39fcbcdd69a9d5',
                ],
            ],
        ],
        'clientAuth' => [
            'class' => 'app\common\web\GoogleClient',
            'clientId' => '66763920102-1kvka3jb6999fm55dgv4p9m63jfuvbp6.apps.googleusercontent.com',
            'clientSecret' => 'K7QU5UrYhbZFe2qGYI2duzBs',
            'redirectUri' => 'http://basic.beta.vn/site/oauth',
            'apiKey' => 'AIzaSyDDDl-edLmDOM_Zqeoncj2xW5vMzMk3tNY',
            'scope' => ['email']
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
        'mediamanage' => [
            'class' => 'app\modules\mediamanage\MediaManage',
        ],
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['*'],
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*'],
        ],
        'translatemanager' => [
            'class' => 'lajax\translatemanager\Module',       
            'scanRootParentDirectory' => true,                                       
            'layout' => 'language',         
            'scanTimeLimit' => 1200,
        ],
    ],
    'params' => $params,
];

return $config;
