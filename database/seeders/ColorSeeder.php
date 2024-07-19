<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colores = array(
            "#FF0000",
            "#FFFF00",
            "#0000FF",
            "#FF7F00", // Orange (red + yellow)
            "#008000", // Green (blue + yellow)
            "#00FFFF", // Cyan (blue + green)
            "#FF00FF", // Magenta (red + blue)
            "#FFC0CB", // Pink (red + white)
            "#98FF98", // Mint green (green + white)
            "#C0C0FF", // Sky blue (blue + white)
            "#D35400", // Rust (red + orange + black)
            "#A020F0", // Purple (blue + magenta)
            "#008080", // Teal (green + blue)
        );


        foreach ($colores as $prefix) {
            Color::create([
                'name' => $prefix,
            ]);
        }
    }
}