<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order = [
            [
                'driver_id' => 1,
                'vehicle_id' => 3,
                'status' => 'accept1',
                'order_date' => '2024-01-01',
                'end_date' => '2024-01-02',
            ],
            [
                'driver_id' => 2,
                'vehicle_id' => 4,
                'status' => 'accept1',
                'order_date' => '2024-02-03',
                'end_date' => '2024-02-04',
            ],
            [
                'driver_id' => 3,
                'vehicle_id' => 7,
                'status' => 'accept2',
                'order_date' => '2024-03-05',
                'end_date' => '2024-03-06',
            ],
            [
                'driver_id' => 4,
                'vehicle_id' => 8,
                'status' => 'accept2',
                'order_date' => '2024-04-07',
                'end_date' => '2024-04-08',
            ],
            [
                'driver_id' => 5,
                'vehicle_id' => 10,
                'status' => 'rejected',
                'order_date' => '2024-05-09',
                'end_date' => '2024-05-10',
            ],
            [
                'driver_id' => 6,
                'vehicle_id' => 9,
                'status' => 'rejected',
                'order_date' => '2024-06-11',
                'end_date' => '2024-06-12',
            ],
            [
                'driver_id' => 6,
                'vehicle_id' => 6,
                'status' => 'pending',
                'order_date' => '2024-07-13',
                'end_date' => '2024-07-14',
            ],
            [
                'driver_id' => 8,
                'vehicle_id' => 5,
                'status' => 'pending',
                'order_date' => '2024-08-15',
                'end_date' => '2024-08-16',
            ],
            [
                'driver_id' => 9,
                'vehicle_id' => 2,
                'status' => 'completed',
                'order_date' => '2024-09-17',
                'end_date' => '2024-09-18',
            ],
            [
                'driver_id' => 10,
                'vehicle_id' => 1,
                'status' => 'completed',
                'order_date' => '2024-10-19',
                'end_date' => '2024-10-20',
            ],
        ];

        foreach ($order as $value) {
            Order::create([
                'driver_id' => $value['driver_id'],
                'vehicle_id' => $value['vehicle_id'],
                'status' => $value['status'],
                'order_date' => $value['order_date'],
                'end_date' => $value['end_date'],
            ]);
        };
    }
}
