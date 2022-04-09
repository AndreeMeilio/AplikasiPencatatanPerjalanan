const base_url = "http://127.0.0.1:8000";
const base_url_api = base_url + "/api/v1";

let nik = sessionStorage.getItem("nik");
let nama_lengkap = sessionStorage.getItem("nama_lengkap");

let urut_berdasarkan = "";
let format_urut = "";
let page = 1;
let jumlah_page = "";

let containerContentPerjalanan = $("#container-content-perjalanan");
let loadingElement = $("#loading");
let paginationElement = $("#pagination");
let txtWelcomeElement = $("#txtWelcome");

function get_all_data_perjalanan(
  urut_berdasarkan = "",
  format_urut = "",
  page = 1
) {
  let perjalanan_get_url = base_url_api + "/perjalanan";
  let html = "";

  let data =
    urut_berdasarkan === ""
      ? {
          nik: nik,
          page: page,
        }
      : {
          nik: nik,
          urut_berdasarkan: urut_berdasarkan,
          format_urut: format_urut,
          page: page,
        };

  const settings = {
    cache: false,
    dataType: "json",
    url: perjalanan_get_url,
    method: "POST",
    data: data,
    success: function (response) {
      let dataResponse = response.data;

      dataResponse.forEach((element) => {
        let databsattribute = `
          data-bs-toggle="modal" 
          data-bs-target="#detailPerjalanan"
          data-bs-id_perjalanan = "${element.id_perjalanan}" 
          data-bs-nik = "${element.nik}"
          data-bs-tanggal = "${element.tanggal}"
          data-bs-waktu = "${element.waktu}"
          data-bs-suhu = "${element.suhu}"
          data-bs-lokasi = "${element.lokasi}"
        `;

        html += `
        <div class="col-12 col-md-4 mb-3 perjalanan-box">
            <div class="card content-perjalanan-box" ${databsattribute}>
                <div class="card-body">
                    <div class="fw-bold fs-5 mb-2 text-center">${element.tanggal} ${element.waktu}</div>
                    <div class="fs-6">Suhu : ${element.suhu} &#8451;</div>
                    <div class="fs-6">Lokasi : ${element.lokasi}
                    </div>
                </div>
            </div>
        </div>
      `;
      });

      loadingElement.hide();
      containerContentPerjalanan.html(html);
    },
    error: function (response) {
      if (response.status === 404) {
        html += `
          <div class="col-12 mb-3">
              <div class="card">
                  <div class="card-body">
                      <div>${response.responseJSON.message}</div>
                  </div>
              </div>
          </div>
        `;

        loadingElement.hide();
        containerContentPerjalanan.html(html);
      }
    },
  };

  $.ajax(settings);
}

function store_data_perjalanan() {
  let url_create_perjalanan = base_url_api + "/perjalanan/create";

  const tanggal_form = $("#tanggal");
  const waktu_form = $("#waktu");
  const suhu_form = $("#suhu");
  const lokasi_form = $("#lokasi");

  let tanggal_value = tanggal_form.val();
  let waktu_value = waktu_form.val();
  let suhu_value = suhu_form.val();
  let lokasi_value = lokasi_form.val();

  let dataRequest = {
    nik: nik,
    tanggal: tanggal_value,
    waktu: waktu_value,
    suhu: suhu_value,
    lokasi: lokasi_value,
  };

  const settings = {
    cache: false,
    method: "POST",
    dataType: "json",
    url: url_create_perjalanan,
    data: dataRequest,
    success: function (response) {
      Swal.fire(
        "Data Berhasil Disimpan",
        "Data Perjalanan Yang Anda Masukkan Berhasil Disimpan",
        "success"
      );
      $("#tanggal").prop("class", "form-control");
      $("#waktu").prop("class", "form-control");
      $("#suhu").prop("class", "form-control");
      $("#lokasi").prop("class", "form-control");
      get_all_data_perjalanan();
      get_log_activity();
      get_jumlah_halaman();
    },
    error: function (response) {
      if (response.status === 400) {
        Swal.fire("Input Required", response.responseJSON.message, "error");
        $data_error = response.responseJSON.detail_message;

        if ("tanggal" in $data_error){
          $("#tanggal").prop("class", "form-control is-invalid");
        } 
        if ("waktu" in $data_error){
          $("#waktu").prop("class", "form-control is-invalid");
        } 
        if ("suhu" in $data_error){
          $("#suhu").prop("class", "form-control is-invalid");
        }
        if ("lokasi" in $data_error){
          $("#lokasi").prop("class", "form-control is-invalid");
        }
      }
    },
  };

  $.ajax(settings);
}

