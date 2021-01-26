<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentInsertController;
use App\Http\Controllers\AppointmentController;

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

/*Route::get('/', function () {
    return view('welcome');
});
*/

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/malf_fr_appointment_booking', [AppointmentController::class, 'index'])->name('newAppointment');
Route::get('/listing', [CountyController::class, 'index'])->name('listAppointment');
Route::post('/appointment', 'App\Http\Controllers\AppointmentInsertController@insert')->name('storeNewAppointment');
Route::post('/get_appointment', 'App\Http\Controllers\AppointmentController@ajaxGetAppointment')->name('ajaxGetAppointment');

