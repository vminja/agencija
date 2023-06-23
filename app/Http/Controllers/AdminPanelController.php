<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\agencijaAdmin;
use Illuminate\Support\Facades\DB;

class AdminPanelController extends Controller
{
    public function metoda(Request $req){
      
        $data = new agencijaAdmin;
        $data = $data->sviPostovi();  

        return view('adminPanel', ['data' => $data]);
    }
    
    public function metodaServer(Request $request) {
        // za prikaz svih blogova
        $tabela = new agencijaAdmin;
        $sqlData = $tabela->fetchDataTable($request);
        // dd($sqlData);
        $data['draw'] = $request->input('draw');
        $data['recordsFiltered'] = $sqlData['filter'];  
        $data['recordsTotal'] = count($sqlData['data']); 
        $data['data'] = $sqlData['data'];
        // dd($data);
        return json_encode($data);
      }

      public function svePolise(Request $request){
        $tabela = new agencijaAdmin;
        $sqlData = $tabela->poliseDataTable($request);
        // dd($sqlData);
        $data['draw'] = $request->input('draw');
        $data['recordsFiltered'] = $sqlData['filter'];  
        $data['recordsTotal'] = count($sqlData['data']); 
        $data['data'] = $sqlData['data'];
        // dd($data);
        return json_encode($data);
      }

}
