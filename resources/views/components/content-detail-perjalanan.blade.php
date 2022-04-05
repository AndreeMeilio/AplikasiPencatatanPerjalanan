<div class="modal fade" id="detailPerjalanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Perjalanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="tanggal" class="col-form-label">Tanggal</label>
                        <input type="date" class="form-control" id="detail_tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="waktu" class="col-form-label">Waktu</label>
                        <input type="time" class="form-control" id="detail_waktu">
                    </div>
                    <div class="mb-3">
                        <label for="suhu" class="col-form-label">Suhu</label>
                        <input type="text" class="form-control" id="detail_suhu">
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="col-form-label">Lokasi</label>
                        <textarea class="form-control" cols="30" rows="4" id="detail_lokasi"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btn_detail_delete">Delete</button>
                <button type="button" class="btn btn-success px-4" id="btn_detail_edit">Edit</button>
            </div>
        </div>
    </div>
</div>