<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingOrdersCount = Order::whereIn('status', ['pending', 'approved1'])->count();
        $rejectedOrdersCount = Order::where('status', 'rejected')->count();
        $successOrdersCount = Order::where('status', 'approved2')->count();
        $completedOrdersCount = Order::where('status', 'completed')->count();
        $totalOrdersCount = Order::count();

        $vehicles = Vehicle::all();
        $vehicleNames = $vehicles->pluck('name');
        $orderCounts = $vehicles->map(function ($vehicle) {
            return $vehicle->order()
                ->where('status', 'completed')
                ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
                ->count();
        });

        $completedOrdersCountPerVehicle = DB::table('orders')
            ->join('vehicles', 'orders.vehicle_id', '=', 'vehicles.id')
            ->select('vehicles.vehicle_name', DB::raw('count(*) as total'))
            ->where('orders.status', 'completed')
            ->groupBy('vehicles.vehicle_name')
            ->pluck('total', 'vehicles.vehicle_name');


        return view('dashboard', compact('pendingOrdersCount', 'successOrdersCount', 'rejectedOrdersCount', 'completedOrdersCount', 'totalOrdersCount', 'vehicleNames', 'orderCounts', 'completedOrdersCountPerVehicle'));
    }
}
