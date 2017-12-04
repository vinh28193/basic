<?php 
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\common\web;

use Yii;
use yii\base\Object
use yii\web\IdentityInterface;
use yii\base\InvalidConfigException;

/**
 * UserIdentity is a class for the user identity on application
 */

class UserIdentity extends Object implements IdentityInterface
{

   	public $id;
    public $username;
    public $email;
    public $phone;
    public $auth_key;
    public $password_hash;
    private static $users = [
        100 => [
            'id' => 100,
	        'username' => 'webmaster',
	        'email' => 'webmaster@example.org',
	        'phone' => '0123456789',
	        'auth_key' => 'authKey100',
	        'password_hash' => 'webmaster',
        ],
        101 => [
        	'id' => 101,
            'username' => 'manager',
	        'email' => 'manager@example.org',
	        'phone' => '0000-000-000',
	        'auth_key' => 'authKey101',
	        'password_hash' => 'manager',
        ],
        102 => [
        	'id' => 102,
            'username' => 'user',
	        'email' => 'user@example.org',
	        'phone' => '0987654321',
	        'auth_key' => 'authKey102',
	        'password_hash' => 'user',
        ],
    ];

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
    	return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null);

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
    	return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
    	return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
    	return $this->authKey === $authKey;
    }
}