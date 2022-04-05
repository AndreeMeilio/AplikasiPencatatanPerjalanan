<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Pengguna;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    public function get_with_nik($nik)
    {
        try {
            $pengguna = Pengguna::where("nik", $nik)->first();
            if ($pengguna){
                return response()->json(
                    array(
                        "status" => true,
                        "data" => $pengguna
                    )
                , 200);
            }

            return response()->json(
                array(
                    "status" => true,
                    "data" => array()
                )
            , 404);
        } catch (Exception $e){
            return response()->json(
                array(
                    "status" => false,
                    "message" => $e->getMessage()
                )
            , 500);
        }
    }

    public function login_pengguna(Request $request)
    {
        $data = $request->only("nik", "password");
        $validator = Validator::make($data, array(
            "nik" => ["required"],
            "password" => ["required", "min:8"]
        ));
        
        if (!$validator->fails()){
            try {
                $data_pengguna = Pengguna::where("nik", $data["nik"])->first();

                if ($data_pengguna == null){
                    return response()->json(
                        array(
                            "status" => true,
                            "message" => "Data Tidak Ditemukan"
                        )
                    , 404);
                }

                if (Hash::check($data["password"], $data_pengguna["password"])){
                    $message_log = "Melakukan Login Kedalam Aplikasi";

                    Log::create(array(
                        "id_table" => $data_pengguna["nik"],
                        "nik" => $data_pengguna["nik"],
                        "desc" => $message_log
                    ));

                    return response()->json(
                        array(
                            "status" => true,
                            "data" => $data_pengguna
                        )
                    , 200);
                }

                return response()->json(
                    array(
                        "status" => true,
                        "message" => "Data Tidak Ditemukan"
                    )
                , 404);
            } catch (Exception $e) {
                return response()->json(
                    array(
                        "status" => false,
                        "message" => $e->getMessage()
                    )
                , 500);
            }
        } else {
            return response()->json(
                array(
                    "status" => false,
                    "message" => "Format Data Tidak Sesuai",
                    "detail_message" => $validator->errors()
                )
            , 400);
        }
    }

    public function register_pengguna(Request $request)
    {
        $data = $request->only("nik", "nama_lengkap","password");

        $validator = Validator::make($data, array(
            "nik" => ["required", "min:16"],
            "nama_lengkap" => ["required"],
            "password" => ["required", "min:8"]
        ));

        if (!$validator->fails()){ 
            $data["password"] = Hash::make($data["password"]);
        
            try {
                $create_pengguna = Pengguna::create($data);

                return response()->json(
                    array(
                        "status" => true,
                        "message" => "Pembuatan Akun Berhasil Dilakukan"
                    )
                , 200);
            } catch (Exception $e){
                return response()->json(
                    array(
                        "status" => false,
                        "message" => $e->getMessage()
                    )
                , 500);
            }
        } else {
            return response()->json(
                array(
                    "status" => false,
                    "message" => "Format Data Tidak Sesuai",
                    "detail_message" => $validator->errors()
                )
            , 400);
        }
    }
}
