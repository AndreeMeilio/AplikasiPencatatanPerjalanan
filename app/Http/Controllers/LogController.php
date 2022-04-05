<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogController extends Controller
{
    public function get_log(Request $request)
    {
        $data = $request->only("nik");
        $validator = Validator::make($data, array(
            "nik" => ["required"]
        ));

        if (!$validator->fails()){
            try {
                $log = Log::where("nik", $data["nik"])->orderBy("created_at", "desc")->get();

                if (count($log) != 0){
                    return response()->json(
                        array(
                            "status" => true,
                            "data" => $log
                        )  
                    , 200);
                } else {
                    $message = "Log Activity Dengan NIK ". $data["nik"]. " Tidak Ditemukan";
    
                    return response()->json(
                        array(
                            "status" => true,
                            "data" => $log,
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
                    "message" => "NIK Required",
                    "detail_message" => $validator->errors()
                )
            , 400);
        }
    }
}
