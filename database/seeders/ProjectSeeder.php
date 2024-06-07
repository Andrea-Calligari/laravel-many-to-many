<?php

namespace Database\Seeders;

use App\Models\Technology;
use App\Models\Type;
use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $types = Type::all();
        $ids = $types->pluck('id')->all();

        $technologies = Technology::all();
        $tech_ids = $technologies->pluck('id')->all();

        for ($i = 0; $i < 10; $i++) {

            $new_project = new Project();
            // $new_project->type_id = Type::inRandomOrder()->first()->id;
            $new_project->type_id = $faker->optional()->randomElement($ids);
           

            $project_name = $faker->sentence(6);
            $new_project->project_name = $project_name;
            $new_project->slug = Str::slug($project_name);
            $new_project->description = $faker->sentence(5);
            $new_project->working_hours = $faker->randomDigitNot(0);
            $new_project->co_workers = $faker->name();


            // non ha ancora un id il progetto
            $new_project->save();
            
            
            // prendo un numero random di id di technologies
            $random_tech_ids = $faker->randomElements($tech_ids);
            
            // qui éstato salvato gli viene ora assegnato un id
            $new_project->technologies()->attach($random_tech_ids);
    
        }

    }
}
