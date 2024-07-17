<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Other use statements;
use App\Models\Office;

class OfficeSeeder extends Seeder
{
    public function run()
    {
        Office::create([
            'lights_state' => false,
            'door_state' => false,
        ]);
    }
}
