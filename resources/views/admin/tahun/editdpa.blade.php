         <form action="{{ Route('u.dpa')}}"  method="POST" enctype="multipart/form-data">
         @csrf
             <div class="mb-3">
                 <label class="form-label">Nomor DPA :</label>
                 <input type="hidden" name="id" value="{{ Crypt::encrypt($dpa->id_dpa) }}" class="form-control input-default" required>
                 <input type="text" name="dpa" value="{{ $dpa->dpa }}" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Tanggal DPA :</label>
                 <input type="date" name="tanggal" value="{{ $dpa->tgl }}" class="form-control input-default" required>
             </div>
        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
