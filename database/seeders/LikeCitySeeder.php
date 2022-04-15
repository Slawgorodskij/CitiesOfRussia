<?php

namespace Database\Seeders;

use App\Models\LikeCity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LikeCity::factory(40)->create();
    }
}
