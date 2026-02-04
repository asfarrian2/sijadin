         <form action="{{ Route('a.dpa')}}"  method="POST" enctype="multipart/form-data">
         @csrf
             <div class="mb-3">
                 <label class="form-label">Nama DPA :</label>
                 <input type="hidden" name="tahun" value="{{ Crypt::encrypt($tahun->id_tahun) }}" class="form-control input-default" required>
                 <input type="text" name="dpa" class="form-control input-default" required>
             </div>
             <div class="mb-3">
                 <label class="form-label">Tanggal DPA :</label>
                 <input type="date" name="tgl" class="form-control input-default" required>
             </div>

        </div>
     </div>
     <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
