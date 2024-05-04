<?php

namespace Database\Seeders;

use App\Models\StatusTicket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTickets extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prefixes = array("Abrir", "Resuelto", "Pendiente", "Cerrado");

        foreach ($prefixes as $prefix) {
            StatusTicket::create([
                'name' => $prefix,
                'color' => '#446',
            ]);
        }
    }
}