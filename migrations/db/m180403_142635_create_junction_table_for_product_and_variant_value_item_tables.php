<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `{{%product_variant}}`.
 * Has foreign keys to the tables:
 *
 * - `{{product}}`
 * - `{{variant_value_item}}`
 */
class m180403_142635_create_junction_table_for_product_and_variant_value_item_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%product_variant}}', [
            'id' => $this->primaryKey(),
            'tenant_id' => $this->integer()->notNull(),
            'sku' => $this->string(10),
            'title' => $this->string(512)->notNull(),
            'slug' => $this->string(1024)->notNull(),
            'description' => $this->text(),
            'product_id' => $this->integer(),
            'variant_value_item_id' => $this->integer(),
            'thumbnail_base_path' => $this->string(512),
            'thumbnail_path' => $this->string(1024),
            'start_price' => $this->integer(),
            'sell_price' => $this->integer()->notNull(),
            'quantity_available' => $this->integer()->notNull()->defaultValue(0),
            'quantity_sold' => $this->integer()->notNull()->defaultValue(0),
            'visible' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$this->tableOptions);

        // creates index for column `visible`
        $this->createIndex(
            'idx-product_variant-visible',
            '{{%product_variant}}',
            'visible'
        );

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_variant-product_id',
            '{{%product_variant}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            'fk-product_variant-product_id',
            '{{%product_variant}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );

        // creates index for column `variant_value_item_id`
        $this->createIndex(
            'idx-product_variant-variant_value_item_id',
            '{{%product_variant}}',
            'variant_value_item_id'
        );

        // add foreign key for table `{{%variant_value_item}}`
        $this->addForeignKey(
            'fk-product_variant-variant_value_item_id',
            '{{%product_variant}}',
            'variant_value_item_id',
            '{{%variant_value_item}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // drops index for column `visible`
        $this->dropIndex(
            'idx-product_variant-visible',
            '{{%product_variant}}'
        );

        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            'fk-product_variant-product_id',
            '{{%product_variant}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-product_variant-product_id',
            '{{%product_variant}}'
        );

        // drops foreign key for table `{{%variant_value_item}}`
        $this->dropForeignKey(
            'fk-product_variant-variant_value_item_id',
            '{{%product_variant}}'
        );

        // drops index for column `variant_value_item_id`
        $this->dropIndex(
            'idx-product_variant-variant_value_item_id',
            '{{%product_variant}}'
        );

        $this->dropTable('{{%product_variant}}');
    }
}
