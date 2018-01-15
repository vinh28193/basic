<?php 
namespace app\common\db;

/**
 *  Migration is the class behind the the \yii\db\Migration representing a database migration.
 */
 class Migration extends \yii\db\Migration
 {
 	/**
	* @var string
 	*/
 	public $tableOptions = null;

 	 /**
     * Initializes the migration.
     */
    public function init()
    {
        parent::init();
        if ($this->db->driverName === 'mysql' &&  $this->tableOptions === null) {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
    }

    /**
     * calling and execute createTable().
     *
     * @param string $table the name of the table to be created. The name will be properly quoted by the method.
     * @param array $columns the columns (name => definition) in the new table..
     */
    public function newTable($table, $columns)
    {
        $this->createTable($table, $columns, $this->tableOptions);
    }
 } 
 ?>