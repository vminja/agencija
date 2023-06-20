<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

    public function dodajPolisu(Request $req){
        $ime = $req->input('ime');
        $prezime = $req->input('prezime');
        $datum = Carbon::parse($req->input('datum'))->toDateString();
        $telefon = $req->input('telefon');
        $datumOd = Carbon::parse($req->input('datumOd'))->toDateString();
        $datumDo = Carbon::parse($req->input('datumDo'))->toDateString();
        $vrstaPolise = $req->input('vrstaPolise');

        $polisa = new agencijaPolisa;
        $polisa->dodajPolisu($ime, $prezime, $datum, $telefon, $datumOd, $datumDo, $vrstaPolise);

        //---------\\

        $imeO = $req->input($osiguranik['ime']);
        $prezimeO = $req->input($osiguranik['prezime']);
        $datumO = Carbon::parse($req->input($osiguranik['datum']))->toDateString();
        $polisaID = 5 ;

        $osiguranik = new agencijaPolisa;
        $osiguranik->dodajOsiguranika($imeO, $prezimeO, $datumO, $polisaID);

        return response()->json(['success' => true]);

    }

    public function dodavanjeOsiguranika(Request $req){
        $imeO = $req->input('ime');
        $prezimeO = $req->input('prezime');
        $datumO = Carbon::parse($req->input('datum'))->toDateString();
        $polisaID = 5 ;
        //insert get id? 

        $osiguranik = new agencijaPolisa;
        $osiguranik->dodajOsiguranika($ime, $prezime, $datum, $polisaID);

        return response()->json(['success' => true]);
    }
}
