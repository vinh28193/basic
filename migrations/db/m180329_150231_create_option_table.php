<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `{{%option}}`.
 */
class m180329_150231_create_option_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%option}}', [
            'id' => $this->primaryKey(),
            'tenant_id' => $this->integer()->notNull(),
            'name' => $this->string(32)->notNull(),
            'alias' => $this->string(64)->notNull(),
            'visible' =>$this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $this->tableOptions);

        // creates index for column `visible`
        $this->createIndex(
            'idx-option-visible',
            '{{%option}}',
            'visible'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops index for column `visible`
        $this->dropIndex(
            'idx-variant-visible',
            '{{%option}}'
        );

        $this->dropTable('{{%option}}');
    }
}
