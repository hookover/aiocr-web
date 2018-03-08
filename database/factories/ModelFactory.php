<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->define(App\Models\Card::class, function (Faker\Generator $faker) {

    $user = \App\Models\User::pluck('user_id')->toArray();
    $developer = \App\Models\Developer::pluck('developer_id')->toArray();

    return [
        'card' => \Illuminate\Support\Str::random(58),
        'point' => $faker->randomNumber(),
        'money' => $faker->randomFloat(),
        'user_id' => $faker->randomElement($user),
        'developer_id' => $faker->randomElement($developer),
    ];
});
