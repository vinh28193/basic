<?php 
namespace app\common\web;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use yii\base\InvalidConfigException;

/**
 * User is the class for the `user` application component that manages the user authentication status.
 * ```php
 * 'user' => [
 *	   'db' => 'mydb',
 *     'userAccessTable' => '{{%user_access_log}}',
 *     // ...
 * ]
 * ```
 *
 * @property string|int $id The unique identifier for the user. If `null`, it means the user is a guest. This
 * property is read-only.
 * @property IdentityInterface|null $identity The identity object associated with the currently logged-in
 * user. `null` is returned if the user is not logged in (not authenticated).
 * @property bool $isGuest Whether the current user is a guest. This property is read-only.
 * @property string $returnUrl The URL that the user should be redirected to after login. Note that the type
 * of this property differs in getter and setter. See [[getReturnUrl()]] and [[setReturnUrl()]] for details.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class User extends \yii\web\User
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),[

            ]
        );
    }

}
 ?>
