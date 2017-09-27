<?php
use yii\helpers\Html;
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
                <?=Html::img($identity->avatarPath,['class' => 'img-circle','alt' => $identity->publicIdentity])?>
            </div>
            <div class="pull-left info">
                <p><?=$identity->userProfile->first_name;?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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