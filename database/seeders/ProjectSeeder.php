<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

// Helpers
use Illuminate\Support\Facades\Schema;


class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Project::truncate();
        });
        
        for($i = 0; $i < 10; $i++) {
            $randomTypeId = null;
            if(rand(0,1)){
                $randomType = Type::inRandomOrder()->first();
                $randomTypeId = $randomType->id;
            }

            $project = Project::create([
                'title' => fake()->sentence(),
                'description'=> fake()->paragraph(),
                'src'=> fake()->imageUrl(),
                'visible'=> fake()->boolean(70),
                'type_id'=> $randomTypeId,
            ]);

            $technologyIds = [];

            for ($j=0; $j < rand(0, Technology::count()); $j++) { 
                $randomTechnology = Technology::inRandomOrder()->first();

                if(!in_array($randomTechnology->id, $technologyIds)){
                    $technologyIds[] = $randomTechnology->id;
                }
            }
            
            $project->technology()->sync($technologyIds);
        }
    }
}
