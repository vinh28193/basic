<?php
namespace tests\codeception\fixtures;

use yii\test\ActiveFixture;

/**
 * UserProfile fixture
 * depends UserFixture
 */
class UserProfileFixture extends ActiveFixture
{
    public $modelClass = 'app\models\resources\UserProfile';
    public $depends = [
        'tests\codeception\fixtures\UserFixture'
    ];
}