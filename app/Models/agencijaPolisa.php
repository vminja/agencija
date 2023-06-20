<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class agencijaPolisa extends Model
{
    public function vrstaPolise(){
        $data = DB::table('polisa')->select('vrstaPolise')->where('vrstaPolise','!=', '')->distinct();
        $data = $data->get();

        return $data;

    }

    public function dodajPolisu($ime, $prezime, $datum, $telefon, $datumOd, $datumDo, $vrstaPolise){

        $data = DB::table('polisa')->insert([
            'ime' => $ime,
            'prezime' => $prezime,
            'datum_rodjenja' => $datum,
            'telefon' => $telefon,
            'datumPutovanja' => $datumOd,
            'datumPovratka' => $datumDo,
            'vrstaPolise' => $vrstaPolise
        ]);

        return ($data);
    }

    public function dodajOsiguranika($ime, $prezime, $datum, $polisaID){
        $data = DB::table('osiguranici')->insert([
            'ime' => $ime,
            'prezime' => $prezime,
            'datum_rodjenja' => $datum,
            'polisaID' => $polisaID
  //insert get id? 
        ]);

        return $data;
    }


}
