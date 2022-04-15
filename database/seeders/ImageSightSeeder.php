<?php

namespace Database\Seeders;

use App\Models\ImageSight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImageSight::factory(200)->create();
    }
}
