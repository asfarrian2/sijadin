         <form action="{{ Route('u.narsum')}}"  method="POST" enctype="multipart/form-data">
         @csrf
             <div class="mb-3">
                 <label class="form-label">Nama :</label>
                 <input type="hidden" name="id" value="{{ Crypt::encrypt($pegawai->id_pegawai) }}" class="form-control input-default" required>
                 <input type="text" name="nama" value="{{ $pegawai->nama }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">NIP :</label>
                 <input type="text" name="nip" value="{{ $pegawai->nip }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Pangkat / Golongan :</label>
                 <input type="text" name="pangkgol" value="{{ $pegawai->pangkgol }}" class="form-control input-default">
             </div>
             <div class="mb-3">
                 <label class="form-label">Jabatan / Lembaga / Instansi:</label>
                 <input type="text" name="jabatan" value="{{ $pegawai->jabatan }}" class="form-control input-default" required>
             </div>
        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
