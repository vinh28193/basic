<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m170713_173022_create_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'base_url' => $this->string(1024)->notNull(),
            'path' => $this->string(1024)->notNull(),
            'type' => $this->string(),
            'size' => $this->integer(),
            'upload_by' => $this->integer(),
            'upload_ip' => $this->string(15),
            'status' => $this->integer()->defaultValue(1)->notNull(),
            'created_at' => $this->integer()
        ], $this->tableOptions);

         // creates index for column `base_url`
        $this->createIndex(
            'idx-image-base_url',
            '{{%image}}',
            'base_url'
        );

        // creates index for column `type`
        $this->createIndex(
            'idx-image-type',
            '{{%image}}',
            'type'
        );

        // creates index for column `upload_by`
        $this->createIndex(
            'idx-image-upload_by',
            '{{%image}}',
            'upload_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            'fk-image-upload_by',
            '{{%image}}',
            'upload_by',
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
            'fk-image-upload_by',
            '{{%image}}'
        );

        // drops index for column `upload_by`
        $this->dropIndex(
            'idx-image-upload_by',
            '{{%image}}'
        );

        // drops index for column `type`
        $this->dropIndex(
            'idx-image-type',
            '{{%image}}'
        );

        // drops index for column `base_url`
        $this->dropIndex(
            'idx-image-base_url',
            '{{%image}}'
        );
        $this->dropTable('{{%image}}');
    }
}
