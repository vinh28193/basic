<?php

namespace app\modules\manage;

use Yii;
use yii\base\Module;
use yii\helpers\ArrayHelper;
/**
 * manage module definition class
 */
class Manage extends Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\manage\controllers';
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
        $this->defaultRoute = 'default/index';
        $this->layout = 'manage';
        $this->setAliases(['@manage' => __DIR__]);
        $this->setLayoutPath('@manage/layouts');
        $config = require Yii::getAlias('@manage/config/config.php');
        Yii::configure(Yii::$app, $config);
    }
}
