<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Inflector;
/* @var $this \yii\web\View */
/* @var $content string */
$this->params['showBack'] =  false;
$this->params['bodyClass'] = 'hold-transition skin-blue sidebar-mini';
$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= $this->title ? Html::encode($this->title) : Yii::$app->name ?></title>
    <?php $this->head() ?>
</head>
<body class="<?=$this->params['bodyClass']?>">
<?php $this->beginBody() ?>
<div class="wrapper">
    <?= $this->render('header.php') ?>
    <?= $this->render('left.php')?>
    <div class="content-wrapper">
        <section class="content-header">
            <?php if (isset($this->blocks['content-header'])) { ?>
                <h1><?= $this->blocks['content-header'] ?></h1>
            <?php } else { ?>
                <h1>
                    <?php
                    if ($this->title !== null) {
                        echo Html::encode($this->title);
                    } else {
                        echo Inflector::camel2words(
                            Inflector::id2camel($this->context->module->id)
                        );
                        echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                    } ?>
                </h1>
            <?php } ?>

        <?=Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
        ]) ?>
        </section>

        <section class="content">
        <?= $content ?>
        </section>
    </div>
    <?=$this->render('footer');?>

    <?= $this->render('right.php')?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>