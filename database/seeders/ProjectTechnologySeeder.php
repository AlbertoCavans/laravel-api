<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;
use Faker\Generator as Faker;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $projects = Project::all();

        $technologies = Technology::all()->pluck("id");

       /*  dd($technologies); */

        foreach ($projects as $project) {
            $random_technologies = $faker->randomElements($technologies, rand(1, 6));
            /* dd($random_technologies); */
            $project->technologies()->sync($random_technologies);
        }
    }
}
