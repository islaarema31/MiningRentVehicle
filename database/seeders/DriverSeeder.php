<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = [
            'Johnny Plate',
            'Syahrul Limpo',
            'Naomi Bishop',
            'Maximo Odom',
            'Beau Gutierrez',
            'Jiaming Hou',
            'Zhihong Qie',
            'Mikio Takayama',
            'Mube Sasahara',
            'Ratree Chanaphan',
            'Bunyuen Cheriyuang',
            'Olaf Ehlert',
            'Marsel Karpova',
            'Ferdi Sambo',
            'Setya Novanto',
        ];

        foreach ($drivers as $driver) {
            Driver::create([
                'driver_name' => $driver,
            ]);
        }
    }
}
