<div class="tab-pane fade" id="form-perjalanan" role="tabpanel" aria-labelledby="nav-form-tab">
    <div class="card">
        <div class="card-header text-center py-3">
            ISI DATA PERJALANAN
        </div>
        <div class="card-body">
            <div>Dimohon Untuk Memasukkan Semua Data Pada Form</div>
        </div>
    </div>
    <form class="mt-3">
        <div class="mb-3">
            <label for="tanggal" class="form-label text-light fs-5 fw-bold">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" placeholder="Masukkan Tanggal Perjalanan"
                aria-describedby="tanggalHelp">
        </div>
        <div class="mb-3">
            <label for="waktu" class="form-label text-light fs-5 fw-bold">Waktu</label>
            <input type="time" class="form-control" id="waktu" placeholder="Masukkan Waktu Perjalanan"
                aria-describedby="waktuHelp">
        </div>
        <div class="mb-3">
            <label for="suhu" class="form-label text-light fs-5 fw-bold">Suhu</label>
            <input type="text" class="form-control" id="suhu"
                placeholder="Masukkan Suhu Ketika Memasuki Lokasi Perjalanan" aria-describedby="suhuHelp">
        </div>
        <div class="mb-3">
            <label for="lokasi" class="form-label text-light fs-5 fw-bold">Lokasi Perjalanan</label>
            <textarea class="form-control" name="lokasi" id="lokasi" cols="30" rows="4"
                placeholder="Masukkan Lokasi Perjalanan"></textarea>
        </div>
        <button class="btn btn-info text-dark float-end px-5 mb-5" id="btn_form_submit" type="button">Submit</button>
    </form>
</div>
