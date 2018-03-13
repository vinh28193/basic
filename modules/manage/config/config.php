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
];
 ?>