<?php

namespace app\modules\mediamanage\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use app\modules\mediamanage\models\Media;
/**
 * Media controller for the `mediamanage` module
 */
class MediaController extends Controller
{
	/**
     * @inheritdoc
     */
	public function init()
	{
		parent::init();
		//$this->layout = false;
	}
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	$provider = new ArrayDataProvider([
 			'allModels' => (new Media)->findAll(Yii::$app->request->queryParams),
            'key' => function($model){
                return $model->id;
            }
 		]);
        return $this->render('index',[
        	'dataProvider' => $provider
        ]);
    }
}