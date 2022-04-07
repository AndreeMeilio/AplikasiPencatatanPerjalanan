<div class="tab-pane fade" id="perjalanan" role="tabpanel" aria-labelledby="nav-perjalanan-tab">
    <div class="card mb-3">
        <div class="card-header text-center py-3">
            DATA PERJALANAN
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3 mb-2 d-flex align-items-center">Urutkan Berdasarkan</div>
                <div class="col-6 col-md-3 mb-2">
                    <form>
                        <select class="form-select" name="urut_data_form" id="urut_berdasarkan">
                            <option value="tanggal" selected>Tanggal</option>
                            <option value="suhu">Suhu</option>
                        </select>
                    </form>
                </div>
                <div class="col-6 col-md-3 mb-2">
                    <form>
                        <select class="form-select" name="format_urut" id="format_urut">
                            <option value="asc" selected>Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </form>
                </div>
                <div class="col-12 col-md-3 mb-2">
                    <button class="btn btn-success" type="button" id="btn_submit_urut">Submit</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row" id="container-content-perjalanan">
        <div class="d-flex justify-content-center" id="loading">
            <div class="spinner-border text-dark fw-bold" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination align-items-end justify-content-end" id="pagination">
            
        </ul>
    </nav>
</div>
