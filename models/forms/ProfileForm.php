<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/26/2017
 * Time: 15:56
 */

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\UserProfile;
use yii\db\Exception;

/**
 * Class ProfileForm
 * @package app\models\forms
 * @property string $password
 * @property string $email
 * @property string $firstName
 * @property string $middleName
 * @property string $avatar
 * @property string $address
 * @property string $phone
 * @property string $birthday
 * @property string $bio
 *
 *
 * @property integer $userId read-only
 * @property integer $publicIdentity read-only
 */
class ProfileForm extends Model
{
    public $password;
    public $email;
    public $firstName;
    public $middleName;
    public $lastName;
    public $avatar;
    public $address;
    public $phone;
    public $birthday;
    public $bio;


    /**
     * @var User
     */
    private $_user;
    /**
     * @var UserProfile
     */

    private $_userProfile;

    /**
     * Initializes
     */
    public function init(){
        parent::init();
        $this->_user = Yii::$app->user->identity;
        if($this->_user == null){
            Yii::$app->response->redirect(Yii::$app->user->loginUrl);
        }
        $this->_userProfile = $this->_user->userProfile;
        $this->loadDefaultValue();
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // passwordConfim and passwordHash are both required
            ['passwordConfim', 'required'],
            ['passwordConfim', 'validatePasswordConfim'],
        ];
    }
    public function complete(){

    }

    public function validatePasswordConfim($attribute, $params){

    }

    public function loadDefaultValue(){
        $this->email = $this->_user->email;
        $this->firstName = $this->_userProfile->first_name;
        $this->lastName = $this->_userProfile->last_name;
        $this->birthday = $this->_userProfile->birthday;
        //all attribute
        $this->avatar = $this->_userProfile->getAvatarAlias();
    }

    /**
     * @return int
     */
    public function getUserId(){
        return $this->_user->id;
    }

    /**
     * @return string
     */
    public function getPublicIdentity(){
        return $this->_user->publicIdentity;
    }
}