<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ImageSeeder::class,
            ArticleSeeder::class,
            CitySeeder::class,
            SightSeeder::class,
            ArticleImageSeeder::class,
            CityImageSeeder::class,
            ImageSightSeeder::class,
            CommentCitySeeder::class,
            CommentSightSeeder::class,
            // LikeCitySeeder::class,
            // LikeSightSeeder::class,
        ]);
    }
}
