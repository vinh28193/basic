<?php

namespace app\common\db;

/**
 * Connection is the class behind the \yii\db\Connection represents a connection to a database via [PDO]
 */
 class Connection extends \yii\db\Connection
 {	
 	
 	/**
     * Initializes the Connection
     */
 	public function init()
    {
    	parent::init();
        //merge schema map
        $this->schemaMap = \yii\helpers\ArrayHelper::merge($this->schemaMap, [
        	'mysql' => 'app\common\db\mysql\Schema', // MySQL
        ]);
        
    }
}
?>