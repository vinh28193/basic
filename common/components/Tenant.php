<?php

namespace app\common\components;

use yii\web\NotFoundHttpException;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Exception;
/**
 * Class Tenant
 * @package proseeds\base
 */
class Tenant extends Component implements BootstrapInterface
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
    
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            
        } elseif ($app instanceof \yii\console\Application) {
        
        }
    }

    /**
     * initialize member
     */
    public function getTenant()
    {
        if(isset($this->_tenant)) return $this->_tenant;
        $this->_tenant = \app\models\resources\Tenant::findOne(['tenant_code' => $this->tenantCode]);

        if(!$this->_tenant){
            throw new NotFoundHttpException('tenant "'. self::getTenantCode().'" can not be found.');
        }
        return $this->_tenant;
    }

    public function setTenant($tenantId)
    {
        $this->_tenant =\app\models\resources\Tenant::findOne(['tenant_id' => $tenantId]);
        if(!$this->_tenant){
            throw new NotFoundHttpException('tenantId "'. $tenantId.'" can not be found.');
        }
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