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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    $rd_img = $faker->numberBetween(1,75);
    return [
        'name' => $faker->name,
        'avatar' => '/avatar/128('.$rd_img.').jpg',
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'balance' => $faker->randomNumber(3),
        'api_token' => md5($faker->randomNumber(5)),
    ];
});


$factory->define(App\Question::class, function (Faker\Generator $faker) {
    return [
    	'question_type_id' => App\QuestionType::inRandomOrder()->first()->id,
    	'package_id' => null,
    	'content' => $faker->realText(),
    ];
});

$factory->define(App\Answer::class, function (Faker\Generator $faker) {

    return [
        'question_id' => App\Question::inRandomOrder()->first()->id,
        'content' => $faker->realText(),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text(50),
        'content' => $faker->realText,
        
    ];
});

