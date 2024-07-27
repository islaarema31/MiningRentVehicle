<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')

    <!-- Custom styles for this page -->


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

                <!-- Navbar -->
                @include('layouts.navbar')
                <!-- End of Navbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Rent Status</h1>
                    @php
                        $role = Auth::user()->role;
                    @endphp
                    @if ($role == 'admin')
                        @include('layouts.orderAdmin')
                    @elseif ($role == 'staff1')
                        @include('layouts.orderApprover1')
                    @elseif ($role == 'staff2')
                        @include('layouts.orderApprover2')
                    @endif
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

    @include('layouts.scripts')



</body>

</html>
