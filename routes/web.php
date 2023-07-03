<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PolisaOsiguranjaController;
use App\Http\Controllers\novi;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminPanelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth', 'isUser')->group(function() {

Route::get('/osiguranje', [PolisaOsiguranjaController::class, 'prikaz']);

Route::post('/osiguranje', [PolisaOsiguranjaController::class, 'vrstaPolise']);

Route::post('/osiguranje/dodajPolisu', [PolisaOsiguranjaController::class, 'dodajPolisu']);

Route::get('/blog', [BlogController::class, 'metoda']);
//user prikaz postova/blogova

Route::get('/blog/kreirajBlog', [BlogController::class, 'AdminBlog']);
//user kreiranje posta

Route::get('/blog/prikaziIzabraniBlog/{id}', [BlogController::class, 'AdminBlogPrikazi']);

Route::post('/adminPanel/blog/napraviBlog', [BlogController::class, 'napraviNoviBlog']);

});

//// 
//MIDDLEWARE
////// 
Route::middleware('auth', 'isAdmin')->group(function() {

Route::get('/adminPanel/polise', [AdminPanelController::class, 'svePolise']);

Route::get('/adminPanel/polise/prikaz',[AdminPanelController::class, 'prikazPolisa']);

Route::get('/adminPanel/polise/osiguranici', [AdminPanelController::class, 'sviOsiguranici']);

Route::get('/adminPanel/blog/prikazBlog', [AdminPanelController::class, 'prikaziSveAdminBlog']);
//admin prikaz svih blogova

Route::post('/adminPanel/blog/obrisi', [AdminPanelController::class, 'obrisiBlog']);
//admin brisanje iz tabele blogovi
Route::post('/adminPanel/blog/objavi', [AdminPanelController::class, 'objaviBlog']);
//objavljivanje blogova
Route::post('/adminPanel/blog/arhiviraj', [AdminPanelController::class, 'arhivirajBlog']);
//arhiviranje blogova
 

 
Route::get('/adminPanel/blog/prikaz', [AdminPanelController::class, 'sviBlogovi']);

Route::get('/adminPanel/blog/izmeniBlog/{id}', [BlogController::class, 'AdminBlogIzmeni']);


Route::post('/adminPanel/blog/sacuvajIzmenuBloga', [BlogController::class, 'sacuvajIzmenuBlog']);

// Route::post('/adminPanel/blog/napraviBlog', [BlogController::class, 'napraviNoviBlog']);

Route::get('/adminPanel/korisnici', [AdminPanelController::class, 'prikazKorisnika']);

Route::get('/adminPanel/korisnici/prikazi', [AdminPanelController::class, 'sviKorisnici']);

Route::get('/adminPanel/blog/izmeniKorisnika/{id}', [AdminPanelController::class, 'AdminKorisnikIzmeni']);

Route::post('/adminPanel/blog/sacuvajIzmenuKorisnika', [AdminPanelController::class, 'sacuvajIzmenuKorisnika']);

Route::post('/adminPanel/korisnik/obrisi', [AdminPanelController::class, 'obrisiKorisnika']);

Route::get('/adminPanel/korisnici/registracija', [AdminPanelController::class, 'registrujKorisnika']);

// Route::post('/adminPanel/korisnici/registracijaSacuvaj', [AdminPanelController::class, 'sacuvajKorisnika']);

});

// Route::get('/adminPanel/blog', [AdminPanelController::class, 'sviBlogovi']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
