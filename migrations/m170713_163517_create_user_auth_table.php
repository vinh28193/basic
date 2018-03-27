<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_auth}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%tenant}}`
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
            'tenant_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'source_id' => $this->string(32)->notNull(),
            'source' => $this->string(100)->notNull(),
        ]);

        // creates index for column `tenant_id`
        $this->createIndex(
            'idx-user_auth-tenant_id',
            '{{%user_auth}}',
            'tenant_id'
        );

        // add foreign key for table `{{%tenant}}`
        $this->addForeignKey(
            'fk-user_auth-tenant_id',
            '{{%user_auth}}',
            'tenant_id',
            '{{%tenant}}',
            'tenant_id',
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

        // drops foreign key for table `{{%tenant}}`
        $this->dropForeignKey(
            'fk-user_auth-tenant_id',
            '{{%user_auth}}'
        );

        // drops index for column `tenant_id`
        $this->dropIndex(
            'idx-user_auth-tenant_id',
            '{{%user_auth}}'
        );

        $this->dropTable('{{%user_auth}}');
    }
}
