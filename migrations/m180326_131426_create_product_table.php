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
            'creator_id' => $this->integer(),
            'updater_id' => $this->integer(),
            'price' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $this->tableOptions);

        // creates index for column `tenant_id`
        $this->createIndex(
            'idx-product-tenant_id',
            '{{%product}}',
            'tenant_id'
        );

        // add foreign key for table `{{%tenant}}`
        $this->addForeignKey(
            'fk-product-tenant_id',
            '{{%product}}',
            'tenant_id',
            '{{%tenant}}',
            'tenant_id',
            'CASCADE'
        );

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

        // creates index for column `creator_id`
        $this->createIndex(
            'idx-product-creator_id',
            '{{%product}}',
            'creator_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            'fk-product-creator_id',
            '{{%product}}',
            'creator_id',
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
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
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
            'fk-product-creator_id',
            '{{%product}}'
        );

        // drops index for column `creator_id`
        $this->dropIndex(
            'idx-product-creator_id',
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
        
        // drops foreign key for table `{{%tenant}}`
        $this->dropForeignKey(
            'fk-product-tenant_id',
            '{{%product}}'
        );

        // drops index for column `tenant_id`
        $this->dropIndex(
            'idx-product-tenant_id',
            '{{%product}}'
        );

        $this->dropTable('{{%product}}');
    }
}
