<?php

use App\Http\Controllers\Offers\OfferController;
use Illuminate\Support\Facades\Route;

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

define('PAGINATION_COUNT',10);
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('comment', [App\Http\Controllers\HomeController::class, 'saveComment'])->name('comment.save');



######################## Payement GetWays Routs #######################################
Route::group(['prefix'=>'offers','middleware'=>'auth'],function (){
    Route::get('/',[OfferController::class, 'index'])->name('offers.all');
    Route::get('details/{offer_id}',[OfferController::class, 'show'])->name('offers.show');
});
######################## Payement GetWays Routs #######################################
