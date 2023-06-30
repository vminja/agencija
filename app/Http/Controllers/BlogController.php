<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Carbon\Carbon;
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

    public function AdminBlog(){

        $data = new agencijaBlog;
        $data = $data->autori();  

        return view('kreirajBlog', ['data' => $data]);

        // return view("kreirajBlog");
        
      }
      
      public function AdminBlogPrikazi(Request $req){
        // dd($req);
                // $id = $req->url();
                $url = $req->url();
                $parsedUrl = parse_url($url);
                $path = $parsedUrl['path'];
                $id = basename($path);
                // dd($id);
                $data = new agencijaBlog;
                $data = $data->postPrikaz($id);  
        
                // dd($data);
        
                return view('prikaziBlog', ['data' => $data]);
        
                // return view("kreirajBlog");
                
              }

      public function AdminBlogIzmeni(Request $req){
// dd($req);
        // $id = $req->url();
        $url = $req->url();
        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path'];
        $id = basename($path);
        // dd($id);
        $data = new agencijaBlog;
        $data = $data->postIzmena($id);  

        // dd($data);

        return view('izmeniBlog', ['data' => $data]);

        // return view("kreirajBlog");
         
      }

      public function napraviNoviBlog(Request $req)
      {
          $autorID = $req->input('autor');
          $naslov = $req->input('naslov');
          $opis = $req->input('opis');
          $tekst = $req->input('content');
          // $tekst = Str::of($tekst)->stripTags();
          $tip = $req->input('tip');
          $statusPosta = $req->input('statusPosta');
          $kreirano =  $req->input('datumKreiranja');
          $kreirano = date('Y-m-d H:i:s');
          $objavljeno = null;
          $arhivirano = null;
  
          // $kreirano = Carbon::parse($kreirano)->toDateString();
          // $kreirano = '2023-05-15';
          if($statusPosta == 'Objavljeno'){
              $objavljeno = $req->input('datumKreiranja');
              $objavljeno = date('Y-m-d H:i:s');
          }
  
          $urlSlika = null; 
          
          $req->validate([
            'slika' => 'required|image|mimes:jpg,jpeg,png,svg,webp'
          ]);
          // $id = new AgencijaBlog;
          // $id = $id->postID($req);
  
          // dd($req->all());
          $agencijaBlog = new AgencijaBlog;
          $slikaID = $agencijaBlog->dodajPost($naslov, $opis, $tekst, $tip, $statusPosta, $kreirano, $objavljeno, $arhivirano, $autorID);
  
          if ($req->hasFile('slika')) {
              $file = $req->file('slika');
              $extention = $file->getClientOriginalExtension();
              $filename = time().'.'.$extention;
              // $file->move("storage/uploads". '/' . $id . '/' , $filename);
              $file->move("storage/uploads/" . $slikaID . '/', $filename);
              $urlSlika = '/storage/uploads/' . $slikaID . '/' . $filename; // Generate the URL for the uploaded picture
              // $file->save();
              // dd($urlSlika);
          }
          // dd($urlSlika);
          $slika = new AgencijaBlog;
          $slika->dodajUrlSlike($urlSlika, $slikaID);
  
          // Save the data to the database
          
          return response()->json(['success' => true]);
      }
  
  
   public function sacuvajIzmenuBlog(Request $req)
      {   
          
          $id = $req->query('id');
          // dd($id);
          $ime = $req->input('ime');
          $tip = $req->input('tip');
  
          $agencijaBlog = new AgencijaBlog;
          $agencijaBlog->azurirajKorisnika($id, $ime, $tip);
  
          // return redirect('/blog');
          return response()->json(['success' => true]);
      }

      public function AdminKorisnikIzmeni(Request $req){
        // dd($req);
        $url = $req->url();
        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path'];
        $id = basename($path);

        $query = new agencijaBlog;
        $data = $query->korisnikIzmena($id);  

        // dd($data);

        return view('izmeniKorisnika', ['data' => $data]);

        // return view("kreirajBlog");
          
      }

      public function sacuvajIzmenuKorisnika(Request $req)
      {  
          
        $id = $req->query('id');

        $ime = $req->input('ime');
        $tip = $req->input('tip');
// dd($id);
        $agencijaBlog = new AgencijaBlog;
        $agencijaBlog->azurirajKorisnika($id, $ime, $tip);

        // return redirect('/blog');
        return response()->json(['success' => true]);
      }

}
