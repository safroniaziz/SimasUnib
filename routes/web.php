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
    if(Auth::check()){
			if(Auth::user()->level == 'administrator'){
				return redirect()->route('admin.dashboard');
			}
			elseif(Auth::user()->level == 'staf_tu'){
				return redirect()->route('staf_tu.dashboard');
			}
			elseif(Auth::user()->level == 'pimpinan'){
				return redirect()->route('pimpinan.dashboard');
			}
			else{
				return redirect()->route('login');
			}
	}
	return redirect()->route('login');
});

Route::get('/admin',function(){
	return redirect()->route('admin.dashboard');
});

Auth::routes();

// Route Untuk Admin
// Route::get('/admin/dashboard', 'HomeController@index')->name('home');
Route::group(['prefix'	=>	'admin/dashboard'],function(){
	Route::get('/','Admin\AdminController@index')->name('admin.dashboard');
});

Route::group(['prefix'	=>	'admin/kode_surat'],function(){
	Route::get('/','Admin\KodeSuratController@index')->name('admin.kode_surat.index');
	Route::get('/create','Admin\KodeSuratController@create')->name('admin.kode_surat.create');
	Route::post('/','Admin\KodeSuratController@store')->name('admin.kode_surat.store');
	Route::get('/detail','Admin\KodeSuratController@show')->name('admin.kode_surat.show');
	Route::get('/{id}/edit','Admin\KodeSuratController@edit')->name('admin.kode_surat.edit');
	Route::put('/{id}','Admin\KodeSuratController@update')->name('admin.kode_surat.update');
	Route::delete('/{id}','Admin\KodeSuratController@destroy')->name('admin.kode_surat.destroy');
	Route::get('/api','Admin\KodeSuratController@dataTable')->name('admin.kode_surat.api');
	
});

Route::group(['prefix'	=>	'admin/surat_keluar'],function(){
	Route::get('/internal','Admin\SuratKeluarController@internal')->name('admin.surat_keluar.internal');
	Route::get('/eksternal','Admin\SuratKeluarController@eksternal')->name('admin.surat_keluar.eksternal');
});

Route::group(['prefix'	=>	'admin/pejabat_disposisi'],function(){
	Route::get('/','Admin\PejabatDisposisiController@index')->name('admin.pejabat_disposisi.index');
});

Route::group(['prefix'	=>	'admin/satuan_kerja'],function(){
	Route::get('/','Admin\SatuanKerjaController@index')->name('admin.satuan_kerja.index');
});

Route::group(['prefix'	=>	'admin/manajemen_user'],function(){
	Route::get('/','Admin\ManajemenUserController@index')->name('admin.manajemen_user.index');
});

//Route Untuk Staf TU
Route::group(['prefix'	=>	'staf_tu'],function(){
	Route::get('/','TataUsaha\TataUsahaController@index')->name('staf_tu.dashboard');
});

Route::group(['prefix'	=>	'staf_tu/surat_masuk'],function(){
	Route::get('/','TataUsaha\SuratMasukController@index')->name('staf_tu.surat_masuk.index');
});

Route::group(['prefix'	=>	'staf_tu/kode_surat'],function(){
	Route::get('/','TataUsaha\SuratKeluarController@index')->name('staf_tu.surat_keluar.index');
});

Route::group(['prefix'	=>	'staf_tu/panduan'],function(){
	Route::get('/','TataUsaha\PanduanController@index')->name('staf_tu.panduan.index');
});

//Route Untuk Pimpinan
Route::group(['prefix'	=>	'pimpinan'],function(){
	Route::get('/','Pimpinan\PimpinanController@index')->name('pimpinan.dashboard');
});

Route::group(['prefix'	=>	'pimpinan/surat_masuk'],function(){
	Route::get('/','Pimpinan\SuratMasukController@index')->name('pimpinan.surat_masuk.index');
});