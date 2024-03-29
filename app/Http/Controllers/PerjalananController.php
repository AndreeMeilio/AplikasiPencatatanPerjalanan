<?php

namespace App\Http\Controllers;

use App\Models\Perjalanan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\PerjalananExport;
use Maatwebsite\Excel\Facades\Excel;

class PerjalananController extends Controller
{
    //
    public function main_entry()
    {
        return view("main");
    }

    public function get_jumlah_halaman(Request $request)
    {
        $data = $request->only("nik");
        $validator = Validator::make($data, array(
            "nik" => ["required"]
        ));

        if (!$validator->fails()){
            try {
                $data_perjalanan = Perjalanan::where("nik", $data["nik"])->count();
                $page = $data_perjalanan / 9;

                return response()->json(
                    array(
                        "status" => true,
                        "page" => ceil($page)
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

    public function get_data_perjalanan(Request $request)
    {
        $data = $request->only(["nik", "page", "urut_berdasarkan", "format_urut"]);
        $validator = Validator::make($data, array(
            "nik" => ["required"],
            "page" => ["required"]
        ));
        if (!$validator->fails()){
            $jumlahDataPerPage = 9;
            $startData = ($data["page"] - 1) * $jumlahDataPerPage;

            try {
                $data_perjalanan = Perjalanan::where("nik", $data["nik"]);
                if (array_key_exists("urut_berdasarkan", $data)){
                    $data_perjalanan->orderBy($data["urut_berdasarkan"], $data["format_urut"]);
                }
                $data_perjalanan = $data_perjalanan->offset($startData)->limit($jumlahDataPerPage)->get();
                if (count($data_perjalanan) != 0){
                    return response()->json(
                        array(
                            "status" => true,
                            "data" => $data_perjalanan
                        )  
                    , 200);
                } else {
                    $message = "Data Perjalanan Dengan NIK ". $data["nik"]. " Tidak Ditemukan. Isi Data Untuk Menambah Data Perjalanan";
    
                    return response()->json(
                        array(
                            "status" => true,
                            "data" => $data_perjalanan,
                            "message" => $message
                        )
                    , 404);
                }
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

    public function create_data_perjalanan(Request $request)
    {
        $data_request = $request->only(
            "nik", "tanggal", "waktu", "suhu", "lokasi"
        );

        $validation = Validator::make($data_request, array(
            "nik" => ["required"],
            // "tanggal" => ["required", "date", "before:now"],
            // "waktu" => ["required", "date_format:H:i"],
            "tanggal" => ["required"],
            "waktu" => ["required"],
            "suhu" => ["required", "numeric"],
            "lokasi" => ["required"]
        ));


        if (!$validation->fails()){
            $data_request["id_perjalanan"] = uniqid("pjln");

            try {
                $create_perjalanan = Perjalanan::create($data_request);

                return response()->json(
                    array(
                        "status" => true,
                        "data" => $create_perjalanan
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
                    "message" => "Harap masukkan semua data dengan benar",
                    "detail_message" => $validation->errors()
                )
            , 400);  
        }
    }

    public function edit_data_perjalanan(Request $request)
    {
        $data = $request->only(
            "id_perjalanan", "tanggal", "waktu", "suhu", "lokasi"
        );

        $validator = Validator::make($data, array(
            "id_perjalanan" => ["required"],
            "tanggal" => ["required", "date", "before:now"],
            "waktu" => ["required", "date_format:H:i"],
            "suhu" => ["required", "numeric"],
            "lokasi" => ["required"]
        ));

        if (!$validator->fails()){
            try {
                $perjalanan = Perjalanan::where("id_perjalanan", $data["id_perjalanan"])->first();

                if ($perjalanan != null){
                    $perjalanan->update($data);

                    return response()->json(
                        array(
                            "status" => true,
                            "message" => "Data perjalanan Berhasil Diedit",
                            "data" => $data
                        )
                    , 200);
                } else {
                    return response()->json(
                        array(
                            "status" => true,
                            "message" => "Data Perjalanan Tidak Ditemukan"
                        )
                    , 404);
                }
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

    public function delete_data_perjalanan(Request $request)
    {
        $data = $request->only("id_perjalanan");
        $validator = Validator::make($data, array(
            "id_perjalanan" => ["required"]
        ));

        if (!$validator->fails()){
            try {
                $data_perjalanan = Perjalanan::where("id_perjalanan", $data["id_perjalanan"])->first();
    
                if ($data_perjalanan != null){
                    $data_perjalanan->delete();
                    
                    return response()->json(
                        array(
                            "status" => true,
                            "data" => $data_perjalanan
                        )
                    , 200);
                } else {
                    return response()->json(
                        array(
                            "status" => true,
                            "message" => "Data Perjalanan Tidak Ditemukan"
                        )
                    , 404);
                }
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

    public function export_perjalnan(Request $request)
    {
        $data = $request->only("nik");
        $validator = Validator::make($data, array(
            "nik" => ["required"]
        ));

        if (!$validator->fails()){
            $export = new PerjalananExport($data["nik"]);

            return Excel::download($export, 'data_perjalanan.xlsx');
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
