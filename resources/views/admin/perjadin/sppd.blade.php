<!DOCTYPE html>
<html>
<head>
	<!-- PAGE TITLE HERE -->
	<title>Sijadin Balatkop-uk Kalsel</title>

	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/profile/Default Picture Profile.png') }}" />
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <style>

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
            <td style="text-align: right; width: 450px">
                Lembar ke
            </td>
             <td style="text-align: left;">
                :
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">
                Kode No.
            </td>
            <td style="text-align: left;">
                :
            </td>
        <tr>
            <td style="text-align: right;">
                Nomor
            </td>
            <td style="text-align: left;">
                :
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
            <td style="padding: 4px; vertical-align: top;"> YULIANSYAH, S. Sos, M.M.<br> NIP. 19741015 201001 1 001</td>
        </tr>
        <tr class="tabelbaris">
            <td style="text-align: center; width: 4%; padding: 4px; vertical-align: top;">2</td>
            <td style="padding: 4px; vertical-align: top;"> Nama / NIP Pegawai yang <br>  melaksanakan perjalanan dinas </td>
            <td style="padding: 4px; vertical-align: top;"> <b>ACHMAD SAHRUL ASFARIANOOR, S. Kom</b> <br>  NIP. 20000514 202421 1 003</td>
        </tr>
        <tr class="tabelbaris">
            <td style="text-align: center; width: 4%; padding: 4px; vertical-align: top;">3</td>
            <td style="padding: 4px; vertical-align: top;"> a. Pangkat dan Golongan <br>  b. Jabatan / Instansi <br>  c. Tingkat Biaya Perjalanan Dinas</td>
            <td style="padding: 4px; vertical-align: top;"> a. IX <br>  b. Pranata Komputer Ahli Pertama <br>  c. Luar Daerah</td>
        </tr>
        <tr class="tabelbaris">
            <td style="text-align: center; width: 4%; padding: 4px; vertical-align: top;">4</td>
            <td style="padding: 4px; vertical-align: top;"> Maksud Perjalanan Dinas </td>
            <td style="padding: 4px; vertical-align: top;"> Perjalanan Dinas Luar Daerah Dalam Rangka Menghadiri Undangan Sosialisasi Kepmendagri900.1-2850 Tahun 2025</td>
        </tr>
        <tr class="tabelbaris">
            <td style="text-align: center; width: 4%; padding: 4px; vertical-align: top;">5</td>
            <td style="padding: 4px; vertical-align: top;"> Alat Angkut yang Dipergunakan </td>
            <td style="padding: 4px; vertical-align: top;"> Angkutan Darat dan Angkutan Udara</td>
        </tr>
    </table>
    
    {{-- TTD --}}
    <table class="text" style="margin-left: 10px; border-collapse: collapse;">
        <tr>
            <td style="vertical-align: top;  width: 350px"></td>
            <td style="vertical-align: top;  text-align:justify;">
                <b>DITETAPKAN DI</b>
            </td>
            <td style="vertical-align: top; text-align:justify;">
                <b>: BANJARBARU</b>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="vertical-align: top; text-align:justify;">
                <b>PADA TANGGAL</b>
            </td>
            <td style="vertical-align: top; text-align:justify;">
                <b>: {{ strtoupper(\Carbon\Carbon::parse($rperjadin->perjadin->tgl_berangkat)->locale('id')->translatedFormat('d F Y')) }}</b><br><br>
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
