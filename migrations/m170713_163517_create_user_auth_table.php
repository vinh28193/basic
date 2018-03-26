<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_auth}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%application}}`
 * - `{{%user}}`
 */
class m170713_163517_create_user_auth_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user_auth}}', [
            'id' => $this->primaryKey(),
            'app_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'source_id' => $this->string(32)->notNull(),
            'source' => $this->string(100)->notNull(),
        ]);

        // creates index for column `app_id`
        $this->createIndex(
            'idx-user_auth-app_id',
            '{{%user_auth}}',
            'app_id'
        );

        // add foreign key for table `{{%application}}`
        $this->addForeignKey(
            'fk-user_auth-app_id',
            '{{%user_auth}}',
            'app_id',
            '{{%application}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_auth-user_id',
            '{{%user_auth}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            'fk-user_auth-user_id',
            '{{%user_auth}}',
            'user_id',
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
            'fk-user_auth-user_id',
            '{{%user_auth}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_auth-user_id',
            '{{%user_auth}}'
        );

        // drops foreign key for table `{{%application}}`
        $this->dropForeignKey(
            'fk-user_auth-app_id',
            '{{%user_auth}}'
        );

        // drops index for column `app_id`
        $this->dropIndex(
            'idx-user_auth-app_id',
            '{{%user_auth}}'
        );

        $this->dropTable('{{%user_auth}}');
    }
}
