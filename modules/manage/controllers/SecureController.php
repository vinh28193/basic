<?php

namespace app\modules\manage\controllers;

use Yii;
use app\models\forms\LoginForm;
use app\models\forms\SignupForm;
use app\models\forms\ProfileForm;
class SecureController extends ManageController
{
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
            return $this->redirect('profile');
        }
        return $this->render('signup',[
            'model' => $model
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionProfile(){
        $model = new ProfileForm();
        if($model->load(Yii::$app->request->post()) && $model->complete()){
            return $this->goHome();
        }
        return $this->render('profile',[
            'model' => $model
        ]);
    }
}