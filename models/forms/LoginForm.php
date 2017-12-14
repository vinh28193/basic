<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\UserIdentity;
/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $loginId;
    public $passwordHash;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // loginId and passwordHash are both required
            [['loginId', 'passwordHash'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // passwordHash is validated by validatePassword()
            ['passwordHash', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->user;
            if (!$user || !$user->validatePasswordHash($this->passwordHash)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->user, $this->rememberMe ? UserIdentity::TIME_EXPIRE : 0);
        }
        return false;
    }

    /**
     * @return UserIdentity|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = UserIdentity::findAdvanced($this->loginId);
        }
        return $this->_user;
    }
}