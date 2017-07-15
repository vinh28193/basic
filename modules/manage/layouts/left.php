<?php
/* @var $this \yii\web\View */
/* @var $content string */
/* @var $identity \app\models\User $identity */
$identity = Yii::$app->user->identity;
use app\common\widgets\lte\AdminLTEMenu;
use app\common\widgets\Gravatar;
 ?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            <?= Gravatar::widget([
                'email'   => Yii::$app->user->identity->email,
                'options' => [
                    'id' => 'gravatar-'.Yii::$app->user->identity->id,
                    'class' => 'img-circle',
                    'alt'   => Yii::$app->user->identity->username,
                ],
                'size'    => 84,
            ]) ?>
            </div>
            <div class="pull-left info">
                <h4><?=Yii::$app->user->identity->username?></h4>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= AdminLTEMenu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'User', 'icon' => 'fa fa-share', 'url' => ['/manage/user']],
                    ['label' => 'Category', 'icon' => 'fa fa-share', 'url' => ['/manage/category']],
                    ['label' => 'Article', 'icon' => 'fa fa-share', 'url' => ['/manage/article']],
                    ['label' => 'Developer Tools', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                ],
            ]
        ) ?>

    </section>

</aside>