<?php

namespace app\common\components;

use yii\web\NotFoundHttpException;
use yii\base\Component;
use yii\base\Exception;
/**
 * Class Tenant
 * @package proseeds\base
 */
class Tenant extends Component
{

    public $tenantModel = '';
    /**
     * @var \proseeds\models\Tenant
     */
    protected $_tenant;
    /**
     * @var
     */
    public $exclude = [];
    /**
     * initialize member
     */
    public function getTenant()
    {
        if(isset($this->_tenant)) return $this->_tenant;
        //$this->_tenant = \app\models\resources\Tenant::findOne(['tenant_code' => $this->tenantCode]);
        $this->_tenant = \app\models\resources\Tenant::findOne(['tenant_code' => 'basic.beta.vn']);
        if(!$this->_tenant){
            throw new NotFoundHttpException('tenant "'. self::getTenantCode().'" can not be found.');
        }
        return $this->_tenant;
    }
    /**
     * @return mixed
     * @throws Exception
     */
    public function getTenantCode()
    {
        if (isset($_SERVER['HTTP_HOST'])) {
            $host = $_SERVER['HTTP_HOST'];
        } else if(isset($_SERVER['HOSTNAME'])) {
            $host = $_SERVER['HOSTNAME'];
        } else {
            $host = $_SERVER['SERVER_NAME'];
        }
        return $host;
        /*
        if (!preg_match('/^([\w-]+)\./', $host, $matches)) {
            throw new NotFoundHttpException('tenant "'. self::getHost().'" can not be found.');
        }
        return $matches[1];*/
    }
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->tenant->{$this->primaryKey};
    }
    /**
     * @return mixed
     */
    public function getExcludeTables()
    {
        return $this->exclude['tables'];
    }
    /**
     * @return mixed
     */
    public function getPrimaryKey()
    {
        return $this->tenant->primaryKey()[0]; //only one
    }
}