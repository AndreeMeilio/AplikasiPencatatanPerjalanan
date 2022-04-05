<div class="tab-pane fade" id="perjalanan" role="tabpanel" aria-labelledby="nav-perjalanan-tab">
    <div class="card mb-3">
        <div class="card-header text-center py-3">
            DATA PERJALANAN
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-3 d-flex align-items-center">Urutkan Berdasarkan</div>
                <div class="col-3">
                    <form>
                        <select class="form-select" name="urut_data_form" id="urut_berdasarkan">
                            <option value="tanggal" selected>Tanggal</option>
                            <option value="suhu">Suhu</option>
                        </select>
                    </form>
                </div>
                <div class="col-3">
                    <form>
                        <select class="form-select" name="format_urut" id="format_urut">
                            <option value="asc" selected>Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </form>
                </div>
                <div class="col-3">
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
            {{-- <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item"><button class="page-link btn_pagination" value="1">1</button></li>
            <li class="page-item"><button class="page-link btn_pagination" value="2">2</button></li>
            <li class="page-item"><button class="page-link btn_pagination" value="3">3</button></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li> --}}
        </ul>
    </nav>
</div>
