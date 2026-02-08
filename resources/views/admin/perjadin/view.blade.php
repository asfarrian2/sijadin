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
                                Perjalanan Dinas
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
						<li class="breadcrumb-item">Perjalanan Dinas</li>
					</ol>
                </div>
                <!-- row -->
                 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tabel Data</h4>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahdata">+Tambah</button>
                            </div>
                            <!-- Start Modal -->
                            <div class="modal fade" id="tambahdata">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Tambah Perjalanan Dinas</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="basic-form">
                                                <form action="{{ route('a.perjadin')}}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label">Dasar Anggaran:</label>
                                                    <select class="input-default form-control" name="anggaran" id="anggaran" required>
                                                        <option value="">Pilih Dasar Anggaran</option>
                                                        @foreach ($dpa as $d)
                                                        <option value="{{ Crypt::encrypt($d->id_dpa) }}"> {{$d->dpa}} tanggal {{ $d->tgl }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>    
                                                <div class="mb-3">
                                                    <label class="form-label">Sub Kegiatan / Kode Rekening :</label>
                                                    <select class="input-default form-control" name="anggaran" id="subkegiatan" required>
                                                        <option value="">Pilih Sub Kegiatan / Kode Rekening</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 type_msg">
                                                    <label class="form-label">Dasar Perjalanan :</label>
                                                    <textarea style="height: 80px;" name="dasar" class="form-control" required></textarea>
                                                </div> 
                                                <div class="mb-3">
                                                    <label class="form-label">Keperluan / Perihal:</label>
                                                    <textarea style="height: 80px;" name="keperluan" class="form-control" required></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tujuan :</label>
                                                    <input type="text" name="tujuan" class="form-control input-default" required>
                                                </div>  
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Berangkat :</label>
                                                    <input type="date" name="tgl_berangkat" id="tgl_berangkat" class="form-control input-default" required>
                                                </div> 
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Pulang :</label>
                                                    <input type="date" name="tgl_pulang" id="tgl_pulang" class="form-control input-default" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Pulang :</label>
                                                <select class="input-default form-control" name="jenis" required>
                                                    <option value="">Pilih Jenis Perjalanan</option>
                                                    <option value="1">Dalam Daerah</option>
                                                    <option value="2">Luar Daerah</option>
                                                </select>
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
                                                <th style="text-align:center;">NOMOR SPT</th>
                                                <th style="text-align:center;">KEPERLUAN / PERIODE / TUJUAN</th>
                                                <th style="text-align:center;">JENIS</th>
                                                <th style="text-align:center;">PEGAWAI</th>
                                                <th style="text-align:center;">STATUS</th>
                                                <th style="text-align:center;">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($perjadin as $d)
                                            <tr>
                                                <td style="color: black; text-align:center;">{{ $loop->iteration }}</td>
                                                <td style="color: black; text-align:center;">{{$d->dasar}}</td>
                                                <td style="color: black;">{{$d->keperluan}}<br>Periode :{{ \Carbon\Carbon::parse($d->tgl_berangkat)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($d->tgl_pulang)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($d->tgl_pulang)->diffInDays(\Carbon\Carbon::parse($d->tgl_berangkat)) + 1 }} Hari)<br>Tujuan: {{ $d->tujuan }}</td>
                                                <td style="color: black; text-align:center;">
                                                    @if ($d->jenis == '1')
                                                    Dalam Daerah
                                                    @else
                                                    Luar Daerah    
                                                    @endif
                                                </td>
                                                <td style="color: black;"></td>
                                                @if ($d->status == '0')
                                                        <td style="text-align:center;"><span class="badge light badge-warning">Draft</span></td>
                                                    @elseif ($d->status == '1')
                                                        <td style="text-align:center;"><span class="badge light badge-secondary">Terkirim</span></td>
                                                @endif
                                                <td>
                                                    <div class="dropdown">
														<button type="button" class="btn btn-primary light sharp" data-bs-toggle="dropdown">
															<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
														</button>
                                                        @csrf
														<div class="dropdown-menu">
															<a class="dropdown-item edit" href=""> <i class="fa fa-eye color-muted"></i> Rincian</a>
															<a class="dropdown-item edit" href="#" data-id="{{Crypt::encrypt($d->id_perjadin)}}"> <i class="fa fa-pencil color-muted"></i> Edit</a>
															<a class="dropdown-item hapus" href="#" data-id="{{Crypt::encrypt($d->id_perjadin)}}" ><i class="fa fa-trash color-muted"></i> Hapus</a>
														</div>
													</div>
                                                </td>
                                            @endforeach
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="text-align:center;">NO.</th>
                                                <th style="text-align:center;">NOMOR SPT</th>
                                                <th style="text-align:center;">KEPERLUAN / PERIODE / TUJUAN</th>
                                                <th style="text-align:center;">JENIS</th>
                                                <th style="text-align:center;">PEGAWAI</th>
                                                <th style="text-align:center;">STATUS</th>
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
    <script src="{{asset ('assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{asset ('assets/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{asset ('assets/js/plugins-init/select2-init.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#anggaran').change(function() {
            var idDpa = $(this).val();
            $.ajax({
                url: '/get-subkegiatan/' + idDpa,
                type: 'GET',
                success: function(data) {
                    $('#subkegiatan').empty();
                    $('#subkegiatan').append('<option value="">Pilih Sub Kegiatan / Kode Rekening</option>');
                    $.each(data, function(key, value) {
                        $('#subkegiatan').append('<option value="' + value.id_anggaran + '">' + value.subkegiatan.kd_subkegiatan + ' ' + value.subkegiatan.nm_subkegiatan + ' - '  + value.koderekening.nm_rekening + '</option>');
                    });
                }
            });
        });
    });
