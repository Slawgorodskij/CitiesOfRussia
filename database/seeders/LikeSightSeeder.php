<?php

namespace Database\Seeders;

use App\Models\LikeSight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LikeSight::factory(400)->create();
    }
}
