<?php

namespace app\modules\manage\controllers;

class UserController extends ManageController
{
    public function actionInfo()
    {
        return $this->render('info');
    }

}
