<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Rent Status</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Driver Name</th>
                        <th>Order Date</th>
                        <th>End Date</th>
                        <th>Vehicle</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $order->driver->driver_name  }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->end_date }}</td>
                            <td>{{ $order->vehicle->vehicle_name }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-6 d-inline-block">
                                        <form action="{{ route('order.approve', $order->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success shadow-sm" {{ $order->status == 'pending' && Auth::user()->role == 'staff2' || $order->status == 'completed' || $order->status == 'rejected' ? 'disabled' : '' }}>Approve</button>
                                        </form>
                                    </div>
                                    <div class="col-6 d-inline-block">
                                        <form action="{{ route('order.reject', $order->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger shadow-sm" {{ $order->status == 'pending' && Auth::user()->role == 'staff2' || $order->status == 'completed' || $order->status == 'rejected' ? 'disabled' : '' }}>Reject</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
