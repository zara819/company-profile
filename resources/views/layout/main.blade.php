<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/loader.css')}}" rel="stylesheet">

    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Ecoluxe <sup>Mebel</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{Request::is('editor')? 'active' : '' }}">
                <a class="nav-link" href="{{ route('editor.home') }}">

                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item {{Request::is('editor/users')? 'active' : '' }}">
                <a class="nav-link" href="{{ route('editor.users') }}">
                    <i class="fas fa-user"></i>
                    <span>User</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item {{Request::is('editor/master-head')? 'active' : '' }}">
                <a class="nav-link" href="{{ route('editor.master-head') }}">
                    <i class="fas fa-th-list"></i>
                    <span>Master Head</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item {{Request::is('editor/contact')? 'active' : '' }}">
                <a class="nav-link" href="{{ route('editor.contact') }}">
                    <i class="fas fa-id-badge"></i>
                    <span>Contact</span></a>
            </li>

            <hr class="sidebar-divider">
            <li class="nav-item {{Request::is('editor/service')? 'active' : '' }}">
                <a class="nav-link" href="{{ route('editor.service') }}">
                    <i class="fas fa-tools"></i>
                    <span>Service</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item {{Request::is('editor/portofolio')? 'active' : '' }}">
                <a class="nav-link" href="{{ route('editor.portofolio') }}">
                    <i class=" fas fa-solid fa-bars"></i>
                    <span>Portofolio</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item {{Request::is('editor/about')? 'active' : '' }}">
                <a class="nav-link" href="{{ route('editor.about') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>about</span></a>
            </li>

            <!-- Heading -->
            <hr class="sidebar-divider">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->


                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter" id="notif">0</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <div id="notif-list"></div>

                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{asset('assets/img/undraw_profile.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Ecoluxe Mebel &copy; 2025</span>
                    </div>
                </div>
            </footer>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik 'Logout' di bawah jika Anda ingin keluar dari sesi ini..</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <div class="loading-clock">
        <div class="loader"></div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('assets/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('assets/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('assets/js/demo/chart-pie-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Page level plugins -->
    <script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('assets/js/demo/datatables-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            function notification() {
                $.ajax({
                    url: "{{route ('editor.notif') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(res) {
                        let totalNotif = res.total;
                        if (totalNotif > 0) {
                            $("#notif").text(totalNotif);
                        } else {
                            $("#notif").text(totalNotif);
                        }
                        $('#notif-list').empty();
                        if (res.contact > 0) {
                            $('#notif-list').append(
                                `
                                <a class="dropdown-item d-flex align-items-center" href="{{route ('editor.contact')}}">
                                    <div class="dropdown-list-image mr-3">
                                    <div class="icon-circle bg-primary text-white">
                                        <i class="fas fa-envelope fa-fw"></i>
                                    </div>
                                    </div>
                                    <div class="font-weight-bold">
                                        ada ${res.contact} pesan dari contact yang belum dibaca
                                    </div>
                                </a>
                                `
                            );
                        }
                        if (totalNotif == 0) {
                            $('#notif-list').append(
                                `
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    no notification
                                </a>
                                `
                            );
                        }
                    },
                });
            }
            // Panggil fungsi notification pertama kali
            notification();

            // Update notifikasi setiap 10 detik
            setInterval(notification, 10000);

            // Ketika pengguna mengklik notifikasi, tandai sebagai dibaca
            $(document).on('click', '.dropdown-item', function() {
                $.ajax({
                    url: "{{ route('editor.mark-read') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 'success') {
                            $("#notif").text('0'); // Set jumlah notifikasi menjadi 0
                            $('#notif-list').empty(); // Kosongkan daftar notifikasi
                            $('#notif-list').append('<a class="dropdown-item d-flex align-items-center" href="#">Tidak ada notifikasi baru</a>');
                            notification();
                        } else {
                            alert('Gagal menandai sebagai dibaca');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Cek error jika ada
                    }
                });
            });
        });
    </script>

    @yield('script')

</body>

</html>
@stack('bottom')