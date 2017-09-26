<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model \app\models\forms\LoginForm */
$this->title = 'Pls Login';
?>
<div class="login-box">
    <div class="login-logo">
        <?= Html::a(Yii::$app->name,Yii::$app->homeUrl)?>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="register-box-msg"><b><?=Html::encode($this->title)?></b></p>
        <div class="nav-tabs-custom">
            <?php
            $form = ActiveForm::begin([
                'id' => 'login-form',
                'method' => 'post',
                'action' => ['secure/login'],
            ]);
            echo $form->field($model,'loginId',[
                'options' => [
                    'tag' => 'div',
                    'class' =>'form-group has-feedback'
                ],
                'template'=> '{input}<span class="glyphicon glyphicon-user form-control-feedback"></span>{error}{hint}'
            ])->textInput([
                'class'=>'form-control',
                'placeholder' => $model->getAttributeLabel('login_id')
            ])->label(false);
            echo $form->field($model,'passwordHash',[
                'options' => [
                    'tag' => 'div',
                    'class' =>'form-group has-feedback',
                ],
                'template'=> '{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>{error}{hint}'
            ])->passwordInput([
                'class'=>'form-control',
                'placeholder' => $model->getAttributeLabel('password')
            ])->label(false);
            echo $form->field($model,'rememberMe')->checkbox(['class'=>'icheck']);
            echo Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'id' => 'login-button']);
            ActiveForm::end(); ?>
        </div>
        <?=Html::a('I dont have a membership',['secure/signup'],['class' => 'text-center'])?>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->