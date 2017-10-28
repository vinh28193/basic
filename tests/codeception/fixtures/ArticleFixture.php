<?php
namespace tests\codeception\fixtures;

use yii\test\ActiveFixture;

/**
 * ArticleFixture fixture
 * depends
 *	  UserFixture
 *	  ArticleCategoryFixture
 */
class ArticleFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Article';
    public $depends = [
        'tests\codeception\fixtures\UserFixture',
        'tests\codeception\fixtures\ArticleCategoryFixture',
    ];
}