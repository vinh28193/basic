<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `%product`.
 * Has foreign keys to the tables:
 *
 * - `{{%tenant}}`
 * - `{{%category}}`
 * - `{{%user}}`
 */
class m180326_131426_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'tenant_id' => $this->integer()->notNull(),
            'sku' => $this->string(10),
            'title' => $this->string(512)->notNull(),
            'slug' => $this->string(1024)->notNull(),
            'description' => $this->text(),
            'category_id' => $this->integer()->notNull(),
            'seller_id' => $this->integer(),
            'updater_id' => $this->integer(),
            'thumbnail_base_path' => $this->string(512),
            'thumbnail_path' => $this->string(1024),
            'start_price' => $this->integer(),
            'sell_price' => $this->integer()->notNull(),
            'quantity_available' => $this->integer()->notNull()->defaultValue(0),
            'quantity_sold' => $this->integer()->notNull()->defaultValue(0),
            'deal_time' => $this->integer(),
            'condition_id' => $this->integer(),
            'is_free_shipping' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $this->tableOptions);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-product-category_id',
            '{{%product}}',
            'category_id'
        );

        // add foreign key for table `{{%category}}`
        $this->addForeignKey(
            'fk-product-category_id',
            '{{%product}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );

        // creates index for column `seller_id`
        $this->createIndex(
            'idx-product-seller_id',
            '{{%product}}',
            'seller_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            'fk-product-seller_id',
            '{{%product}}',
            'seller_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updater_id`
        $this->createIndex(
            'idx-product-updater_id',
            '{{%product}}',
            'updater_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            'fk-product-updater_id',
            '{{%product}}',
            'updater_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `status`
        $this->createIndex(
            'idx-product-status',
            '{{%product}}',
            'status'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        // drops index for column `status`
        $this->dropIndex(
            'idx-product-status',
            '{{%product}}'
        );
        
         // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            'fk-product-updater_id',
            '{{%product}}'
        );

        // drops index for column `updater_id`
        $this->dropIndex(
            'idx-product-updater_id',
            '{{%product}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            'fk-product-seller_id',
            '{{%product}}'
        );

        // drops index for column `seller_id`
        $this->dropIndex(
            'idx-product-seller_id',
            '{{%product}}'
        );

        // drops foreign key for table `{{%category}}`
        $this->dropForeignKey(
            'fk-product-category_id',
            '{{%product}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-product-category_id',
            '{{%product}}'
        );

        $this->dropTable('{{%product}}');
    }
}
