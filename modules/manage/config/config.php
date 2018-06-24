<?php 
return [
	'components' => [
        'session' => [
            'class' => 'yii\web\Session',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\UserIdentity',
            'loginUrl' => 'manage/secure/login',
            'returnUrl' => 'manage/user/info',
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
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@kvgrid/messages',
                'forceTranslation' => true
            ]
        ],
        'gridviewKrajee' =>  [
            'class' => '\kartik\grid\Module',
            // your other grid module settings
        ]
    ]
];
 ?>