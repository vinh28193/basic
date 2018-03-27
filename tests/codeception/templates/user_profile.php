<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
	'user_id' => $index + 1,
    'tenant_id' => $faker->numberBetween(1,10),
    'first_name' => $faker->firstName,
    'last_name' => $faker->lastName,
    'avatar_path' => $faker->randomElement(['?33226','?36052','?89116','?59505','?66499']),
    'avatar_base_url' => 'http://lorempixel.com/450/450',
    'identity_code' => $faker->countryCode,
    'birthday' => $faker->unixTime,
    'address' => $faker->address,
    'bio' => $faker->realText(60),
    'locale' => $faker->locale,
    'gender' => $faker->numberBetween(0,1),
    'updated_at' => $faker->unixTime,
];