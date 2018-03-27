<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
$security = Yii::$app->getSecurity();

return [
	'id' => $index + 1,
    'tenant_id' => $faker->numberBetween(1,10),
    'username' => $faker->userName,
    'email' => $faker->email,
    'phone' => $faker->phoneNumber,
    'oauth_id' => '123456789123456',
    'oauth_secret' => $security->generateRandomString(32),
    'access_token' => $security->generateRandomString(100),
    'auth_key' => $security->generateRandomString(32),
    'password_reset_token' => $security->generateRandomString(60),
    'password_hash' => $security->generatePasswordHash($faker->password(6,12)),
    'status' => $faker->numberBetween(0,1),
    'created_at' => $faker->unixTime,
    'verified_at' => $faker->unixTime,
];