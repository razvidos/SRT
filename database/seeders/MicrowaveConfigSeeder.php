<?php

namespace Database\Seeders;

use App\Models\MicrowaveConfig;
use Illuminate\Database\Seeder;

class MicrowaveConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MicrowaveConfig::factory()->createMany([
            ['name' => '100 watt', 'power' => 100],
            ['name' => '200 watt', 'power' => 200],
            ['name' => '300 watt', 'power' => 300],
            ['name' => '400 watt', 'power' => 400],
            ['name' => '500 watt', 'power' => 500],
            ['name' => '600 watt', 'power' => 600],

            ['name' => 'defrosting', 'power' => 200],
            ['name' => 'cleaning', 'power' => 300, 'seconds' => 180],
        ]);
    }
}
