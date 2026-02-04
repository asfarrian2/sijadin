<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="SI-RETDA" />
	<meta name="author" content="Badan Pendapatan Daerah Provinsi Kalimantan Selatan" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="SI-RETDA" />
	<meta property="og:title" content="Sistem Informasi Pendapatan Retribusi Daerah Provinsi Kalimantan Selatan" />
	<meta property="og:description" content="Sistem Informasi Pendapatan Retribusi Daerah Provinsi Kalimantan Selatan" />
    <meta property="og:image" content="{{ url('/images/profile/cover website.png') }}" />
	<meta name="format-detection" content="telephone=no">

	<!-- PAGE TITLE HERE -->
	<title>Sijadin Balatkop-uk Kalsel</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/profile/Default Picture Profile.png') }}" />

	<link href="{{ asset('assets/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}">
     <!-- Datatable -->
     <link href="{{ asset ('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
     <!-- Sweat Alert -->
     <link href="{{ asset ('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
	<!-- Style css -->
    <link href="{{ asset ('assets/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="waviy">
		   <span style="--i:1">S</span>
		   <span style="--i:2">I</span>
		   <span style="--i:3">J</span>
		   <span style="--i:4">A</span>
		   <span style="--i:5">D</span>
		   <span style="--i:6">I</span>
		   <span style="--i:7">N</span>
		</div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="/admin/dashboardAll" class="brand-logo">
                <img src="{{asset ('assets/images/logo-utama.png') }}">
                <img src="{{asset ('assets/images/logo-text-3.png') }}" class="brand-title" width="124px" height="33px">
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        @yield('header')

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
				<ul class="metismenu" id="menu">
					<li class="dropdown header-profile">
						<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
							<img src="{{ asset('assets/images/profile/avatar.png') }}" width="20" alt=""/>
							<div class="header-info ms-3">
								<span class="font-w600 ">ADMIN BAKATKOP</span>
								<small class="text-start font-w400">Prov. Kalimantan Selatan</small>
							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a href="./email-inbox.html" class="dropdown-item ai-icon">
								<svg id="icon-keys" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
								<span class="ms-2">Ganti Password </span>
							</a>
							<a href="/logout" class="dropdown-item ai-icon">
								<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
								<span class="ms-2">Logout </span>
							</a>
						</div>
					</li>
                    <li>
                        <a class="ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                    </li>
                    <li><a href="javascript:void()" class="has-arrow ai-icon" aria-expanded="false"  @if(Request::is('admin/sumberdana*')) style="background-color: #eefaf9;" @endif>
							<i class="flaticon-381-calculator"  @if(Request::is('admin/sumberdana*')) style="color: #5bcfc5;" @endif></i>
							<span class="nav-text">Sumber Dana</span>
						</a>
                        <ul aria-expanded="false" @if(Request::is('admin/sumberdana*')) class="mm-collapse mm-show" @endif>
                            <li @if(Request::is('admin/sumberdana/subkegiatan*')) class="mm-active" @endif><a href="{{ Route('subkegiatan')}}" @if(Request::is('admin/sumberdana/subkegiatan*')) class="mm-active" @endif>Sub Kegiatan</a></li>
                            <li @if(Request::is('admin/sumberdana/koderekening*')) class="mm-active" @endif><a href="{{ Route('koderekening')}}" @if(Request::is('admin/sumberdana/koderekening*')) class="mm-active" @endif>Kode Rekening</a></li>
                            <li @if(Request::is('admin/sumberdana/tahun*')) class="mm-active" @endif><a href="{{ Route('tahun')}}" @if(Request::is('admin/sumberdana/tahun*')) class="mm-active" @endif>Tahun Anggaran</a></li>
                            <li @if(Request::is('admin/sumberdana/anggaran*')) class="mm-active" @endif><a href="/admin/sumberdana/anggaran" @if(Request::is('admin/sumberdana/anggaran*')) class="mm-active" @endif>Anggaran</a></li>
                        </ul>
					</li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-043-menu"></i>
							<span class="nav-text">Master Data</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="/admin/jenisretribusi">Jenis Retribusi</a></li>
                            <li><a href="/admin/subretribusi">Sub Retribusi</a></li>
                            <li><a href="/admin/objekretribusi">Objek Retribusi</a></li>
                        </ul>
                    </li>
                    <li><a href="/admin/agency" class="ai-icon" aria-expanded="false">
							<i class="flaticon-093-waving"></i>
							<span class="nav-text">SKPD/UPTD</span>
						</a>
					</li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
						<i class="flaticon-381-user-8"></i>
							<span class="nav-text">Akun</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="/admin/operator">Operator</a></li>
							<li><a href="./post-details.html">User</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
						<i class="flaticon-060-on"></i>
							<span class="nav-text">Konfigurasi Menu</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="/admin/menuanggaran">Anggaran</a></li>
							<li><a href="./post-details.html">Bulanan</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-072-printer"></i>
							<span class="nav-text">Laporan</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="/admin/laporan/target">Target</a></li>
                            <li><a href="/admin/laporan/realisasi">Realisasi</a></li>
                            <li><a href="/admin/laporan/skpduptd">SKPD/UPTD</a></li>
                            <li><a href="/admin/laporanobjekretribusi">Objek Retribusi</a></li>
                        </ul>
                    </li>
                </ul>
				<div class="copyright">
					<p><strong>Sistem Informasi Perjalanan Dinas<br>Provinsi Kalimantan Selatan</strong> © 2025 BALATKOP-UK Prov. Kalsel</p>
				</div>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
        @yield('content')


        <!--**********************************
            Footer start
        ***********************************-->

        <div class="footer">

            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://dexignlab.com/" target="_blank">Balatkop-uk Prov. Kalsel</a> 2026</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->




	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('myscript')
	<script src="{{ asset('assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>

    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
	<script src="{{ asset('assets/js/dlabnav-init.js') }}"></script>

</body>
</html>
