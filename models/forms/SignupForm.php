<?php
namespace app\models\forms;

use Yii;
use app\models\User;
use app\common\web\Model;

/**
 * Class SignupForm
 * @package app\models\forms
 */
class SignupForm extends Model
{
    public $firstName;
    public $lastName;
    public $username;
    public $password;
    public $passwordRepeat;
    public $email;
    public $birthday;
    public $gender;
    public $policy = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [
                [
                    'firstName',
                    'lastName',
                    'username',
                    'email',
                    'password',
                    'passwordRepeat',
                    'birthday',
                ]
                ,'required'
            ],
            [
                [
                    'firstName',
                    'lastName',
                    'username',
                    'email',
                    'passwordRepeat',
                ],'string', 'min' => 2, 'max' => 255
            ],
            [
                [
                    'username',
                    'email',
                ], 'unique', 'targetClass' => User::className()
            ],
            ['passwordRepeat', 'compare', 'compareAttribute'=>'password'],
            ['email', 'email'],
            //['birthday','date'],
            ['gender','integer'],
            ['policy', 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return[
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'username' => 'Username',
            'password' => 'Password',
            'password_repeat' => 'Password Repeat',
            'email' => 'Email',
            'birthday' => 'Birthday',
            'gender' => 'Gender',
            'policy' => 'Policy',
        ];
    }

    public function signup(){

        if (!$this->validate()) {
            return false;
        }
        
        return true;

    }
}
