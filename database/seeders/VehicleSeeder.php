<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
                'Dump Truck',
                'Excavator',
                'Bulldozer',
                'Loader',
                'Grader',
                'Crane',
                'Drill Rig',
                'Water Truck',
                'Rock Breaker',
                'Articulated Truck',
                'Backhoe Loader',
                'Road Roller',
                'Concrete Mixer',
                'Forklift',
                'Skid Steer Loader',
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create([
                'vehicle_name' => $vehicle,
            ]);
        }
    }
}
