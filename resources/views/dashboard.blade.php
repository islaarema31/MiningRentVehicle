<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.navbar')
                <!-- End of Topbar -->

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Done Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completedOrdersCount }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa fa-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingOrdersCount }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa fa-pause fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Rejected Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $rejectedOrdersCount }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa fa-ban fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrdersCount }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    <!-- Pie Chart -->
                    <div class="col-xl-6 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Demand Chart</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area pt-4 pb-2">
                                    <canvas id="DChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Vehicle Chart</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area pt-4 pb-2">
                                    <canvas id="VChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layouts.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('logout-modal')

    <!-- Bootstrap core JavaScript-->
    @include('layouts.scripts')
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const demandCtx = document.getElementById('DChart').getContext('2d');
    const vehicleCtx = document.getElementById('VChart').getContext('2d');
    
    const pendingCounts = @json($pendingOrdersCount);
    const rejectedCounts = @json($rejectedOrdersCount);
    const doneCounts = @json($completedOrdersCount);
    const completedOrdersCountPerVehicle = @json($completedOrdersCountPerVehicle);
    const labels = Object.keys(completedOrdersCountPerVehicle);
    const data = Object.values(completedOrdersCountPerVehicle);

    const demandChart = new Chart(demandCtx, {
        type: 'pie',
        data: {
            labels: ['Pending', 'Rejected', 'Done'],
            datasets: [{
                data: [pendingCounts, rejectedCounts, doneCounts],
                backgroundColor: [
                    'rgba(255, 255, 0, 1)',
                    'rgba(255, 0, 0, 1)',
                    'rgba(0, 255, 0, 1)',
                ],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    const vehicleChart = new Chart(vehicleCtx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Pemesanan',
                data: data,
                backgroundColor: [
                    'rgba(250, 235, 215, 1)',
                    'rgba(0, 255, 255, 1)',
                    'rgba(127, 255, 212, 1)',
                    'rgba(245, 245, 220, 1)',
                    'rgba(255, 228, 196, 1)',
                    'rgba(255, 235, 205, 1)',
                    'rgba(0, 0, 255, 1)',
                    'rgba(38, 43, 226, 1)',
                    'rgba(165, 42, 42, 1)',
                    'rgba(222, 184, 135, 1)',
                    'rgba(95, 158, 160, 1)',
                    'rgba(127, 255, 0, 1)',
                    'rgba(210, 105, 30, 1)',
                    'rgba(255, 127, 80, 1)'
                ],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        max: 20,
                        precision: 0
                    }
                }
            }
        }
    });
});

    </script>


</body>

</html>
