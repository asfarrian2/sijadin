         <form action="{{ Route('u.pptk')}}"  method="POST" enctype="multipart/form-data">
         @csrf
             <div class="mb-3">
                 <label class="form-label">PPTK :</label>
                 <select class="input-default form-control" name="pegawai" required>
                    <option value="">Pilih PPTK</option>
                    @foreach ($pegawai as $d)
                    <option {{ $pptk->id_pegawai == $d->id_pegawai ? 'selected' : '' }}
                    value="{{ Crypt::encrypt($d->id_pegawai) }}">{{$d->nip }} - {{$d->nama }} </option>
                    @endforeach
                </select>
                 <input type="hidden" name="dpa" value="{{ Crypt::encrypt($dpa->id_dpa) }}" class="form-control input-default" required>
                 <input type="hidden" name="pptk" value="{{ Crypt::encrypt($pptk->id_pegawai) }}" class="form-control input-default" required>
             </div>
        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
