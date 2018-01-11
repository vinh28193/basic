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
            'oauth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin(){
        
        $model = new LoginForm();
        if($model->load(Yii::$app->request->post()) && $model->login()){
            return $this->redirect(['/manage/user/info']);
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
         return $this->redirect(['/manage/secure/login']);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionSignup(){
        if (Yii::$app->user->identity) {
            return $this->redirect(['/manage/user/info']);
        }
        $model = new SignupForm();
        if($model->load(Yii::$app->request->post()) && $model->signup()){
             return $this->redirect(['/manage/user/info']);
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