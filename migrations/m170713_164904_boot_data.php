<?php

use yii\db\Migration;

class m170713_164904_boot_data extends Migration
{
    const LIMIT_USER = 10;

    public function up()
    {
        for ($index = 1; $index  <= self::LIMIT_USER; $index ++) {
            $username = 'admin'.$index;
            $passwordHash = Yii::$app->security->generatePasswordHash($username);
            $email = $username.'@basic.dev';
            $firstName = 'Administration '.$username;
            $lastName = '000'.$index;

            $this->insert('{{%user}}',[
                'id' => $index,
                'username' => $username,
                'email' => $email,
                'access_token' => Yii::$app->getSecurity()->generateRandomString(40),
                'auth_key' => Yii::$app->getSecurity()->generateRandomString(32),
                'password_hash' => $passwordHash,
                'status' => 1,
                'created_at' => time(),
                'verified_at' => time(),
            ]);
            $this->insert('{{%user_profile}}',[
                'user_id' => $index,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'locale' => Yii::$app->language,
                'gender' => rand(0, 1)
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
}
