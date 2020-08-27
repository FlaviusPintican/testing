<?php declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Film;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Film::class, function(Faker $faker) {
    return [
        'body' => 'test',
        'cast' => '[
          {
            "name": "Billy Crystal"
          },
          {
            "name": "Bette Midler"
          },
          {
            "name": "Marisa Tomei"
          },
          {
            "name": "Bailee Madison"
          },
          {
            "name": "Madison Lintz"
          }
        ]',
        'cert' => 'u',
        'class' => 'TEST',
        'directors' => '[
          {
            "name": "Andy Fickman"
          }
        ]',
        'duration' => 15,
        'genres' => '[ "Comedy","Family"]',
        'headline' => 'TEST',
        'source_id' => 'test',
        'lastUpdated' => '2020-27-08',
        'quote' => 'tst',
        'rating' => 0,
        'reviewAuthor' => $faker->name,
        'skyGoId' => '',
        'sum' => '',
        'synopsis' => 'test',
        'year' => 2020,
        'viewingWindow' => '{
          "startDate": "2013-12-27",
          "wayToWatch": "Sky Movies",
          "endDate": "2015-01-21"
        }',
    ];
});
