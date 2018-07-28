<?php
/**
 * Created by PhpStorm.
 * User: vinhs
 * Date: 2018-07-28
 * Time: 22:09
 */

return [
    'client' => [
        'baseUrl' => \yii\helpers\BaseUrl::base(true)
    ],
    'log' => [
        'traceLevel' => (YII_DEBUG) ? 'DEBUG' : 'INFO',
        'text' => [
            'error.default' => Yii::t('log', 'An unexpected error occurred. If this keeps happening, please contact a site administrator.'),
            'success.saved' => Yii::t('log', 'Saved'),
            'saved' => Yii::t('log', 'Saved'),
            'success.edit' => Yii::t('log', 'Saved'),
            0 => Yii::t('log', 'An unexpected error occurred. If this keeps happening, please contact a site administrator.'),
            403 => Yii::t('log', 'You are not allowed to run this action.'),
            404 => Yii::t('log', 'The requested resource could not be found.'),
            405 => Yii::t('log', 'Error while running your last action (Invalid request method).'),
            500 => Yii::t('log', 'An unexpected server error occurred. If this keeps happening, please contact a site administrator.')
        ]
    ],
];