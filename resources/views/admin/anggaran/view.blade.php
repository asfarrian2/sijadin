@extends('layouts.admin')

@section('header')

		<!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
							<div class="dashboard_bar">
                                Rincian DPA
                            </div>
                        </div>
                    </div>
				</nav>
			</div>
		</div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->
@endsection

@section('content')
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
        <!-- Start Pemberitahuan -->
        @csrf
        @php
        $messagesuccess = Session::get('success');
        $messagewarning = Session::get('warning');
        @endphp
        @if (Session::get('success'))
                <div class="alert alert-success solid alert-dismissible fade show">
					<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
					<strong>Sukses!</strong> {{ $messagesuccess }}.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div>
        @endif
        @if (Session::get('warning'))
                <div class="alert alert-danger solid alert-dismissible fade show">
                <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                <strong>Gagal!</strong> {{ $messagewarning }}.
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div>
        @endif
                <!-- End Pemberitahuan -->
				<div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="/admin/dashboard">SIJADIN</a></li>
						<li class="breadcrumb-item">Rincian DPA</li>
					</ol>
                </div>
                <!-- row -->
                 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tabel Data</h4>
                                <!-- Button trigger modal -->
                                <div class="btn-group">
                                    <a type="button" class="btn btn-secondary mb-2 me-2" data-bs-toggle="modal" data-bs-target="#sinkrondata"><i class="fa fa-refresh"></i> Sinkron</a>
                                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahdata"><i class="fa fa-plus"></i> Tambah</button>
                                </div>
                            </div>
                            <!-- Start Modal -->
                            <div class="modal fade" id="tambahdata">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Tambah Rincian</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="basic-form">
                                                <form action="{{ route('a.anggaran')}}" method="POST">
                                                @csrf
                                                    <input type="hidden" name="dpa" value="{{ Crypt::encrypt($id_dpa) }}" class="form-control input-default" required>
                                                <div class="mb-3">
                                                    <label class="form-label">Sub Kegiatan :</label>
                                                    <select class="input-default form-control" name="subkegiatan" required>
                                                    <option value="">Pilih Sub Kegiatan</option>
                                                    @foreach ($subkegiatan as $d)
                                                    <option value="{{ $d->id_subkegiatan }}">{{$d->nm_subkegiatan }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Kode Rekening :</label>
                                                    <select class="input-default form-control" name="koderekening" required>
                                                    <option value="">Pilih Kode Rekening</option>
                                                    @foreach ($koderekening as $d)
                                                    <option value="{{ $d->id_rekening }}"> {{$d->nm_rekening }} </option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">PPTK :</label>
                                                    <select class="input-default form-control" name="pegawai" required>
                                                    <option selected value="">Pilih PPTK</option>
                                                    @foreach ($pegawai as $d)
                                                    <option value="{{ $d->id_pegawai }}"> {{$d->nip }} - {{$d->nama }} </option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                 <div class="mb-3">
                                                    <label class="form-label">Pagu (Rp) :</label>
                                                    <input type="text" name="pagu" class="form-control input-default pagu" required>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">NO.</th>
                                                <th style="text-align:center;">NAMA PPTK</th>
                                                <th style="text-align:center;">SUB KEGIATAN / <br> KODE REKENING / NILAI</th>
                                                <th style="text-align:center;">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($pptk as $d)
                                            <tr>
                                                <td style="color: black; text-align:center;">{{ $loop->iteration }}</td>
                                                <td style="color: black;">{{ $d->nama}} <br> {{ $d->nip }}</td>
                                                <td style="color: black;">
                                                    @foreach ($d->anggaran as $anggaran)
                                                        <p class="text mb-1 mt-1" style="color: green">- {{ $anggaran->subkegiatan->kd_subkegiatan }} {{ $anggaran->subkegiatan->nm_subkegiatan }}</p>
                                                        <p class="text mb-1"> {{$anggaran->koderekening->kd_rekening}} {{ $anggaran->koderekening->nm_rekening }} </p>
                                                        <p class="text mb-1"> Nilai : Rp {{ number_format($anggaran->pagu, 0, ',', '.') }},-</p>&nbsp;
                                                        @csrf
                                                        &nbsp;<a type="button" class="editr" data-id="{{Crypt::encrypt($anggaran->id_anggaran)}}"> <i class="fa fa-pencil color-muted"></i> Edit</a>
                                                        &nbsp; &nbsp;<a type="button" class="hapusr mb-3" data-id="{{Crypt::encrypt($anggaran->id_anggaran)}}"> <i class="fa fa-trash color-muted"></i> Hapus</a><br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <div class="dropdown">
														<button type="button" class="btn btn-primary light sharp" data-bs-toggle="dropdown">
															<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
														</button>
														<div class="dropdown-menu">
															 @csrf
															<a type="button" class="dropdown-item edit" data-dpa="{{Crypt::encrypt($id_dpa)}}" data-pegawai="{{Crypt::encrypt($d->id_pegawai)}}"> <i class="fa fa-pencil color-muted"></i> Edit PPTK</a>
														</div>
													</div>
                                                </td>
                                            @endforeach
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="text-align:center;">NO.</th>
                                                <th style="text-align:center;">NAMA PPTK</th>
                                                <th style="text-align:center;">SUB KEGIATAN / <br> KODE REKENING / NILAI</th>
                                                <th style="text-align:center;">AKSI</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- Start EditModal -->
                            <div class="modal fade" id="modal-editobjek">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Edit Data</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body" id="loadeditform">
                                            <div class="basic-form">
                                            <!-- Form
                                                        Edit -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            <!-- Start EditModal -->
                            <div class="modal fade" id="modal-editr">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Edit Pagu</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body" id="loadeditr">
                                            <div class="basic-form">
                                            <!-- Form
                                                        Edit -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

@endsection

@push('myscript')
    <!-- Datatable -->
    <script src="{{asset ('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset ('assets/js/plugins-init/datatables.init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
    $(document).ready(function(){
        $('.pagu').mask("#.##0", {
            reverse:true
        });
    });
    </script>
<!-- Button Edit pegawai -->
<script>

$(document).on('click', '.edit', function(){
    var id_pegawai = $(this).attr('data-pegawai');
    var id_dpa = $(this).attr('data-dpa');
    $.ajax({
        type: 'POST',
        url: '/admin/sumberdana/tahun/dpa/pptk/edit',
        cache: false,
        data: {
            _token: "{{ csrf_token() }}",
            id_pegawai: id_pegawai,
            id_dpa: id_dpa
        },
        success: function(respond) {
            $("#loadeditform").html(respond);
        }
    });
    $("#modal-editobjek").modal("show");
});

$(document).on('click', '.editr', function(){
    var id_anggaran = $(this).attr('data-id');
    $.ajax({
        type: 'POST',
        url: '/admin/sumberdana/tahun/dpa/rincian/edit',
        cache: false,
        data: {
            _token: "{{ csrf_token() }}",
            id_anggaran: id_anggaran
        },
        success: function(respond) {
            $("#loadeditr").html(respond);
            $('.pagu').mask("#.##0", {
            reverse:true
             });
        }
    });
    $("#modal-editr").modal("show");
});

$(document).on('click', '.hapusr', function(){
    var id_anggaran = $(this).attr('data-id');
    Swal.fire({
        title: "Apakah Anda Yakin Data Ini Ingin Di Hapus ?",
        text: "Jika Ya Maka Data Akan Terhapus Permanen",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus Saja!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "/admin/sumberdana/tahun/dpa/rincian/hapus/"+id_anggaran
        }
    });
});

$(document).on('click', '.status', function(){
    var id_anggaran = $(this).attr('data-id');
    Swal.fire({
        title: "Apakah Anda Yakin Ingin Mengubah Status Data Ini ?",
        text: "Jika Ya Maka Status Data Akan Diubah",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Ubah Status!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "/admin/pegawai/status"+id_anggaran
        }
    });
});
</script>
<!-- END Button Edit pegawai -->

@endpush
