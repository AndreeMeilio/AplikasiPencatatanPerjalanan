const base_url = "http://localhost:8000/api/v1";
const nik = "1103645810166377";

let urut_berdasarkan = "";
let format_urut = "";
let page = 1;
let jumlah_page = "";

let containerContentPerjalanan = $("#container-content-perjalanan");
let loadingElement = $("#loading");
let paginationElement = $("#pagination");

function get_all_data_perjalanan(
  urut_berdasarkan = "",
  format_urut = "",
  page = 1
) {
  let perjalanan_get_url = base_url + "/perjalanan";
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
        html += `
        <div class="col-4 mb-3 perjalanan-box">
            <div class="card content-perjalanan-box">
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
  let url_create_perjalanan = base_url + "/perjalanan/create";

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
      get_all_data_perjalanan();
      get_log_activity();
      get_jumlah_halaman();
    },
    error: function (response) {
      if (response.status === 400) {
        Swal.fire("Input Required", response.responseJSON.message, "error");
      }
    },
  };

  $.ajax(settings);
}

function get_log_activity() {
  let url_log_activity = base_url + "/log";

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
      console.log(response);

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
    "box-shadow": "0px 0px 0px rgb(0, 0, 0)",
  });
}

function get_perjalanan_with_format() {
  urut_berdasarkan = $("#urut_berdasarkan").children("option:selected").val();
  format_urut = $("#format_urut").children("option:selected").val();

  loadingElement.show();
  get_all_data_perjalanan(urut_berdasarkan, format_urut);
}

function data_pagination() {
  // let html = "";
  // if (page != (jumlah_page - 1) && (page != 2) && page != 1){
  //   html += `
  //     <li class="page-item" id="page-item-prev">
  //         <button class="page-link btn_pagination" value="prev" aria-label="Previous">
  //             <span aria-hidden="true">&laquo;</span>
  //         </button>
  //     </li>
  //     <li class="page-item"><button class="page-link btn_pagination" id="btn_pagination_${parseInt(page) - 1}" value="${parseInt(page) - 1}">${parseInt(page) - 1}</button></li>
  //     <li class="page-item"><button class="page-link btn_pagination" id="btn_pagination_${page}" value="${page}">${page}</button></li>
  //     <li class="page-item"><button class="page-link btn_pagination" id="btn_pagination_${parseInt(page) + 1}" value="${parseInt(page) + 1}">${parseInt(page) + 1}</button></li>
  //     <li class="page-item" id="page-item-next">
  //         <button class="page-link btn_pagination" value="next" aria-label="Next">
  //             <span aria-hidden="true">&raquo;</span>
  //         </button>
  //     </li>
  //   `;

  //   paginationElement.html(html);
  // }

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

  get_all_data_perjalanan(urut_berdasarkan, format_urut, page);
}

function get_jumlah_halaman() {
  let url_get_jumlah_halaman = base_url + "/perjalanan/halaman";

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
      <li class="page-item" id="page-item-next">
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

function set_active_page(page)

$(document).ready(function () {
  get_all_data_perjalanan();
  get_log_activity();
  get_jumlah_halaman();

  $("#btn_form_submit").on("click", store_data_perjalanan);
  $("#btn_submit_urut").on("click", get_perjalanan_with_format);
  $(document).on("click", ".btn_pagination", data_pagination);

  $(document).on("mouseenter", ".content-perjalanan-box", perjalanan_box_enter);
  $(document).on("mouseleave", ".content-perjalanan-box", perjalanan_box_leave);
});
