<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Model
use App\Models\Technology;

// Helpers
use Illuminate\Support\Facades\Schema;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Technology::truncate();
        });

        for($i=0; $i<10; $i++){
            $allTech = Technology::create([
                'name'=> fake()->word()
            ]);
        }
    }
}
