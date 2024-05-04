<?php

namespace Database\Seeders;

use App\Models\Priority as ModelsPriority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Priority extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prefixes = array("Medio", "Bajo", "Alto");

        foreach ($prefixes as $prefix) {
            ModelsPriority::create([
                'name' => $prefix,
                'color' => '#446',
            ]);
        }
    }
}