<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class agencijaBlog extends Model
{
    use HasFactory;

    public function postovi(){
        $data = DB::table('posts')->select('posts.naslov', 'posts.tekst', 'posts.urlSlika', 'posts.published_at', 'autori.ime', 'autori.prezime')->leftJoin('autori', 'autori.id', '=', 'posts.autorID')->get();
        // dd($data);  DB::raw('SUBSTRING(posts.urlSlika,6,100)')

        return $data;
    }

    public function postIzmena($id){

        $query =  DB::table('posts')->select('posts.id','posts.naslov', 'posts.opis', 'posts.tipPosta' , 'posts.tekst', 'posts.urlSlika' ,  DB::raw('CONCAT(autori.ime, " ", autori.prezime) AS "kolona"'))->leftJoin('autori', 'autori.id', '=', 'posts.autorID')->where('posts.id', $id)->get();
        // dd($query);

        return $query;
    }

    public function autori(){
        $data = DB::table('autori')->select('*')->get();

        return $data;
    }

    // public function postID($req){
    //     $id = $req->input('id');
    //     $data = DB::table('posts')->select('id')->where("id", $id)->get();
    //     return $data;
    // }

    // public function 

    public function dodajPost($naslov, $opis, $tekst, $tip, $statusPosta, $url, $kreirano, $objavljeno, $arhivirano, $autorID){
        // dd($url);

        $data = DB::table('posts')->insert([
            'naslov' =>  $naslov,
            'opis' => $opis,
            'tekst' => $tekst,
            'tipPosta' => $tip,
            'Status' => $statusPosta,
            'created_at' => $kreirano,
            'published_at' => $objavljeno,
            'archived_at' => $arhivirano,
            'urlSlika' => $url,
            'autorID' => $autorID
            
        ]);

        // dd($data);
        // return $data;

    }

    public function azurirajPost($id, $naslov, $opis, $tekst, $tip, $urlSlika){
        // dd($id, $naslov, $opis, $tekst, $tip, $urlSlika);
        // dd("z");
        $data = DB::table('posts')->where('id',$id)->update([
            'naslov' =>  $naslov,
            'opis' => $opis,
            'tekst' => $tekst,
            'tipPosta' => $tip,
            'urlSlika' => $urlSlika
        ]);

        // dd($data);
        // return $data;

    }
}