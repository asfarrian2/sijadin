         <form action="{{ Route('u.anggaran')}}"  method="POST" enctype="multipart/form-data">
         @csrf
             <div class="mb-3">
                <label class="form-label">Pagu :</label>
                <input type="hidden" name="id" value="{{ Crypt::encrypt($anggaran->id_anggaran) }}" required>
                <input type="text" name="pagu" value="{{ $anggaran->pagu }}" class="form-control input-default pagu" required>
             </div>
        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
