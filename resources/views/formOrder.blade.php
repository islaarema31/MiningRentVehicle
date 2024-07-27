<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.navbar')

                <div class="container-fluid">

                    <!-- Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
                            <h6 class="m-0 font-weight-bold text-primary">Form Order Vehicle</h6>
                        </div>
                        <div class="card-body">

                            <form method="post" action="{{ route('order.submit') }}" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="mb-4 form-group">
                                    <label class="text-gray-900 font-weight-bold" for="driver_name">Driver Name</label>
                                    <input type="text" name="driver_name" class="form-control form-control-alternative" id="driver_name" placeholder="Masukkan nama driver" required>
                                </div>
                                <div class="mb-4 form-group">
                                    <label class="text-gray-900 font-weight-bold" for="order_date">Order Date</label>
                                    <input type="date" name="order_date" class="form-control form-control-alternative" id="order_date" required>
                                </div>
                                <div class="mb-4 form-group">
                                    <label class="text-gray-900 font-weight-bold" for="end_date">End Date</label>
                                    <input type="date" name="end_date" class="form-control form-control-alternative" id="end_date" required>
                                </div>
                                <div class="mb-4 form-group">
                                    <label class="text-gray-900 font-weight-bold" for="vehicle_id">Kendaraan</label>
                                    <select class="form-select form-control" aria-label="Default select example" name="vehicle_id" required>
                                        <option value="" selected disabled>Silahkan Pilih Kendaraan</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="d-sm-inline-block btn btn-primary shadow-sm ml-2 mt-2 mb-4">
                                    <i class="fas fa-sm text-white-50"></i>Submit
                                </button>

                                <a href="{{ route('order') }}" class=" d-sm-inline-block btn btn-danger shadow-sm ml-2 mt-2 mb-4">
                                    <i class="fas fa-sm text-white-50"></i>Cancel
                                </a>

                            </form>
                        </div>
                    </div>

                </div>
        <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('layouts.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('logout-modal')

    @include('layouts.scripts')

</body>

</html>
