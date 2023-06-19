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
}
