<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasInfoController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
Auth::routes([ 'register' => false ]);
Route::get('/mail',[ProfileController::class,'mail']);
Route::get('/', function () {
    return redirect('login');
});
Route::middleware('auth')->group(function () {
    Route::view('guru', 'rating.guru');
    Route::view('kelas', 'kelas.kelas');
    Route::view('murid', 'rating.murid');
    Route::get('kelas-info/{id}',[KelasInfoController::class,'index']);
    Route::get('home', [HomeController::class, 'index']);
    Route::get('profile', [ProfileController::class,'index']);
    Route::post('profile', [ProfileController::class, 'profile']);
    Route::middleware('admin')->group(function () {
        Route::view('pengaturan-data', 'pengaturan-data');
        Route::view('rate-data', 'data.rate-data');
        Route::view('guru-data', 'data.guru-data');
        Route::view('murid-data', 'data.murid-data');
        Route::view('agama-data', 'data.agama-data');
        Route::view('jurusan-data', 'data.jurusan-data');
        Route::view('mapel-data', 'data.mapel-data');
    });
});
Route::get('test', function(){
    $test = Auth::user()->like;
    dd($test);
});

