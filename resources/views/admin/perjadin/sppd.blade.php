<!DOCTYPE html>
<html>
<head>
	<!-- PAGE TITLE HERE -->
	<title>Sijadin Balatkop-uk Kalsel</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/profile/Default Picture Profile.png') }}" />
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <style>

        @page {
            margin-top: 0.5cm;
            margin-right: 1cm;
            margin-bottom: 1cm;
            margin-left: 1cm;
        }
    
        body {
            margin: 0;
            padding: 0;
        }


        .title {
            font-family: 'Times New Roman', Times, serif;
            font-size: 18,67px;
            font-weight: bold;
        }

        .text {
        font-family: 'Times New Roman', Times, serif;
        font-size: 16px;

        }

        .tabelkolom {
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
            width: 100%;
            border-collapse: collapse;
        }

        .tabelbaris {
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
            border: 1px solid #131212;
            padding-bottom: 5px;
        }

        .tabelkolom tr td {
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
            border: 1px solid #131212;
            padding-bottom: 5px;
        }

        .foto {
            width: 40px;
            height: 30px;

        }
    </style>

</head>
<body>
    @php
        $image_path = public_path('assets/images/laporan/kop.png');
        $image_data = base64_encode(file_get_contents($image_path));  
    @endphp
    <img src="data:image/png;base64,{{ $image_data }}" alt="Logo" style="width: 100%">
    {{-- Nomor SPD --}}
    <table class="text" style="width: 100%">
        <tr>
            <td style="text-align: justify; width: 350px"></td>
            <td style="text-align: justify; width: 80px">
                Lembar ke
            </td>
             <td style="text-align: left;">
                :
            </td>
        </tr>
        <tr>
            <td style="text-align: justify;"></td>
            <td style="text-align: justify;">
                Kode No.
            </td>
            <td style="text-align: left;">
                :
            </td>
        <tr>
            <td style="text-align: justify;"></td>
            <td style="text-align: justify;">
                Nomor
            </td>
            <td style="text-align: left;">
                : 800.1.11.1/ &nbsp; &nbsp; &nbsp; &nbsp;/22.6/BPKUK/2026
            </td>
        </tr>
    </table>
    <br>
    {{-- Head SPT --}}
    <table style="width: 100%; padding-bottom:12px">
        <tr>
            <td style="text-align: center;" colspan="10">
                <span class="title">
                      <u>SURAT PERJALANAN DINAS (SPD)</u>
                </span>
            </td>
        </tr>
    </table>

    <table class="tabelkolom">
        <tr class="tabelbaris" style="padding-bottom: 3px">
            <td style="text-align: center; width: 4%; padding: 4px; vertical-align: top;">1</td>
            <td style="width: 40%; padding: 4px; vertical-align: top;"> Pejabat Pembuat Komitmen/PA/KPA</td>
            <td style="padding: 4px; vertical-align: top;" colspan="2"> YULIANSYAH, S. Sos, M.M.<br> NIP. 19741015 201001 1 001</td>
        </tr>
        <tr class="tabelbaris">
            <td style="text-align: center; width: 4%; padding: 4px; vertical-align: top;">2</td>
            <td style="padding: 4px; vertical-align: top;"> Nama / NIP Pegawai yang <br>  melaksanakan perjalanan dinas </td>
            <td style="padding: 4px; vertical-align: top;"colspan="2"> <b>{{ $rperjadin->pegawai->nama }}</b> <br> NIP. {{ $rperjadin->pegawai->nip }}</td>
        </tr>
        <tr class="tabelbaris">
            <td style="text-align: center; width: 4%; padding: 4px; vertical-align: top;">3</td>
            <td style="padding: 4px; vertical-align: top;"> a. Pangkat dan Golongan <br>  b. Jabatan / Instansi <br>  c. Tingkat Biaya Perjalanan Dinas</td>
            <td style="padding: 4px; vertical-align: top;"colspan="2"> a. {{ $rperjadin->pegawai->pangkgol }} <br>  b. {{ $rperjadin->pegawai->jabatan }} <br>  c. @if($rperjadin->jenis = 1)Dalam Daerah @else Luar Daerah @endif </td>
        </tr>
        <tr class="tabelbaris">
            <td style="text-align: center; width: 4%; padding: 4px; vertical-align: top;">4</td>
            <td style="padding: 4px; vertical-align: top;"> Maksud Perjalanan Dinas </td>
            <td style="padding: 4px; vertical-align: top;"colspan="2"> {{ $rperjadin->perjadin->keperluan }}</td>
        </tr>
        <tr class="tabelbaris">
            <td style="text-align: center; width: 4%; padding: 4px; vertical-align: top;">5</td>
            <td style="padding: 4px; vertical-align: top;"> Alat Angkut yang Dipergunakan </td>
            <td style="padding: 4px; vertical-align: top;"colspan="2"> Angkutan Darat dan Angkutan Udara</td>
        </tr>
        <tr class="tabelbaris">
            <td style="text-align: center; width: 4%; padding: 4px; vertical-align: top;">6</td>
            <td style="padding: 4px; vertical-align: top;"> a. Tempat Berangkat <br> b. Tempat Tujuan </td>
            <td style="padding: 4px; vertical-align: top;"colspan="2"> a. Banjarbaru <br> b. {{ $rperjadin->perjadin->tujuan }}</td>
        </tr>
        <tr class="tabelbaris">
            @php
            $jumlahHari = \Carbon\Carbon::parse($rperjadin->perjadin->tgl_pulang)
                ->diffInDays(\Carbon\Carbon::parse($rperjadin->perjadin->tgl_berangkat)) + 1;
            @endphp
            <td style="text-align: center; width: 4%; padding: 4px; vertical-align: top;">7</td>
            <td style="padding: 4px; vertical-align: top;"> a. Lamanya Perjalanan Dinas <br> b. Tanggal Berangkat <br> c. Tanggal Harus Kembali/<br>&nbsp;&nbsp;&nbsp; Tiba Ditempat Baru </td>
            <td style="padding: 4px; vertical-align: top;"colspan="2"> a. {{ $jumlahHari }} ({{ ucwords(trim(terbilang($jumlahHari))) }}) Hari <br> b. 12 Oktober 2026 <br> c. 14 Oktober 2026</td>
        </tr>
        <tr class="tabelbaris">
            <td rowspan="2" style="text-align: center; width: 4%; padding: 4px; vertical-align: top;">8</td>
            <td style="padding: 4px; vertical-align: top;"> &nbsp;&nbsp;&nbsp; Pengikut : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Nama </td>
            <td style="padding: 4px; vertical-align: top;"> Tanggal Lahir</td>
            <td style="padding: 4px; vertical-align: top;"> Keterangan</td>
        </tr>
        <tr class="tabelbaris">
            <td style="padding: 4px; vertical-align: top;">1. <br> 2. <br> 3. <br> 4. <br> 5. <br> </td>
            <td style="padding: 4px; vertical-align: top;"></td>
            <td style="padding: 4px; vertical-align: top;"></td>
        </tr>
        <tr class="tabelbaris">
            <td style="text-align: center; width: 4%; padding: 4px; vertical-align: top;">9</td>
            <td style="padding: 4px; vertical-align: top;">Pembebanan Anggaran <br> a. Instansi <br><br> b. Akun</td>
            <td style="padding: 4px; vertical-align: top;"colspan="2"><br> a. Balai Pelatihan Koperasi dan Usaha Kecil<br>&nbsp;&nbsp;&nbsp; Provinsi Kalimantan Selatan <br> b. {{ $rperjadin->perjadin->anggaran->subkegiatan->kd_subkegiatan }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{ $rperjadin->perjadin->anggaran->koderekening->kd_rekening }}   </td>
        </tr>
        
    </table>
    <br>
    <br>
    {{-- TTD --}}
    <table class="text" style="margin-left: 5px; border-collapse: collapse;">
        <tr>
            <td style="vertical-align: top;  width: 450px"></td>
            <td style="vertical-align: top;  text-align:justify;">
                Dikeluarkan di
            </td>
            <td style="vertical-align: top; text-align:justify;">
                : Banjarbaru
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="vertical-align: top; text-align:justify;">
                Tanggal
            </td>
            <td style="vertical-align: top; text-align:justify;">
                : {{ \Carbon\Carbon::parse($rperjadin->perjadin->tgl_berangkat)->locale('id')->translatedFormat('d F Y') }}<br><br>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" style="vertical-align: top; text-align:center; ">
                <b>KEPALA BALAI</b>
                <br><br><br><br>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" style="vertical-align: top; text-align:center;">
                <b>YULIANSYAH, S. Sos, M.M.</b><br>Penata Tk. I<br>NIP. 19741015 201001 1 001
            </td>
        </tr>
    </table>
    

    
</body>
</html>
