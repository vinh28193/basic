<?php

namespace app\modules\manage\controllers;

class ErrorController extends ManageController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
