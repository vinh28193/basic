<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `{{%application}}`.
 */
class m170713_155520_create_application_table extends Migration
{

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%application}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(512)->notNull(),
            'charset' => $this->string(12)->notNull(),
            'language' => $this->string(12)->notNull(),
            'time_zone' => $this->string(12)->notNull(),
            'run_mode' => $this->string(12)->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $this->tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%application}}');
    }
}