</script>

    <script>
    const tglBerangkat = document.getElementById('tgl_berangkat');
    const tglPulang = document.getElementById('tgl_pulang');

    tglBerangkat.addEventListener('change', () => {
        tglPulang.min = tglBerangkat.value;
    });
    </script>

    

    <!-- Button Edit SPJ -->
    <script>
    $(document).on('click', '.edit', function(){
    var id_perjadin = $(this).attr('data-id');
    $.ajax({
        type: 'POST',
        url: '/admin/perjadin/pegawai/edit',
        cache: false,
        data: {
            _token: "{{ csrf_token() }}",
            id_perjadin: id_perjadin
        },
        success: function(respond) {
            $("#loadeditform").html(respond);
            $("#modal-editobjek").modal("show");

            // Panggil fungsi untuk mengambil sub kegiatan
            getSubKegiatan();

            // Panggil fungsi ketika #anggaran berubah
            $('#eanggaran').change(function() {
                getSubKegiatan();
            });
            // Atur tanggal pulang
            $('#etgl_berangkat').change(function() {
                var tanggalBerangkat = $(this).val();
                $('#etgl_pulang').attr('min', tanggalBerangkat);
            });

            // Panggil fungsi change secara manual untuk mengatur min tanggal pulang saat halaman dimuat
            $('#etgl_berangkat').change();
        }
    });
});

// Fungsi untuk mengambil sub kegiatan
function getSubKegiatan() {
    var idDpa = $('#eanggaran').val();
    if (idDpa) {
        $.ajax({
            url: '/get-subkegiatan/' + idDpa,
            type: 'GET',
            success: function(data) {
                $('#esubkegiatan').empty();
                $('#esubkegiatan').append('<option value="">Pilih Sub Kegiatan / Kode Rekening</option>');
                $.each(data, function(key, value) {
                    var isSelected = '';
                    if (value.id_anggaran == $('#id_anggaran_hidden').val()) {
                        isSelected = 'selected';
                    }
                    $('#esubkegiatan').append('<option ' + isSelected + ' value="' + value.id_anggaran + '">' + value.subkegiatan.kd_subkegiatan + ' ' + value.subkegiatan.nm_subkegiatan + ' - ' + value.koderekening.nm_rekening + '</option>');
                });
            }
        });
    } else {
        console.log('idDpa tidak ditemukan');
    }
}
    </script>
    <!-- END Button Edit SPJ -->

    <!-- Start Button Hapus -->
    <script>
    $(document).on('click', '.hapus', function(){
        var id_perjadin = $(this).attr('data-id');
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
        window.location = "/admin/perjadin/pegawai/hapus"+id_perjadin
      }
    });
    });
    </script>
    <!-- End Button Hapus -->

@endpush
