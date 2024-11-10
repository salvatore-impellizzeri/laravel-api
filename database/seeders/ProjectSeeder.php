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

        for ($i = 0; $i < 20; $i++) {
            $name = fake()->sentence();
            $slug = str()->slug($name);
        
            $originalSlug = $slug;
            $counter = 1;
            while (Project::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $randomTypeId = null;
            if (rand(0, 1)) {
                $randomType = Type::inRandomOrder()->first();
                $randomTypeId = $randomType->id;
            }

            $project = Project::create([
                'title' => $name,
                'slug' => $slug,
                'description' => fake()->paragraph(),
                'src' => fake()->imageUrl(),
                'visible' => fake()->boolean(70),
                'type_id' => $randomTypeId,
            ]);

            $technologyIds = [];
            for ($j = 0; $j < rand(0, Technology::count()); $j++) {
                $randomTechnology = Technology::inRandomOrder()->first();

                if (!in_array($randomTechnology->id, $technologyIds)) {
                    $technologyIds[] = $randomTechnology->id;
                }
            }

            $project->technologies()->sync($technologyIds);
        }
    }
}
