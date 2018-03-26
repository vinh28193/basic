<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `{{%media}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%application}}`
 * - `{{%user}}`
 */
class m170713_173022_create_media_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%media}}', [
            'id' => $this->primaryKey(),
            'app_id' => $this->integer()->notNull(),
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

         // creates index for column `app_id`
        $this->createIndex(
            'idx-media-app_id',
            '{{%media}}',
            'app_id'
        );

        // add foreign key for table `{{%application}}`
        $this->addForeignKey(
            'fk-media-app_id',
            '{{%media}}',
            'app_id',
            '{{%application}}',
            'id',
            'CASCADE'
        );

        // creates index for column `type`
        $this->createIndex(
            'idx-media-type',
            '{{%media}}',
            'type'
        );

        // creates index for column `upload_by`
        $this->createIndex(
            'idx-media-upload_by',
            '{{%media}}',
            'upload_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            'fk-media-upload_by',
            '{{%media}}',
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
            'fk-media-upload_by',
            '{{%media}}'
        );

        // drops index for column `upload_by`
        $this->dropIndex(
            'idx-media-upload_by',
            '{{%media}}'
        );

        // drops index for column `type`
        $this->dropIndex(
            'idx-media-type',
            '{{%media}}'
        );

        // drops foreign key for table `{{%application}}`
        $this->dropForeignKey(
            'fk-media-app_id',
            '{{%media}}'
        );

        // drops index for column `app_id`
        $this->dropIndex(
            'idx-media-app_id',
            '{{%media}}'
        );

        $this->dropTable('{{%media}}');
    }
}
