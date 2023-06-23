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
        // dd($data);

        return $data;
    }
}
