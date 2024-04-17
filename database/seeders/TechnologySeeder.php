<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $technology_data = [
            "HTML5",
            "CSS",
            "JavaScript",
            "Vue",
            "Axios",
            "API",
            "SQL",
            "PHP",
            "Laravel",
            "Blade"
        ];

        foreach ($technology_data as $_technology) {
            $technology = new Technology;
            $technology->name = $_technology;
            $technology->color_label = $faker->hexColor();
            $technology->save();
        }
    }
}
