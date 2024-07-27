<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\LogActivity;
use App\Exports\OrderExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['driver', 'vehicle'])->get();
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('order', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::whereNotIn('id', function($query){
            $query->select('vehicle_id')
            ->from('orders')
            ->whereIn('status', ['pending', 'staff1', 'staff2']);
        })->get();

        return view('formOrder', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'driver_name' => 'required|string',
            'order_date' => 'required|date',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $driver = new Driver([
            'driver_name' => $request->input('driver_name'),
        ]);

        $driver->save();


        $vehicle = Vehicle::find($request->input('vehicle_id'));

        $order = new Order([
            'driver_id' => $driver->id,
            'vehicle_id' => $request->input('vehicle_id'),
            'order_date' => $request->input('order_date'),
            'end_date' => $request->input('end_date'),
            'status' => 'pending',
        ]);


        $log = new LogActivity([
            'user' => Auth::user()->name,
            'activity' => 'Admin Create Order '. $vehicle->vehicle_name . ' with ' . $driver->driver_name . ' on ' . $order->order_date . ' until ' . $order->end_date . ' with status ' . $order->status,
        ]);

        $order->save();
        $log->save();

        return redirect()->route('order');
    }


    public function approve(Order $order)
    {
        $vehicle = Vehicle::find($order->vehicle_id);
        $driver = Driver::find($order->driver_id);

        if (Auth::user()->role == 'staff1') {
            $order->status = 'staff1';
            $log = new LogActivity([
                'user' => Auth::user()->name,
                'activity' => 'Staff1 Accept Order '. $vehicle->vehicle_name . ' with ' . $driver->driver_name . ' on ' . $order->order_date . ' until ' . $order->end_date . ' with status ' . $order->status,
            ]);
            $log->save();
            $order->save();
        } else if (Auth::user()->role == 'staff2' && $order->status == 'Staff1') {
            $order->status = 'staff2';
            $log = new LogActivity([
                'user' => Auth::user()->name,
                'activity' => 'Staff2 Accept Order '. $vehicle->vehicle_name . ' with ' . $driver->driver_name . ' on ' . $order->order_date . ' until ' . $order->end_date . ' with status ' . $order->status,
            ]);
            $log->save();
            $order->save();
        }

        return back();
    }

    public function reject(Order $order)
    {
        $vehicle = Vehicle::find($order->vehicle_id);
        $driver = Driver::find($order->driver_id);

        if (Auth::user()->role == 'staff1' && $order->status == 'pending') {
            $order->status = 'rejected';
            $log = new LogActivity([
                'user' => Auth::user()->name,
                'activity' => 'Staff1 Reject Order '. $vehicle->vehicle_name . ' with ' . $driver->driver_name . ' on ' . $order->order_date . ' until ' . $order->end_date . ' with status ' . $order->status,
            ]);
            $log->save();
            $order->save();
        } else if (Auth::user()->role == 'staff2' && $order->status == 'approved1') {
            $order->status = 'rejected';
            $log = new LogActivity([
                'user' => Auth::user()->name,
                'activity' => 'Staff2 Reject Order '. $vehicle->vehicle_name . ' with ' . $driver->driver_name . ' on ' . $order->order_date . ' until ' . $order->end_date . ' with status ' . $order->status,
            ]);
            $log->save();
            $order->save();
        }

        return back();
    }

    public function completed(Order $order)
    {
        $vehicle = Vehicle::find($order->vehicle_id);
        $driver = Driver::find($order->driver_id);

        $order->status = 'completed';
        $log = new LogActivity([
            'user' => Auth::user()->name,
            'activity' => 'Admin has Completed Order '. $vehicle->vehicle_name . ' with ' . $driver->driver_name . ' on ' . $order->order_date . ' until ' . $order->end_date . ' with status ' . $order->status,
        ]);
        $log->save();
        $order->push();

        return back();
    }

    public function export()
    {
        $date = date('Y-m-d'); // Get the current date
        $filename = 'Mining_Rent_Vehicle' . $date . '.xlsx';
        return Excel::download(new OrderExport, $filename);
    }

    public function showLogActivity()
    {
        $logs = LogActivity::all();
        $logs = LogActivity::orderBy('updated_at', 'desc')->get();
        return view('log-activity', compact('logs'));
    }

}
