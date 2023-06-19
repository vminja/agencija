<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\agencijaPolisa;

class PolisaOsiguranjaController extends Controller
{
    public function metoda(){
        $data = new agencijaPolisa;
        $data = $data->vrstaPolise();  
        // dd($data);

        return view('osiguranje', ['data' => $data]);
    }
}
