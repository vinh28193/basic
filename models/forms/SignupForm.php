<?php
namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\db\Exception;
use app\models\resources\User;
use app\models\resources\UserProfile;

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

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function signup(){

        if (!$this->validate()) {
            return false;
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $user = new User;
            $user->setScenario(User::SCENARIO_REGISTER);
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            if($user->validate() && $user->save()){
                $profile = new UserProfile();
                $profile->setScenario(UserProfile::SCENARIO_INIT);
                $profile->user_id = $user->id;
                $profile->first_name = $this->firstName;
                $profile->last_name = $this->lastName;
                $user->link('userProfile',$profile);
            }
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            return false;
        }
        return Yii::$app->user->login($user,User::TIME_EXPIRE);

    }
}
