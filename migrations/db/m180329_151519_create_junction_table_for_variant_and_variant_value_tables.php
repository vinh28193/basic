<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `variant_value_item`.
 * Has foreign keys to the tables:
 *
 * - `{{%variant}}`
 * - `{{%variant_value}}`
 */
class m180329_151519_create_junction_table_for_variant_and_variant_value_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%variant_value_item}}', [
            'id' => $this->primaryKey(),
            'tenant_id' => $this->integer()->notNull(),
            'variant_id' => $this->integer()->notNull(),
            'variant_value_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
        ],$this->tableOptions);

        // creates index for column `variant_id`
        $this->createIndex(
            'idx-variant_value_item-variant_id',
            '{{%variant_value_item}}',
            'variant_id'
        );

        // add foreign key for table `{{%variant}}`
        $this->addForeignKey(
            'fk-variant_value_item-variant_id',
            '{{%variant_value_item}}',
            'variant_id',
            '{{%variant}}',
            'id',
            'CASCADE'
        );

        // creates index for column `variant_value_id`
        $this->createIndex(
            'idx-variant_value_item-variant_value_id',
            '{{%variant_value_item}}',
            'variant_value_id'
        );

        // add foreign key for table `{{%variant_value}}`
        $this->addForeignKey(
            'fk-variant_value_item-variant_value_id',
            '{{%variant_value_item}}',
            'variant_value_id',
            '{{%variant_value}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `{{%variant}}`
        $this->dropForeignKey(
            'fk-variant_value_item-variant_id',
            '{{%variant_value_item}}'
        );

        // drops index for column `variant_id`
        $this->dropIndex(
            'idx-variant_value_item-variant_id',
            '{{%variant_value_item}}'
        );

        // drops foreign key for table `{{%variant_value}}`
        $this->dropForeignKey(
            'fk-variant_value_item-variant_value_id',
            '{{%variant_value_item}}'
        );

        // drops index for column `variant_value_id`
        $this->dropIndex(
            'idx-variant_value_item-variant_value_id',
            '{{%variant_value_item}}'
        );

        $this->dropTable('variant_value_item');
    }
}
