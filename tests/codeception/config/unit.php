<?php
/**
 * Application configuration for unit tests
 */
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../../config/web.php'),
    require(__DIR__ . '/config.php'),
    [
	'controllerMap' => [
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
            'fixtureDataPath' => '@tests/codeception/unit/fixtures',
            'templatePath' => '@tests/codeception/unit/templates',
            'namespace' => 'tests\codeception\fixtures',
        ],
    ],
    ]
);
