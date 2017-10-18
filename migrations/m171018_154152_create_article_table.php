<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%article_category}}`
 * - `{{%user}}`
 */
class m171018_154152_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(512)->notNull(),
            'slug' => $this->string(1024)->notNull(),
            'short_description' => $this->string(1024),
            'description' => $this->text(),
            'body' => $this->text(),
            'view' => $this->integer(),
            'category_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(1)->notNull(),
            'published_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $this->tableOptions);

        // creates index for column `author_id`
        $this->createIndex(
            'idx-article-author_id',
            '{{%article}}',
            'author_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            'fk-article-author_id',
            '{{%article}}',
            'author_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updater_id`
        $this->createIndex(
            'idx-article-updater_id',
            '{{%article}}',
            'updater_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            'fk-article-updater_id',
            '{{%article}}',
            'updater_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            'idx-article-category_id',
            '{{%article}}',
            'category_id'
        );

        // add foreign key for table `{{%article_category}}`
        $this->addForeignKey(
            'fk-article-category_id',
            '{{%article}}',
            'category_id',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-article-author_id',
            '{{%article}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-article-author_id',
            '{{%article}}'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-article-updater_id',
            '{{%article}}'
        );

        // drops index for column `updater_id`
        $this->dropIndex(
            'idx-article-updater_id',
            '{{%article}}'
        );

        // drops foreign key for table `article_category`
        $this->dropForeignKey(
            'fk-article-category_id',
            '{{%article}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-article-category_id',
            '{{%article}}'
        );

        $this->dropTable('{{%article}}');
    }
}
