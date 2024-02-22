<?php

namespace App\Trait;

use Illuminate\Support\Facades\Session;

trait TestHeaders{


    public function setHeaders($token)
    {
        Session::put('headers',[
            "Authorization" => "Bearer $token",
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ]);
    }

    public function getHeaders()
    {
        return Session::get('headers');
    }
}