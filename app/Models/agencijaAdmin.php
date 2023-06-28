<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class agencijaAdmin extends Model
{
    use HasFactory;

    public function sviPostovi(){
        $data = DB::table('posts')->select('posts.naslov', 'posts.opis', 'posts.tipPosta' , 'posts.Status' , 'posts.tekst', 'posts.urlSlika', 'posts.published_at' , 'posts.created_at', 'posts.archived_at' ,  'autori.ime', 'autori.prezime')->leftJoin('autori', 'autori.id', '=', 'posts.autorID')->get();
        // dd($data);

        return $data;
    }

    public function sviOsiguranici($id){
        $data = DB::table('osiguranici')->select("polisa.id", "osiguranici.ime", "osiguranici.prezime", "osiguranici.datum_rodjenja")->leftJoin('polisa', 'osiguranici.polisaID', '=', 'polisa.id')->where('polisa.id', $id)->get();
        //select('polisa.id','polisa.ime', 'polisa.prezime', 'osiguranici.ime', 'osiguranici.prezime', 'osiguranici.datum_rodjenja')
        // dd($data);
// dd($data);
        return $data;
    }

    public function obrisiBlog($id){
        $data = DB::table('posts')->where('posts.id', $id)->delete();
        //select('polisa.id','polisa.ime', 'polisa.prezime', 'osiguranici.ime', 'osiguranici.prezime', 'osiguranici.datum_rodjenja')
        // dd($data);

        return $data;
    }
    
    public function objaviBlog($id, $status, $datum){
// dd($id,$status,$datum);
        $data = DB::table('posts')->where('posts.id', $id)->update([
            'Status' =>  $status,
            'published_at' => Carbon::parse($datum)->addHours(2)
        ]);
        //select('polisa.id','polisa.ime', 'polisa.prezime', 'osiguranici.ime', 'osiguranici.prezime', 'osiguranici.datum_rodjenja')
        // dd($data);

        return $data;
    }

    public function arhivirajBlog($id, $status, $datum){
        // dd($id,$status,$datum);
                $data = DB::table('posts')->where('posts.id', $id)->update([
                    'Status' =>  $status,
                    'archived_at' => Carbon::parse($datum)->addHours(2)
                ]);
        
                return $data;
            }

    public function blogoviDataTable($request){
        // dd($request);
        $start = isset($request['start']) ? $request['start'] : 0;
        $length = isset($request['length']) ? $request['length'] : 0;
        $sort = 'autori.ime';
        $sorting = 'asc';
        $search = isset($request['search']['value']) ? $request['search']['value'] : 0;
    
        if (isset($request['order'][0]['column'])) {
            switch ($request['order'][0]['column']) {
                case '0':
                    $sort = 'posts.id';
                    break;
                case '1':
                    $sort = 'autori.ime';
                    break;
                case '2':
                    $sort = 'posts.naslov';
                    break;
                case '3':
                    $sort = 'posts.opis';
                    break;
                case '5':
                    $sort = 'posts.tipPosta';
                    break;
                case '6':
                    $sort = 'posts.Status';
                    break;
            }
        }
    
        if (isset($request['order'][0]['dir'])) {
            $sorting = $request['order'][0]['dir'];
        }
    
        // $data = DB::table('posts')->select('posts.naslov', 'posts.opis', 'posts.tipPosta' , 'posts.Status' , 'posts.tekst', 'posts.urlSlika', 'posts.published_at' , 'posts.created_at', 'posts.archived_at' ,  'autori.ime', 'autori.prezime')->leftJoin('autori', 'autori.id', '=', 'posts.autorID')->get();
        // $SQLquery = $data->orderBy($sort, $sorting);
        //->offset($start)->limit($length);
    
        $query = DB::table('posts')->select('posts.id','posts.naslov', 'posts.opis', 'posts.tipPosta' , 'posts.Status' , 'posts.tekst', 'posts.urlSlika', 'posts.published_at' , 'posts.created_at', 'posts.archived_at' ,  DB::raw('CONCAT(autori.ime, " ", autori.prezime) AS "kolona"'))->leftJoin('autori', 'autori.id', '=', 'posts.autorID');
        // $query = DB::table('posts')->select('posts.naslov', 'posts.opis', 'posts.tipPosta', 'posts.Status', 'posts.tekst', 'posts.urlSlika', 'posts.published_at', 'posts.created_at', 'posts.archived_at', 'autori.ime', 'autori.prezime')->leftJoin('autori', 'autori.id', '=', 'posts.autorID');
        // $query->get()->toArray();
        // dd($query);
        $query->orderBy($sort, $sorting);

        if(!empty($search)){
            $query = $query->whereRaw("(CONCAT(autori.ime, ' ', autori.prezime) LIKE '%{$search}%' OR posts.naslov LIKE '%{$search}%' OR posts.opis LIKE '%{$search}%')");
        }
    
        $filter = $query->count();
        $result = $query->offset($start)->limit($length)->get();
        // return $result;
    
        return [
            'filter' => $filter,
            'data' => $result,
        ];
    
    }

    public function poliseDataTable($request){
        // dd($request);
        $start = isset($request['start']) ? $request['start'] : 0;
        $length = isset($request['length']) ? $request['length'] : 0;
        $sort = 'polisa.id';
        $sorting = 'asc';
        $search = isset($request['search']['value']) ? $request['search']['value'] : 0;
        
        if (isset($request['order'][0]['column'])) {
            switch ($request['order'][0]['column']) {
                case '0':
                    $sort = 'polisa.id';
                    break;
                case '1':
                    $sort = 'polisa.ime';
                    break;
                case '2':
                    $sort = 'polisa.prezime';
                    break;
                case '5':
                    $sort = 'polisa.datumPutovanja';
                    break;
                case '6':
                    $sort = 'polisa.datumPovratka';
                    break;
            }
        }
    
        if (isset($request['order'][0]['dir'])) {
            $sorting = $request['order'][0]['dir'];
        }
    
        $query = DB::table('polisa')->select('polisa.id','polisa.ime', 'polisa.prezime', 'polisa.telefon' , 'polisa.datum_rodjenja' , 'polisa.datumPutovanja', 'polisa.datumPovratka', 'polisa.vrstaPolise')->leftJoin('osiguranici', 'polisa.id', '=', 'osiguranici.polisaID')->distinct('polisa.id');
        $query->orderBy($sort, $sorting);

        if(!empty($search)){
            $query = $query->whereRaw("(polisa.datumPutovanja LIKE '%{$search}%' OR polisa.datumPovratka LIKE '%{$search}%' OR polisa.ime LIKE '%{$search}%' OR polisa.prezime LIKE '%{$search}%')");
        }
    
        $filter = $query->count();

        $result = $query->offset($start)->limit($length)->get();

        //data bi trebalo posebno da se vrati??
        // return $result;
    
        return [
            'filter' => $filter,
            'data' => $result,
        ];
    
    }
}
