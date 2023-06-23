<?php

namespace App\Http\Controllers;

use App\Models\agencijaBlog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function metoda(){

        $data = new agencijaBlog;
        $data = $data->postovi();  

        return view('blog', ['data' => $data]);
    }
}
