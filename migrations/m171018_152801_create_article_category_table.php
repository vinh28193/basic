<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `{{%article_category}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%application}}`
 * - `{{%article_category}}`
 */
class m171018_152801_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%article_category}}', [
            'id' => $this->primaryKey(),
            'app_id' => $this->integer()->notNull(),
            'title' => $this->string(512)->notNull(),
            'slug' => $this->string(1024)->notNull(),
            'parent_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $this->tableOptions);
        
         // creates index for column `app_id`
        $this->createIndex(
            'idx-article_category-app_id',
            '{{%article_category}}',
            'app_id'
        );

        // add foreign key for table `{{%application}}`
        $this->addForeignKey(
            'fk-article_category-app_id',
            '{{%article_category}}',
            'app_id',
            '{{%application}}',
            'id',
            'CASCADE'
        );

        // creates index for column `parent_id`
        $this->createIndex(
            'idx-article_category-parent_id',
            '{{%article_category}}',
            'parent_id'
        );
        // add foreign key for table `{{%article_category}}`
        $this->addForeignKey(
            'fk-article_category-parent_id',
            '{{%article_category}}',
            'parent_id',
            '{{%article_category}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `'{{%article_category}}'`
        $this->dropForeignKey(
            'fk-article_category-parent_id',
            '{{%article_category}}'
        );
        // drops index for column `parent_id`
        $this->dropIndex(
            'idx-article_category-parent_id',
            '{{%article_category}}'
        );

        // drops foreign key for table `{{%application}}`
        $this->dropForeignKey(
            'fk-article_category-app_id',
            '{{%article_category}}'
        );

        // drops index for column `app_id`
        $this->dropIndex(
            'idx-article_category-app_id',
            '{{%article_category}}'
        );
        $this->dropTable('{{%article_category}}');
    }
}
