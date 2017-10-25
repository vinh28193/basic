<?php

namespace app\modules\api;

use Yii;
use yii\base\Module;
use yii\helpers\ArrayHelper;

/**
 * api module definition class
 */
class Service extends Module
{
   
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
         // custom initialization code goes here
        $this->setAliases(['@api' => __DIR__]);
        // protocol version.
        $this->setVersion('1.0');
        $this->controllerNamespace = 'app\modules\api\controllers';
        $this->defaultRoute = 'default/index';
        $this->layout = false;
        $config = require Yii::getAlias('@api/config/api.php');
        Yii::configure(Yii::$app, $config);
    }
}