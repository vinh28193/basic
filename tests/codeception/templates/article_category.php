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
    'parent_id' => $id <= 5 ? null : $faker->numberBetween(1,5),
    'status' => $faker->numberBetween(0,1),
    'created_at' => $faker->unixTime,
    'updated_at' => $faker->unixTime,
];