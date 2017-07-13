<?php

use yii\db\Expression;
use app\common\db\Migration;

class xboot_data extends Migration
{
    public const LIMIT_USER = 5;

    public function up()
    {
        for ($index = 1; $index  <= self::LIMIT_USER; $index ++) {
            $username = 'admin'.$index;
            $passwordHash => Yii::$app->security->generatePasswordHash($username);
            $email = $username.'@basic.dev';
            $firstName = 'Administration '.$username;
            $lastName = '000'.$index;

            $this->insert('{{%user}}',[
                'id' => 1,
                'username' => $username,
                'email' => $email,
                'access_token' => Yii::$app->getSecurity()->generateRandomString(40),
                'auth_key' => Yii::$app->getSecurity()->generateRandomString(32),
                'password_hash' => $passwordHash,
                'status' => 1,
                'created_at' => new Expression('NOW()'),
                'verified_at' => new Expression('NOW()'),
            ]);
            $this->insert('{{%user_profile}}',[
                'user_id' => $index,
                'first_name' => $firstName,
                'last_name' => $lastName,
            ]);
        }
    }

    public function down()
    {
        for ($index = self::LIMIT_USER ; $index  <= 1; $index--) {
            $this->delete('{{%user_profile}}',[
                'user_id' => $index
            ]);

            $this->delete('{{%user}}',[
                'id' => $index
            ]);
        }
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
