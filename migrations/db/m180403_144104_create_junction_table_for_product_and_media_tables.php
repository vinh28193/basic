<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_media}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%product}}`
 * - `{{%media}}`
 */
class m180403_144104_create_junction_table_for_product_and_media_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function upS()
    {
        $this->createTable('{{%product_media}}', [
            'id' => $this->primaryKey(),
            'tenant_id' => $this->integer()->notNull(),
            'size' => $this->string(10),
            'product_id' => $this->integer(),
            'media_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `status`
        $this->createIndex(
            'idx-product_media-status',
            '{{%product_media}}',
            'status'
        );

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_media-product_id',
            '{{%product_media}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            'fk-product_media-product_id',
            '{{%product_media}}',
            'product_id',
            '{{product}}',
            'id',
            'CASCADE'
        );

        // creates index for column `media_id`
        $this->createIndex(
            'idx-product_media-media_id',
            '{{%product_media}}',
            'media_id'
        );

        // add foreign key for table `{{%media}}`
        $this->addForeignKey(
            'fk-product_media-media_id',
            '{{%product_media}}',
            'media_id',
            '{{%media}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            'fk-product_media-product_id',
            '{{%product_media}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-product_media-product_id',
            '{{%product_media}}'
        );

        // drops foreign key for table `{{%media}}`
        $this->dropForeignKey(
            'fk-product_media-media_id',
            '{{%product_media}}'
        );

        // drops index for column `media_id`
        $this->dropIndex(
            'idx-product_media-media_id',
            '{{%product_media}}'
        );

        $this->dropTable('{{%product_media}}');
    }
}
