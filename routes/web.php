<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuctionItemController;

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', function () {return view('welcome');});
	Route::get('/getAuctionItems', [AuctionItemController::class, 'getAuctionItems']);
	Route::get('/detail', [App\Http\Controllers\AuctionItemController::class, 'getSingleItem'])->name('detail');
	Route::post('/update', [App\Http\Controllers\AuctionItemController::class, 'bidItem'])->name('update');
	Route::post('/autoBid', [App\Http\Controllers\AuctionItemController::class, 'autoBidItem'])->name('autoBid');
	Route::post('/updateBidCheck', [App\Http\Controllers\AuctionItemController::class, 'updateBidValue'])->name('updateBidCheck');
});