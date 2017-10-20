<?php

use app\common\db\Migration;

/**
 * Handles the creation of table `{{$user_profile}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m170713_161743_create_user_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user_profile}}', [
            'user_id' => $this->integer()->notNull()->append('PRIMARY KEY'),
            'first_name' => $this->string(100)->notNull(),
            'last_name' => $this->string(100)->notNull(),
            'avatar_path' => $this->string(),
            'avatar_base_url' => $this->string(),
            'identity_code' => $this->string(15),
            'birthday' => $this->string(12),
            'address' => $this->string(100),
            'bio'=> $this->text(),
            'locale' => $this->string(32),
            'gender' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $this->tableOptions);

         // creates index for column `locale`
        $this->createIndex(
            'idx-user_profile-locale',
            '{{%user_profile}}',
            'locale'
        );

         // creates index for column `gender`
        $this->createIndex(
            'idx-user_profile-gender',
            '{{%user_profile}}',
            'gender'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            'fk-user_profile-user_id',
            '{{%user_profile}}',
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
            'fk-user_profile-user_id',
            '{{%user_profile}}'
        );

        // drops index for column `gender`
        $this->dropIndex(
            'idx-user_profile-gender',
            '{{%user_profile}}'
        );

        // drops index for column `locale`
        $this->dropIndex(
            'idx-user_profile-locale',
            '{{%user_profile}}'
        );
        $this->dropTable('{{%user_profile}}');
    }
}
