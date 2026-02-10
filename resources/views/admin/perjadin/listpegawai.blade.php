
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
            @foreach ($rperjadin as $d )
            <tr>
            <td>
		    	<div class="form-check custom-checkbox checkbox-success check-lg me-3">
		    		<input type="checkbox" class="form-check-input hapus-checkbox" value="{{ Crypt::encrypt($d->id_rperjadin)}}">
		    		<label class="form-check-label" for="customCheckBox2"></label>
                    {{ $loop->iteration }}
		    	</div>
		    </td>
            <td style="color: black;"><b>{{ $d->pegawai->nama }}</b><br>{{ $d->pegawai->nip}}</td>
            <td style="color: black;">{{ $d->pegawai->jabatan }}</td>
            @if ($status > 0)
            <td>
                <a type="button" href="/admin/perjadin/pegawai/sppd/{{Crypt::encrypt($d->id_rperjadin)}}" class="btn btn-info btn-xs" target="_BLANK"> <i class="fa fa-print color-muted"></i> SPPD</a>
            </td>
            @else
            @endif
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

@if ($status == 0)
<div class="modal-footer">
    <button type="button" class="btn btn-danger" id="hapus-terpilih"> <i class="fa fa-trash color-muted"></i> Hapus</button>
</div>
@else
@endif

    