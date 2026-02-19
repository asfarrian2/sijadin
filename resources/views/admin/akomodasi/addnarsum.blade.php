    <form action="/admin/perjadinfasilitator/simpannarsum"  method="POST" enctype="multipart/form-data">
         @csrf
         <input type="hidden" name="id_perjadin" value="{{ Crypt::encrypt($id_perjadin) }}">
            <div class="mb-3">
                <label class="form-label">Fasilitator / Narasumber :</label>
                <select class="input-default form-control" name="narsum" id="narsum" required>
                    <option value="">Pilih Fasilitator/Narasumber</option>
                    @foreach ($pegawai as $d)
                    <option value="{{ Crypt::encrypt($d->id_pegawai) }}"> {{$d->nama}} - {{$d->jabatan}}</option>
                    @endforeach
                </select>
            </div>    
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="simpan-pegawai"><i class="fa fa-save color-muted"></i> Simpan</button>
            </div>
    </form>
