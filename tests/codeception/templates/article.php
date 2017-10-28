<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
$id = $index + 1;
$title = $faker->text(20);
$slug = \yii\helpers\Inflector::slug($title);

return [
	'id' => $id,
    'title' => $title,
    'slug' => $slug,
    'short_description' => $faker->text(50),
    'description' => $faker->text(250),
    'body' => $faker->text(5000),
    'view' => $faker->numberBetween(0,999),
    'category_id' => $faker->numberBetween(5,10),
    'author_id' => $faker->numberBetween(1,3),
    'updater_id' => $faker->numberBetween(1,3),
    'status' => $faker->numberBetween(0,1),
    'published_at' => $faker->unixTime,
    'updated_at' => $faker->unixTime,
];