<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromQuery, WithHeadings
{
    public function query()
    {
        return Order::query()
        ->with('driver', 'vehicle')
        ->select('orders.id', 'drivers.driver_name as driver_name', 'vehicles.vehicle_name as vehicle_name', 'orders.status', 'orders.order_date', 'orders.end_date')
        ->join('drivers', 'orders.driver_id', '=', 'drivers.id')
        ->join('vehicles', 'orders.vehicle_id', '=', 'vehicles.id');
    }

    public function headings(): array
    {
        return [
            'No',
            'Driver Name',
            'Vehicle Name',
            'Status',
            'Order Date',
            'End Date',
        ];
    }
}
