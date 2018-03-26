<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `{{%user_log}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%application}}`
 * - `{{%user}}`
 */
class m170713_162012_create_user_log_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user_log}}', [
            'id' => $this->primaryKey(),
            'app_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ], $this->tableOptions);

        // creates index for column `app_id`
        $this->createIndex(
            'idx-user_log-app_id',
            '{{%user_log}}',
            'app_id'
        );

        // add foreign key for table `{{%application}}`
        $this->addForeignKey(
            'fk-user_log-app_id',
            '{{%user_log}}',
            'app_id',
            '{{%application}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_log-user_id',
            '{{%user_log}}',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_log-user_id',
            '{{%user_log}}',
            'user_id',
            'user',
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
            'fk-user_log-user_id',
            '{{%user_log}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_log-user_id',
            '{{%user_log}}'
        );
        
        // drops foreign key for table `{{%application}}`
        $this->dropForeignKey(
            'fk-user_log-app_id',
            '{{%user_log}}'
        );

        // drops index for column `app_id`
        $this->dropIndex(
            'idx-user_log-app_id',
            '{{%user_log}}'
        );

        $this->dropTable('{{%user_log}}');
    }
}
