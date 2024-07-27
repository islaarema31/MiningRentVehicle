<div class=" justify-content-end mb-4">
    <a href="{{ route('formPemesanan') }}" class="d-sm-inline-block btn btn-sm btn-info shadow-sm ml-auto">
        <i class="fas fa-download fa-sm text-white-50"></i> Add Order
    </a>
    <a href="{{ route('order.export') }}" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm ml-auto">
        <i class="fas fa-download fa-sm text-white-50"></i> Download Report
    </a>
</div>

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
                            <td>{{ $order->driver->driver_name }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->end_date }}</td>
                            <td>{{ $order->vehicle->vehicle_name }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-6 d-inline-block">
                                        <form action="{{ route('order.completed', $order->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success shadow-sm"
                                                {{ $order->status != 'approved2' ? 'disabled' : '' }}>Completed</button>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tambahModal').on('hidden.bs.modal', function() {
            $('#myForm')[0].reset();
        });
    });

</script>
