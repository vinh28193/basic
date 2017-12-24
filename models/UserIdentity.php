<?php 
namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use app\models\resources\User;
use app\common\web\UserIdentityTrait;
/**
 * UserIdentity the model behind the user identity about `app\models\User`.
 */
class UserIdentity extends User implements IdentityInterface
{
    use UserIdentityTrait;

    /**
     * Finds user by username or email
     *
     * @param string $value
     * @return static|null
     */
    public static function findAdvanced($value)
    {
        return static::find()->where([
            'and',
            [
                'or',
                ['username' => $value],
                ['email' => $value],
                ['phone' => $value],
            ],
            ['status' => self::ACCESS_GRANTED]
        ])->one();
    }
}