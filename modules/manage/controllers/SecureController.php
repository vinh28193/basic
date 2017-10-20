<?php

namespace app\modules\manage\controllers;

use Yii;
use app\common\web\AuthHandler;
use app\models\forms\LoginForm;
use app\models\forms\SignupForm;

/**
 * Class SecureController
 * @package app\modules\manage\controllers
 */
class SecureController extends ManageController
{
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if($model->load(Yii::$app->request->post()) && $model->login()){
            return $this->goHome();
        }
        return $this->render('login',[
            'model' => $model
        ]);
    }

     /**
     * @return string|\yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionSignup(){
        if (Yii::$app->user->identity) {
            return $this->goHome();
        }
        $model = new SignupForm();
        if($model->load(Yii::$app->request->post()) && $model->signup()){
            return $this->goHome();
        }
        return $this->render('signup',[
            'model' => $model
        ]);
    }

    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();
    }
}