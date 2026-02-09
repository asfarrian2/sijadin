         <form action="{{ Route('u.perjadin')}}"  method="POST" enctype="multipart/form-data">
         @csrf
         <input type="hidden" name="id" value="{{ Crypt::encrypt($perjadin->id_perjadin) }}">
         <input type="hidden" id="id_anggaran_hidden" value="{{ $perjadin->id_anggaran }}">
            <div class="mb-3">
                <label class="form-label">Dasar Anggaran:</label>
                <select class="input-default form-control" name="dpa" id="eanggaran" required>
                    <option value="">Pilih Dasar Anggaran</option>
                    @foreach ($dpa as $d)
                    <option {{ $id_dpa == $d->id_dpa ? 'selected' : '' }}
                    value="{{ Crypt::encrypt($d->id_dpa) }}">{{$d->dpa }} </option>
                    @endforeach
                </select>
            </div>    
            <div class="mb-3">
                <label class="form-label">Sub Kegiatan / Kode Rekening :</label>
                <select class="input-default form-control" name="anggaran" id="esubkegiatan" required>
                    <option value="">Pilih Sub Kegiatan / Kode Rekening</option>
                </select>
            </div>
            <div class="mb-3 type_msg">
                <label class="form-label">Dasar Perjalanan :</label>
                <textarea style="height: 80px;" name="dasar" class="form-control" required>{{ $perjadin->dasar }}</textarea>
            </div> 
            <div class="mb-3">
                <label class="form-label">Keperluan / Perihal:</label>
                <textarea style="height: 80px;" name="keperluan" class="form-control" required>{{ $perjadin->keperluan }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tujuan :</label>
                <input type="text" name="tujuan" value="{{ $perjadin->tujuan }}" class="form-control input-default" required>
            </div>  
            <div class="mb-3">
                <label class="form-label">Tanggal Berangkat :</label>
                <input type="date" name="tgl_berangkat" value="{{ $perjadin->tgl_berangkat }}" id="etgl_berangkat" class="form-control input-default" required>
            </div> 
            <div class="mb-3">
                <label class="form-label">Tanggal Pulang :</label>
                <input type="date" name="tgl_pulang" id="etgl_pulang" value="{{ $perjadin->tgl_pulang }}" class="form-control input-default" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Perjalanan :</label>
                <select class="input-default form-control" name="jenis" required>
                    <option value="">Pilih Jenis Perjalanan</option>
                    <option value="1" {{ $perjadin->jenis == 1 ? 'selected' : '' }}>Dalam Daerah</option>
                    <option value="2" {{ $perjadin->jenis == 2 ? 'selected' : '' }}>Luar Daerah</option>
                </select>
            </div>
        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
