<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
$security = Yii::$app->getSecurity();

return [
	'tenant_id' => $index + 1,
    'tenant_code' => $faker->domainName,
    'tenant_name' => $faker->company,
    'tenant_name_short' => $faker->company,
    'language_code' => $faker->languageCode,
    'run_mode' => $faker->randomElement(['dev','prod']),
    'created_at' => $faker->unixTime,
    'updated_at' => $faker->unixTime
];