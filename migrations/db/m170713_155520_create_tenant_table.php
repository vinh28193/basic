<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `{{%tenant}}`.
 */
class m170713_155520_create_tenant_table extends Migration
{

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%tenant}}', [
            'tenant_id' => $this->primaryKey(),
            'tenant_code' => $this->string(512)->notNull(),
            'tenant_name' => $this->string(12)->notNull(),
            'tenant_name_short' => $this->string(12)->notNull(),
            'language_code' => $this->string(12)->notNull(),
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
        $this->dropTable('{{%tenant}}');
    }
}