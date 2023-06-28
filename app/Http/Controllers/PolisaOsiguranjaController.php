<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\agencijaPolisa;

class PolisaOsiguranjaController extends Controller
{
    public function prikaz(){
        return view('osiguranje');
    }

    public function vrstaPolise(){
        $data = new agencijaPolisa;
        $data = $data->vrstaPolise();  
        // dd($data);

        return view('osiguranje', ['data' => $data]);
    }

    public function dodajPolisu(Request $req){
        // dd($req);
        $polisa = $req->input('polisaData');
        $ime = $polisa['ime'];
        $prezime = $polisa['prezime'];
        $datum = Carbon::parse($polisa['datum'])->addDay()->toDateString();
        $telefon = $polisa['telefon'];
        $datumOd = Carbon::parse($polisa['datumOd'])->addDay()->toDateString();
        $datumDo = Carbon::parse($polisa['datumDo'])->addDay()->toDateString();
        $vrstaPolise = $polisa['vrstaPolise'];

        $polisa = new agencijaPolisa; 
        $polisaID = $polisa->dodajPolisu($ime, $prezime, $datum, $telefon, $datumOd, $datumDo, $vrstaPolise);

        $osiguranici = $req->input('osiguranici');
        // $osiguraniciArr = [];
        if($vrstaPolise === "grupno"){
            foreach ($osiguranici as $osiguranikPolisa) {
                $imeOsiguranika = $osiguranikPolisa['imeO'];
                $prezimeOsiguranika = $osiguranikPolisa['prezimeO'];
                $datumOsiguranika = $osiguranikPolisa['datumO'];

                $osiguranikPolisa = new agencijaPolisa;
                // $osiguraniciArr;
                $osiguranikPolisa->dodajOsiguranika($imeOsiguranika, $prezimeOsiguranika, $datumOsiguranika, $polisaID);
            }
        }

        return response()->json(['success' => true]);


    }

}
     // $osiguranikPolisa = $req->input('osiguranik');
        // // dd($osiguranikPolisa);
        // if($vrstaPolise === "grupno"){

        //     $imeOsiguranika = $osiguranikPolisa['imeO'];
        //     $prezimeOsiguranika = $osiguranikPolisa['prezimeO'];
        //     $datumOsiguranika = $osiguranikPolisa['datumO'];

        //     $osiguranikPolisa = new agencijaPolisa;
        //     $osiguranikPolisa->dodajOsiguranika($imeOsiguranika, $prezimeOsiguranika, $datumOsiguranika, $polisaID);

        // } 
        // za jedan unos u tabelu osiguranici!