function edit_data_perjalanan(){
  const url_edit_perjalanan = base_url_api + "/perjalanan/edit";

  let id_perjalanan = $(this).val();
  let tanggal = $("#detail_tanggal").val();
  let waktu = $("#detail_waktu").val();
  let suhu = $("#detail_suhu").val();
  let lokasi = $("#detail_lokasi").val();

  const settings = {
    cache: false,
    url: url_edit_perjalanan,
    method: "PUT",
    data : {
      id_perjalanan: id_perjalanan,
      tanggal: tanggal,
      waktu: waktu,
      suhu: suhu,
      lokasi: lokasi
    },
    dataType: false,
    success: function (response){
      Swal.fire(
        "Data Berhasil Diedit",
        "Data Perjalanan Yang Anda Pilih Berhasil Diedit",
        "success"
      );
      $("#detail_tanggal").prop("class", "form-control");
      $("#detail_waktu").prop("class", "form-control");
      $("#detail_suhu").prop("class", "form-control");
      $("#detail_lokasi").prop("class", "form-control");
      get_all_data_perjalanan();
      get_log_activity();
      get_jumlah_halaman();
    }, 
    error: function(response){
      if (response.status === 400) {
        Swal.fire("Input Required", response.responseJSON.message, "error");
        $data_error = response.responseJSON.detail_message;

        if ("tanggal" in $data_error){
          $("#detail_tanggal").prop("class", "form-control is-invalid");
        } 
        if ("waktu" in $data_error){
          $("#detail_waktu").prop("class", "form-control is-invalid");
        } 
        if ("suhu" in $data_error){
          $("#detail_suhu").prop("class", "form-control is-invalid");
        }
        if ("lokasi" in $data_error){
          $("#detail_lokasi").prop("class", "form-control is-invalid");
        }
      }
    }
  }

  $.ajax(settings);
}

function delete_data_perjalanan() {
  const url_delete_data_perjalanan = base_url_api + "/perjalanan/delete";

  let id_perjalanan = $(this).val();

  const settings = {
    cache: false,
    url: url_delete_data_perjalanan,
    data: {
      id_perjalanan: id_perjalanan
    },
    dataType: "json",
    method: "DELETE",
    success: function(response){
      Swal.fire(
        "Data Berhasil Dihapus",
        "Data Perjalanan Yang Anda Pilih Berhasil Dihapus",
        "success"
      );

      // $("#detailPerjalanan").css({
      //   "display": "none"
      // });
      // $("#detailPerjalanan").prop("aria-hidden", true);

      get_all_data_perjalanan();
      get_log_activity();
      get_jumlah_halaman();
    },
    error: function(response){
    }
  }

  $.ajax(settings);
}

function get_detail_perjalanan(){
  let id_perjalanan = $(this).attr("data-bs-id_perjalanan");
  let nik = $(this).attr("data-bs-nik");
  let tanggal = $(this).attr("data-bs-tanggal");
  let waktu = $(this).attr("data-bs-waktu");
  let suhu = $(this).attr("data-bs-suhu");
  let lokasi = $(this).attr("data-bs-lokasi");

  $("#detail_tanggal").val(tanggal);
  $("#detail_waktu").val(waktu);
  $("#detail_suhu").val(suhu);
  $("#detail_lokasi").val(lokasi);
  $("#btn_detail_delete").val(id_perjalanan);
  $("#btn_detail_edit").val(id_perjalanan);
}

function get_log_activity() {
  let url_log_activity = base_url_api + "/log";

  let content_log = $("#content-log");
  let html = "";

  const settings = {
    cache: false,
    method: "POST",
    url: url_log_activity,
    dataType: "json",
    data: {
      nik: nik,
    },
    success: function (response) {
      let dataResponse = response.data;
      dataResponse.forEach((element) => {
        html += `
        <div class="mb-3">
            <div class="col-6 mb-1 border border-bottom-3 border-dark"></div>
            <div class="fw-bold text-start mb-1">${element.id_log} / ${element.created_at}</div>
            <div class="text-start">${element.desc}</div>
        </div>
        `;
      });

      content_log.html(html);
    },
    error: function (response) {
      if (response.status === 404) {
        html += `
        <div class="mb-3">
            <div class="col-6 mb-1 border border-bottom-3 border-dark"></div>
            <div class="fw-bold text-start mb-1">${response.responseJSON.message}</div>
        </div>
        `;
      }

      content_log.html(html);
    },
  };

  $.ajax(settings);
}

