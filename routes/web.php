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

Route::get('/staf_tu',function(){
	return redirect()->route('staf_tu.dashboard');
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

Route::group(['prefix'	=>	'admin/jenis_surat'],function(){
	Route::get('/','Admin\JenisSuratController@index')->name('admin.jenis_surat.index');
	Route::get('/create','Admin\JenisSuratController@create')->name('admin.jenis_surat.create');
	Route::post('/','Admin\JenisSuratController@store')->name('admin.jenis_surat.store');
	Route::get('/detail','Admin\JenisSuratController@show')->name('admin.jenis_surat.show');
	Route::get('/{id}/edit','Admin\JenisSuratController@edit')->name('admin.jenis_surat.edit');
	Route::put('/{id}','Admin\JenisSuratController@update')->name('admin.jenis_surat.update');
	Route::delete('/{id}','Admin\JenisSuratController@destroy')->name('admin.jenis_surat.destroy');
	Route::get('/api','Admin\JenisSuratController@dataTable')->name('admin.jenis_surat.api');
});

Route::group(['prefix'	=>	'admin/surat_masuk'],function(){
	Route::get('/','Admin\SuratMasukController@index')->name('admin.surat_masuk.index');
	Route::get('/create','Admin\SuratMasukController@create')->name('admin.surat_masuk.create');
	Route::post('/','Admin\SuratMasukController@store')->name('admin.surat_masuk.store');
	Route::get('/detail','Admin\SuratMasukController@show')->name('admin.surat_masuk.show');
	Route::get('/{id}/edit','Admin\SuratMasukController@edit')->name('admin.surat_masuk.edit');
	Route::put('/{id}','Admin\SuratMasukController@update')->name('admin.surat_masuk.update');
	Route::delete('/{id}','Admin\SuratMasukController@destroy')->name('admin.surat_masuk.destroy');
	Route::get('/api','Admin\SuratMasukController@dataTable')->name('admin.surat_masuk.api');
});

Route::group(['prefix'	=>	'admin/satuan_kerja'],function(){
	Route::get('/','Admin\SatuanKerjaController@index')->name('admin.satuan_kerja.index');
	Route::get('/create','Admin\SatuanKerjaController@create')->name('admin.satuan_kerja.create');
	Route::post('/','Admin\SatuanKerjaController@store')->name('admin.satuan_kerja.store');
	Route::get('/detail','Admin\SatuanKerjaController@show')->name('admin.satuan_kerja.show');
	Route::get('/{id}/edit','Admin\SatuanKerjaController@edit')->name('admin.satuan_kerja.edit');
	Route::put('/{id}','Admin\SatuanKerjaController@update')->name('admin.satuan_kerja.update');
	Route::delete('/{id}','Admin\SatuanKerjaController@destroy')->name('admin.satuan_kerja.destroy');
	Route::get('/api','Admin\SatuanKerjaController@dataTable')->name('admin.satuan_kerja.api');
});

Route::group(['prefix'	=>	'admin/manajemen_jabatan'],function(){
	Route::get('/','Admin\ManajemenJabatanController@index')->name('admin.manajemen_jabatan.index');
	Route::get('/create','Admin\ManajemenJabatanController@create')->name('admin.manajemen_jabatan.create');
	Route::post('/','Admin\ManajemenJabatanController@store')->name('admin.manajemen_jabatan.store');
	Route::get('/detail','Admin\ManajemenJabatanController@show')->name('admin.manajemen_jabatan.show');
	Route::get('/{id}/edit','Admin\ManajemenJabatanController@edit')->name('admin.manajemen_jabatan.edit');
	Route::put('/{id}','Admin\ManajemenJabatanController@update')->name('admin.manajemen_jabatan.update');
	Route::delete('/{id}','Admin\ManajemenJabatanController@destroy')->name('admin.manajemen_jabatan.destroy');
	Route::get('/api','Admin\ManajemenJabatanController@dataTable')->name('admin.manajemen_jabatan.api');
});

Route::group(['prefix'	=>	'admin/surat_keluar'],function(){
	Route::get('/internal','Admin\SuratKeluarController@internal')->name('admin.surat_keluar.internal');
	Route::get('/eksternal','Admin\SuratKeluarController@eksternal')->name('admin.surat_keluar.eksternal');
});

Route::group(['prefix'	=>	'admin/pejabat_disposisi'],function(){
	Route::get('/','Admin\PejabatDisposisiController@index')->name('admin.pejabat_disposisi.index');
	Route::get('/create','Admin\PejabatDisposisiController@create')->name('admin.pejabat_disposisi.create');
	Route::post('/','Admin\PejabatDisposisiController@store')->name('admin.pejabat_disposisi.store');
	Route::get('/detail','Admin\PejabatDisposisiController@show')->name('admin.pejabat_disposisi.show');
	Route::get('/{id}/edit','Admin\PejabatDisposisiController@edit')->name('admin.pejabat_disposisi.edit');
	Route::put('/{id}','Admin\PejabatDisposisiController@update')->name('admin.pejabat_disposisi.update');
	Route::delete('/{id}','Admin\PejabatDisposisiController@destroy')->name('admin.pejabat_disposisi.destroy');
	Route::get('/api','Admin\PejabatDisposisiController@dataTable')->name('admin.pejabat_disposisi.api');
});

Route::group(['prefix'	=>	'admin/satuan_kerja'],function(){
	Route::get('/','Admin\SatuanKerjaController@index')->name('admin.satuan_kerja.index');
});

Route::group(['prefix'	=>	'admin/manajemen_user'],function(){
	Route::get('/','Admin\ManajemenUserController@index')->name('admin.manajemen_user.index');
});

//Route Untuk Staf TU
Route::group(['prefix'	=>	'staf_tu/dashboard'],function(){
	Route::get('/','TataUsaha\TataUsahaController@index')->name('staf_tu.dashboard');
});

Route::group(['prefix'	=>	'staf_tu/surat_masuk'],function(){
	Route::get('/','TataUsaha\SuratMasukController@index')->name('staf_tu.surat_masuk.index');
	Route::get('/create','TataUsaha\SuratMasukController@create')->name('staf_tu.surat_masuk.create');
	Route::post('/','TataUsaha\SuratMasukController@store')->name('staf_tu.surat_masuk.store');
	Route::get('/detail','TataUsaha\SuratMasukController@show')->name('staf_tu.surat_masuk.show');
	Route::get('/{id}/edit','TataUsaha\SuratMasukController@edit')->name('staf_tu.surat_masuk.edit');
	Route::put('/{id}','TataUsaha\SuratMasukController@update')->name('staf_tu.surat_masuk.update');
	Route::delete('/{id}','TataUsaha\SuratMasukController@destroy')->name('staf_tu.surat_masuk.destroy');
	Route::get('/api','TataUsaha\SuratMasukController@dataTable')->name('staf_tu.surat_masuk.api');
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