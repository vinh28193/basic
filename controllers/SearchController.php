<?php

namespace app\controllers;

use Yii;
use app\models\GlobalSearch;

class SearchController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new GlobalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
