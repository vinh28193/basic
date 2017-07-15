<?php 
namespace app\common\web;

use Yii;
use yii\db\Query;
use yii\di\Instance;
use yii\db\Connection;
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
     * @var Connection|array|string the DB connection object or the application component ID of the DB connection.
     * After the DbSession object is created, if you want to change this property, you should only assign it
     * with a DB connection object.
     * Starting from version 2.0.2, this can also be a configuration array for creating the object.
     */
    public $db = 'db';

    /**
     * @var string the name of the DB table that user access in system.
     * The table should be pre-created as follows:
     *
     * ```sql
     * CREATE TABLE user_log
     * (
     *     id CHAR(40) NOT NULL PRIMARY KEY,
     *     manager_id INTEGER,
     *     data BLOB
     * )
     * ```
     *
     * where 'BLOB' refers to the BLOB-type of your preferred DBMS. Below are the BLOB type
     * that can be used for some popular DBMS:
     *
     * - MySQL: LONGBLOB
     * - PostgreSQL: BYTEA
     * - MSSQL: BLOB
     *
     */
    public $userAccessTable = '{{%user_log}}';


	/**
     * Initializes the DbSession component.
     * This method will initialize the [[db]] property to make sure it refers to a valid DB connection.
     * @throws InvalidConfigException if [[db]] is invalid.
     */
    public function init()
    {
        parent::init();
        $this->db = Instance::ensure($this->db, Connection::className());
    }
}
 ?>
