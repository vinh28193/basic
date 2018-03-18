<?php

namespace app\modules\mediamanage\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
/**
 * Default controller for the `mediamanage` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $requestUri = Url::to(['/mediamanage/media/index'],true);
        return $this->render('index',[  
            'requestUri' => $requestUri
        ]);
    }
}
