const base_url = "http://127.0.0.1:8000";
const base_url_api = base_url + "/api/v1";

let i = 0;
let txt = "MAKE YOUR JOURNEY ALWAYS BE REMEMBERED";
let speed = 50;

function register_pengguna() {
  let url_register = base_url_api + "/pengguna/register";

  let register_nik = $("#register_nik").val();
  let register_nama_lengkap = $("#register_nama_lengkap").val();
  let register_password = $("#register_password").val();

  const settings = {
    cache: false,
    url: url_register,
    method: "POST",
    data: {
      nik: register_nik,
      nama_lengkap: register_nama_lengkap,
      password: register_password,
    },
    dataType: "json",
    success: function (response) {
      console.log(response);
      Swal.fire(
        "Register",
        "Register Berhasil Silahkan Lanjut Login",
        "success"
      );
    },
    error: function (response) {
      console.log(response);
      if (response.status === 400) {
        Swal.fire(
          "Register",
          "Harap Memasukkan Format Data Dengan Benar",
          "error"
        );
      }
    },
  };

  $.ajax(settings);
}

function login_pengguna() {
  let url_login = base_url_api + "/pengguna/login";

  let login_nik = $("#login_nik").val();
  let login_password = $("#login_password").val();

  const settings = {
    cache: false,
    url: url_login,
    method: "POST",
    data: {
      nik: login_nik,
      password: login_password,
    },
    dataType: "json",
    success: function (response) {
      console.log(response);
      sessionStorage.setItem("nik", response.data);
      window.location.href = base_url + "/pencatatan-perjalanan";
    },
    error: function (response) {
      console.log(response);
      if (response.status === 404 || response.status === 400) {
        Swal.fire("Login", "Credential does not match with our data", "error");
      }
    },
  };

  $.ajax(settings);
}

function typeWriter() {
  if (i < txt.length) {
    let elementTxtLandingPage = $("#txtLandingPage").text();
    let txtLandingPage = elementTxtLandingPage + txt.charAt(i);

    $("#txtLandingPage").text(txtLandingPage);
    i++;
    setTimeout(typeWriter, speed);
  }
}

$(document).ready(function () {
  typeWriter();

  $("#btn_submit_register").on("click", register_pengguna);
  $("#btn_submit_login").on("click", login_pengguna);
});
