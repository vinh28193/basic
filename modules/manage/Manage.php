<?php

namespace app\modules\manage;
use yii\helpers\ArrayHelper;
use yii\base\Module;
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
    }
}