function perjalanan_box_enter() {
  $(this).css({
    "box-shadow": "0px 0px 25px #198754",
  });
}

function perjalanan_box_leave() {
  $(this).css({
    "box-shadow": "5px 5px 5px grey"
  });
}

function get_perjalanan_with_format() {
  urut_berdasarkan = $("#urut_berdasarkan").children("option:selected").val();
  format_urut = $("#format_urut").children("option:selected").val();

  page = 1;
  set_active_page(page);
  $("#page-item-prev").attr("class", "page-item disabled");
  $("#page-item-next").attr("class", "page-item");

  loadingElement.show();
  get_all_data_perjalanan(urut_berdasarkan, format_urut);
}

function data_pagination() {
  $("#page-item-prev").attr("class", "page-item");
  $("#page-item-next").attr("class", "page-item");

  btn_pagination_value = $(this).val();

  if (btn_pagination_value == "prev"){
    page--;
  } else if (btn_pagination_value == "next"){
    page++;
  } else {
    page = btn_pagination_value;
  }
  if (page == 1){
    $("#page-item-prev").attr("class", "page-item disabled");
  } else if (page == jumlah_page){
    $("#page-item-next").attr("class", "page-item disabled");
  }

  set_active_page(page);

  get_all_data_perjalanan(urut_berdasarkan, format_urut, page);
}

function get_jumlah_halaman() {
  let url_get_jumlah_halaman = base_url_api + "/perjalanan/halaman";

  const settings = {
    cache: false,
    url: url_get_jumlah_halaman,
    method: "POST",
    data: {
      nik: nik,
    },
    dataType: "json",
    success: function (response) {
      let html = "";
      jumlah_page = response.page;
      let isHalamanFirst = jumlah_page == 1 || jumlah_page == 0 ? "disabled" : "";

      html += `
      <li class="page-item disabled" id="page-item-prev">
          <button class="page-link btn_pagination" value="prev" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
          </button>
      </li>
      `;

      for (let i = 1; i <= jumlah_page; i++) {
        html += `
          <li class="page-item"><button class="page-link btn_pagination" id="btn_pagination_${i}" value="${i}">${i}</button></li>
        `;
      }

      html += `
      <li class="page-item ${isHalamanFirst}" id="page-item-next">
          <button class="page-link btn_pagination" value="next" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
          </button>
      </li>
      `;

      paginationElement.html(html);
    },
  };

  $.ajax(settings);
}

function set_active_page(page_number) {
  $(".btn_pagination").css({
    "background-color" : "whitesmoke",
  });

  $(`#btn_pagination_${page_number}`).css({
    "color" : "black",
    "background-color" : "#198754"
  });
}

function set_nama_welcome(){
  let textWelcome = `Selamat Datang ${nama_lengkap} Di Aplikasi Peduli Diri`;

  txtWelcomeElement.text(textWelcome);
}

function logout(){
  sessionStorage.clear();

  window.location.href = base_url;
}

$(document).ready(function () {  
  get_all_data_perjalanan();
  get_log_activity();
  get_jumlah_halaman();
  set_nama_welcome();
  $("#nik_for_export").val(nik);

  $("#btn_form_submit").on("click", store_data_perjalanan);
  $("#btn_submit_urut").on("click", get_perjalanan_with_format);
  $(document).on("click", ".btn_pagination", data_pagination);

  $(document).on("click", ".content-perjalanan-box", get_detail_perjalanan);
  $(document).on("click", "#btn_detail_delete", delete_data_perjalanan);
  $(document).on("click", "#btn_detail_edit", edit_data_perjalanan);

  $(document).on("mouseenter", ".content-perjalanan-box", perjalanan_box_enter);
  $(document).on("mouseleave", ".content-perjalanan-box", perjalanan_box_leave);

  $("#btn_logout").on("click", logout);
});
