<?php

namespace app\modules\manage\controllers;

use Yii;
use app\models\User;
use app\models\UserProfile;
use yii\web\NotFoundHttpException;
/**
 * Class UserController
 * @package app\modules\manage\controllers
 */
class UserController extends ManageController
{

    /**
     * @return string
     */
    public function actionInfo()
    {
        return $this->render('info', [
            'model' => $this->getUser(),
        ]);
    }

    /**
     * @var User
     */
    protected function getUser($id = null){
        if(isset($id) && $id != null){
            return User::findIdentity($id);
        }
        return Yii::$app->user->identity;
    }
}
