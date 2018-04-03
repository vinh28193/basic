<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `{{%variant_value}}`.
 */
class m180329_151011_create_variant_value_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%variant_value}}', [
            'id' => $this->primaryKey(),
            'tenant_id' => $this->integer()->notNull(),
            'value' => $this->string(64)->notNull(),
            'visible' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],  $this->tableOptions);

        // creates index for column `visible`
        $this->createIndex(
            'idx-variant_value-visible',
            '{{%variant_value}}',
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
            'idx-variant_value-visible',
            '{{%variant_value}}'
        );

        $this->dropTable('{{%variant_value}}');
    }
}
