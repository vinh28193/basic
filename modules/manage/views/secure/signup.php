<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\forms\SignupForm */
$this->title = 'Register';
$css = <<<CSS
    .ms-padding-right{padding-right: 5px;}
    .ms-padding-left{padding-left: 5px;}
CSS;
$this->registerCss($css);
?>
<div class="register-box">
    <div class="login-logo">
        <?= Html::a(Yii::$app->name,Yii::$app->homeUrl)?>
    </div><!-- /.login-logo -->
    <div class="register-box-body">
        <p class="register-box-msg"><b><?=Html::encode($this->title)?></b></p>
        <div class="row"> 
            <div class="col-md-12">
            <?php
                $form = ActiveForm::begin([
                    'id' => 'register-form',
                    'method' => 'post',
                    'action' => ['secure/signup'],
                ]);
            ?>
                <div class="row">
                    <div class="col-md-6 ms-padding-right">
                        <?php 
                            echo $form->field($model,'firstName',[
                                'options' => [
                                    'tag' => 'div',
                                    'class' =>'form-group has-feedback'
                                ],
                                'template'=> '{input}<span class="glyphicon glyphicon-pencil form-control-feedback"></span>{error}{hint}'
                            ])->textInput([
                                'class'=>'form-control',
                                'placeholder' => $model->getAttributeLabel('firstName')
                            ])->label(false);
                         ?>
                    </div>
                    <div class="col-md-6 ms-padding-left">
                        <?php 
                            echo $form->field($model,'lastName',[
                                'options' => [
                                    'tag' => 'div',
                                    'class' =>'form-group has-feedback'
                                ],
                                'template'=> '{input}<span class="glyphicon glyphicon-pencil form-control-feedback"></span>{error}{hint}'
                            ])->textInput([
                                'class'=>'form-control',
                                'placeholder' => $model->getAttributeLabel('lastName')
                            ])->label(false);
                         ?>                
                    </div>
                </div>
            <?php
                echo $form->field($model,'username',[
                    'options' => [
                        'tag' => 'div',
                        'class' =>'form-group has-feedback'
                    ],
                    'template'=> '{input}<span class="glyphicon glyphicon-user form-control-feedback"></span>{error}{hint}'
                ])->textInput([
                    'class'=>'form-control',
                    'placeholder' => $model->getAttributeLabel('username')
                ])->label(false);
                echo $form->field($model,'password',[
                    'options' => [
                        'tag' => 'div',
                        'class' =>'form-group has-feedback',
                    ],
                    'template'=> '{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>{error}{hint}'
                ])->passwordInput([
                    'class'=>'form-control',
                    'placeholder' => $model->getAttributeLabel('password')
                ])->label(false);
                echo $form->field($model,'passwordRepeat',[
                    'options' => [
                        'tag' => 'div',
                        'class' =>'form-group has-feedback',
                    ],
                    'template'=> '{input}<span class="glyphicon glyphicon-log-in form-control-feedback"></span>{error}{hint}'
                ])->passwordInput([
                    'class'=>'form-control',
                    'placeholder' => $model->getAttributeLabel('passwordRepeat')
                ])->label(false);
                echo $form->field($model,'email',[
                    'options' => [
                        'tag' => 'div',
                        'class' =>'form-group has-feedback',
                    ],
                    'template'=> '{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span>{error}{hint}'
                ])->textInput([
                    'class'=>'form-control',
                    'placeholder' => $model->getAttributeLabel('email')
                ])->label(false);
                echo $form->field($model,'birthday',[
                    'options' => [
                        'tag' => 'div',
                        'class' =>'form-group has-feedback'
                    ],
                    'template'=> '{input}<span class="glyphicon glyphicon-calendar form-control-feedback"></span>{error}{hint}'
                ])->widget(DatePicker::classname(), [
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => [
                        'placeholder' => $model->getAttributeLabel('birthday'),
                    ],
                    'pluginOptions' => [
                        'autoclose'=>true
                    ]
                ])->label(false);
                
                echo Html::submitButton('Sign Up', ['class' => 'btn btn-primary btn-block btn-flat', 'id' => 'signup-button']);
                ActiveForm::end();
            ?>
            
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?=Html::a('I already have a membership',['secure/login'],['class' => 'text-center'])?>
            </div>
            
        </div>
    </div>
    <!-- /.form-box -->
</div>