<?php

namespace App\Trait;

use Illuminate\Http\Response;

trait HttpResponses{

    protected function success($data, $message, $code=200, $mcode=0){
        return response()->json([
            "status" => "Success",
            "message" => $message,
            "code" => $mcode,
            "data" => $data
        ], $code);
    }


    protected function error($data, $message, $code, $mcode=1){
        return response()->json([
            "status" => "Error",
            "message" => $message,
            "code" => $mcode,
            "data" => $data
        ], $code);
    }
}