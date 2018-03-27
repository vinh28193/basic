<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `{{%user_log}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%tenant}}`
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
            'tenant_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ], $this->tableOptions);

        // creates index for column `tenant_id`
        $this->createIndex(
            'idx-user_log-tenant_id',
            '{{%user_log}}',
            'tenant_id'
        );

        // add foreign key for table `{{%tenant}}`
        $this->addForeignKey(
            'fk-user_log-tenant_id',
            '{{%user_log}}',
            'tenant_id',
            '{{%tenant}}',
            'tenant_id',
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
        
        // drops foreign key for table `{{%tenant}}`
        $this->dropForeignKey(
            'fk-user_log-tenant_id',
            '{{%user_log}}'
        );

        // drops index for column `tenant_id`
        $this->dropIndex(
            'idx-user_log-tenant_id',
            '{{%user_log}}'
        );

        $this->dropTable('{{%user_log}}');
    }
}
