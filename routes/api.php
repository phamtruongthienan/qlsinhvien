<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('searchSinhVien', 'HomeController@searchSinhVien');

Route::get('get1SinhVien', 'HomeController@ajaxgetsinhvien');
Route::get('get1Lop', 'HomeController@ajaxgetlop');
Route::get('get1Khoa', 'HomeController@ajaxgetkhoa');
Route::get('testmodel', 'HomeController@index');

Route::get('testapi', 'HomeController@testAPI');

Route::get('testmodel2', 'HomeController@index2');

Route::get('/ajax/sinhvien', 'HomeController@ajaxsinhvien');


Route::get('getKhoa', 'HomeController@GetKhoa');
Route::get('getLop', 'HomeController@GetLop');
Route::get('getSinhVien', 'HomeController@GetSinhVien');
Route::get('searchSinhVien', 'HomeController@searchSinhVien');

Route::post('addKhoa', 'HomeController@addKhoa');
Route::post('updateKhoa', 'HomeController@updateKhoa');
Route::post('deleteKhoa', 'HomeController@deleteKhoa');

Route::post('addLop', 'HomeController@addLop');
Route::post('updateLop', 'HomeController@updateLop');
Route::post('deleteLop', 'HomeController@deleteLop');

Route::post('addSinhVien', 'HomeController@addSinhVien');
Route::post('updateSinhVien', 'HomeController@updateSinhVien');
Route::post('deleteSinhVien', 'HomeController@deleteSinhVien');

