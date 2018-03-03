<?php 
namespace app\common\web;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\InvalidValueException;
use Google_Client;
use Google_Service_Oauth2;
use Google_Service_Drive;
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
class GoogleClient extends Component
{

    const AUTHENTICATE = 'beforeLogin';
    const EVENT_AFTER_LOGIN = 'afterLogin';
    const EVENT_BEFORE_LOGOUT = 'beforeLogout';
    const EVENT_AFTER_LOGOUT = 'afterLogout';

    public $clientId = '66763920102-1kvka3jb6999fm55dgv4p9m63jfuvbp6.apps.googleusercontent.com';
    public $clientSecret = 'K7QU5UrYhbZFe2qGYI2duzBs';
    public $redirectUri = 'http://basic.beta.vn/site/oauth';
    public $apiKey = 'AIzaSyDDDl-edLmDOM_Zqeoncj2xW5vMzMk3tNY';
    public $scope = ['mail'];

    public $authenticateParam = 'code';

    private $_client;
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if(!$this->_client){
            $this->_client = $this->createClient();
        }
    }

    

    public function getClient()
    {
        
        return $this->_client;
    }

    public function createClient()
    {
        $client = new Google_Client();
        $client->setApplicationName('Login');
        $client->setClientId($this->clientId);
        $client->setClientSecret($this->clientSecret);
        $client->setRedirectUri($this->redirectUri);
        $client->setDeveloperKey($this->apiKey);
        $client->setAccessType('offline');
        $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
        $client->setIncludeGrantedScopes(true);
        return $client;
    }

    private $_accessToken;

    public function fetchAccessToken()
    {
        $code = $_GET[$this->authenticateParam];
        $client = $this->_client;
        $client->authenticate($code);
        $this->_accessToken =  $client->getAccessToken();
        return $this->_accessToken;
    }

    public function login($accessToken)
    {
        $this->fetchAccessToken();
    }
}
 ?>
