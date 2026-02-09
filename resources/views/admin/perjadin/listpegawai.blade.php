
<div class="table-responsive">
    <table id="example" class="table table-striped table-responsive-sm">
        <thead>
            <tr>
                <th style="text-align:center;">NO.</th>
                <th style="text-align:center;">NAMA / NIP <br>PANGKAT / GOL</th>
                <th style="text-align:center;">JABATAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pegawai as $d )
            <tr>
            <td>
		    	<div class="form-check custom-checkbox checkbox-success check-lg me-3">
		    		<input type="checkbox" class="form-check-input pegawai-checkbox" value="{{ Crypt::encrypt($d->id_pegawai)}}">
		    		<label class="form-check-label" for="customCheckBox2"></label>
                    {{ $loop->iteration }}
		    	</div>
		    </td>
            <td style="color: black;"><b>{{ $d->nama }}</b><br>{{ $d->nip}}</td>
            <td style="color: black;">{{ $d->jabatan }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th style="text-align:center;">NO.</th>
                <th style="text-align:center;">NAMA / NIP <br>PANGKAT / GOL</th>
                <th style="text-align:center;">JABATAN</th>
            </tr>
        </tfoot>
    </table>
</div>


    