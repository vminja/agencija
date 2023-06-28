<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\agencijaAdmin;
use Illuminate\Support\Facades\DB;

class AdminPanelController extends Controller
{
  public function prikazPolisa(){
    
    return view('osiguranjeAdminPrikaz');

  }
    public function metoda(Request $req){
      
        $data = new agencijaAdmin;
        $data = $data->sviPostovi();  

        return view('adminPanel', ['data' => $data]);
    }
    
    public function sviOsiguranici(Request $req){
        $id = $req->input('id');
        $model = new agencijaAdmin;
        $data['podaci'] = $model->sviOsiguranici($id);  
        $data['success'] = true;

      // dd($data);

      // return response()->json(['success' => true])->setData($data);
      // return response()->json(['success' => true]);
        return json_encode($data);
    }

    public function sviBlogovi(Request $request) {
        // za prikaz svih blogova
        $tabela = new agencijaAdmin;
        $sqlData = $tabela->blogoviDataTable($request);
        // dd($sqlData);
        $data['draw'] = $request->input('draw');
        $data['recordsFiltered'] = $sqlData['filter'];  
        $data['recordsTotal'] = count($sqlData['data']); 
        $data['data'] = $sqlData['data'];
        // dd($data);
        return json_encode($data);
      }

      

      public function prikaziSveAdminBlog(){

        return view("prikaziBlogove");
        
      }


      public function obrisiBlog(Request $req){
        $id = $req->input('id');
          $data = new agencijaAdmin;
          $data = $data->obrisiBlog($id);  
        // dd($data);
        
        return response()->json(['success' => true]);

      }

      public function objaviBlog(Request $req){
        $id = $req->input('id');
        $statusPosta = $req->input('statusPosta');

        $statusPosta ='Objavljeno';
        $todayDate = Carbon::now();
        $todayDate = date('Y-m-d H:i:s');
        // dd($todayDate);
        // dd($id,$statusPosta);

          $data = new agencijaAdmin;
          $data = $data->objaviBlog($id, $statusPosta, $todayDate);  
        
        return response()->json(['success' => true]);

      }

      public function arhivirajBlog(Request $req){
        $id = $req->input('id');
        $statusPosta = $req->input('statusPosta');

        $statusPosta ='Arhivirano';
        $todayDate = Carbon::now();
        $todayDate = date('Y-m-d H:i:s');
        
        // dd($todayDate);
        // dd($id,$statusPosta);

          $data = new agencijaAdmin;
          $data = $data->arhivirajBlog($id, $statusPosta, $todayDate);  
  
        return response()->json(['success' => true]);

      }
      
      public function svePolise(Request $request){
        // dump($request->all());
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
 