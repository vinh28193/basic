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
            'passwordRepeat' => 'Password Repeat',
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
        $transaction = $this->connection->beginTransaction();
        try {
            $user = new User;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            if($user->validate() && $user->save()){
                $sql = "INSERT INTO user_profile (user_id,first_name,last_name,birthday,locale,gender) VALUES({$user->id},'{$this->firstName}','{$this->lastName}','{$this->birthday}','en',1)";
                $this->connection->createCommand($sql)->execute();
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
            return false;
        }
        return Yii::$app->user->login($user,User::TIME_EXPIRE);

    }
}
