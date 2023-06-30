<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\agencijaBlog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = new agencijaBlog;
        $data = $data->postovi();  

        return view('blog', ['data' => $data]);
        // return view('blog');
    }
}
