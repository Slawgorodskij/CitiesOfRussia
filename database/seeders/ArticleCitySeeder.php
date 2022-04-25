<?php

namespace Database\Seeders;

use App\Models\ArticleCity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArticleCity::factory(20)->create();
    }
}
