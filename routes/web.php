<?php

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

Route::get('/test', function () {
    return "test 123";
});


Route::get('/testmodel', 'HomeController@index')->name('home.index');

Route::get('/testmodel1', 'HomeController@index1')->name('home.index2');

Route::get('/testmodel2', 'HomeController@index2')->name('home.index3');

Route::get('level_school', 'HomeController@admin_level_school_index');

Route::get('khoa', 'HomeController@khoa_index');
Route::get('lop', 'HomeController@lop_index')->name('home.lop');
Route::get('sinhvien', 'HomeController@sinhvien_index')->name('home.sinhvien');
Route::get('timkiem', 'HomeController@timkiem_index');
Route::get('getloptheokhoa', 'HomeController@getloptheokhoa');
Route::get('getsinhvientheolop', 'HomeController@getsinhvientheolop');


Route::get('/ajax/khoa', 'HomeController@ajaxkhoa')->name('home.khoaajax');
Route::get('/ajax/getkhoa', 'HomeController@ajaxgetkhoa')->name('home.getkhoaajax');
Route::post('/ajax/khoa', 'HomeController@ajax_khoa')->name('home.khoaajax');

Route::get('/ajax/sinhvien', 'HomeController@ajaxsinhvien')->name('home.sinhvienajax');
Route::get('/ajax/getsinhvien', 'HomeController@ajaxgetsinhvien')->name('home.getsinhvienajax');
Route::post('/ajax/sinhvien', 'HomeController@ajax_sinhvien')->name('home.sinhvienajax');

Route::get('/ajax/lop', 'HomeController@ajaxlop')->name('home.lopajax');
Route::get('/ajax/getlop', 'HomeController@ajaxgetlop')->name('home.getlopajax');
Route::post('/ajax/lop', 'HomeController@ajax_lop')->name('home.lopajax');

Route::get('/login', 'HomeController@login')->name('admin.login');
Route::post('actionLogin', 'HomeController@login_action')->name('admin.login.action');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/h', 'HomeController@homeh')->name('homeh');
