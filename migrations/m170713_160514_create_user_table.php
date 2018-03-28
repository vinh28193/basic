<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m170713_160514_create_user_table extends Migration
{

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'tenant_id' => $this->integer()->notNull(),
            'username' => $this->string(32),
            'email' => $this->string(255),
            'phone' => $this->string(15),
            'oauth_id' => $this->string(20),
            'oauth_secret' => $this->string(40),
            'access_token' => $this->string(100),
            'auth_key' => $this->string(32),
            'password_hash' => $this->string(100),
            'password_reset_token' => $this->string(100),
            'status' => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer(),
            'verified_at' => $this->integer(),
        ], $this->tableOptions);

        // creates index for column `status`
        $this->createIndex(
            'idx-user-status',
            '{{%user}}',
            'status'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        
         // drops index for column `status`
        $this->dropIndex(
            'idx-user-status',
            '{{%user}}'
        );
        
        $this->dropTable('{{%user}}');
    }
}
