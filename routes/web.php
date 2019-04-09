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
			if(Auth::user()->level_user == 'administrator'){
				return redirect()->route('admin.dashboard');
			}
			elseif(Auth::user()->level_user == 'staf_tu'){
				return redirect()->route('staf_tu.dashboard');
			}
			elseif(Auth::user()->level_user == 'pimpinan'){
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

Route::get('/admin/login','AuthAdmin\LoginController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login','AuthAdmin\LoginController@login')->name('admin.login.submit');

Route::get('/staf_tu',function(){
	return redirect()->route('staf_tu.dashboard');
});

Route::get('/pimpinan',function(){
	return redirect()->route('pimpinan.dashboard');
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

Route::group(['prefix'	=>	'admin/surat_masuk_internal'],function(){
	Route::get('/','Admin\SuratMasukInternalController@index')->name('admin.surat_masuk_internal.index');
	Route::get('/api','Admin\SuratMasukInternalController@dataTable')->name('admin.surat_masuk_internal.api');
});

Route::group(['prefix'	=>	'admin/surat_masuk_eksternal'],function(){
	Route::get('/','Admin\SuratMasukEksternalController@index')->name('admin.surat_masuk_eksternal.index');
	Route::get('/api','Admin\SuratMasukEksternalController@dataTable')->name('admin.surat_masuk_eksternal.api');
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
	Route::post('/','Admin\ManajemenUserController@store');
	Route::patch('/{id}','Admin\ManajemenUserController@update');
	Route::delete('/{id}','Admin\ManajemenUserController@destroy');
	Route::get('/{id}/edit','Admin\ManajemenUserController@edit');
	Route::get('/set_nonaktif','Admin\ManajemenUserController@setNonaktif');
	Route::get('/set_active/{id}','Admin\ManajemenUserController@setAktif')->name('admin.manajemen_user.set_aktif');
	Route::get('/api','Admin\ManajemenUserController@dataTable')->name('admin.manajemen_user.api');
});

Route::group(['prefix'	=>	'admin/manajemen_admin'],function(){
	Route::get('/','Admin\ManajemenAdminController@index')->name('admin.manajemen_admin.index');
	Route::post('/','Admin\ManajemenAdminController@store');
	Route::patch('/{id}','Admin\ManajemenAdminController@update');
	Route::delete('/{id}','Admin\ManajemenAdminController@destroy');
	Route::get('/{id}/edit','Admin\ManajemenAdminController@edit');
	Route::get('/api','Admin\ManajemenAdminController@dataTable')->name('admin.manajemen_admin.api');
});

//Route Untuk Staf TU
Route::group(['prefix'	=>	'staf_tu/dashboard'],function(){
	Route::get('/','TataUsaha\TataUsahaController@index')->name('staf_tu.dashboard');
});

Route::group(['prefix'	=>	'staf_tu/surat_masuk_internal'],function(){
	Route::get('/','TataUsaha\SuratMasukInternalController@index')->name('staf_tu.surat_masuk_internal.index');
	Route::post('/','TataUsaha\SuratMasukInternalController@store')->name('staf_tu.surat_masuk_internal.index');;
	Route::patch('/{id}','TataUsaha\SuratMasukInternalController@update')->name('staf_tu.surat_masuk_internal.update');;
	Route::get('/{id}/edit','TataUsaha\SuratMasukInternalController@edit');
	Route::get('/{id}/teruskan','TataUsaha\SuratMasukInternalController@teruskan');
	Route::post('/teruskan','TataUsaha\SuratMasukInternalController@teruskanStore')->name('staf_tu.surat_masuk_internal.teruskan_store');
	Route::delete('/{id}','TataUsaha\SuratMasukInternalController@destroy');
	Route::get('/api','TataUsaha\SuratMasukInternalController@dataTable')->name('staf_tu.surat_masuk_internal.api');
});

Route::group(['prefix'	=>	'staf_tu/surat_masuk_eksternal'],function(){
	Route::get('/','TataUsaha\SuratMasukEksternalController@index')->name('staf_tu.surat_masuk_eksternal.index');
	Route::post('/','TataUsaha\SuratMasukEksternalController@store')->name('staf_tu.surat_masuk_eksternal.index');;
	Route::patch('/{id}','TataUsaha\SuratMasukEksternalController@update')->name('staf_tu.surat_masuk_eksternal.update');;
	Route::get('/{id}/edit','TataUsaha\SuratMasukEksternalController@edit');
	Route::delete('/{id}','TataUsaha\SuratMasukEksternalController@destroy');
	Route::get('/api','TataUsaha\SuratMasukEksternalController@dataTable')->name('staf_tu.surat_masuk_eksternal.api');
});

Route::group(['prefix'	=>	'staf_tu/kode_surat'],function(){
	Route::get('/','TataUsaha\SuratKeluarController@index')->name('staf_tu.surat_keluar.index');
});

Route::group(['prefix'	=>	'staf_tu/panduan'],function(){
	Route::get('/','TataUsaha\PanduanController@index')->name('staf_tu.panduan.index');
});

//Route Untuk Pimpinan
Route::group(['prefix'	=>	'pimpinan/dashboard'],function(){
	Route::get('/','Pimpinan\PimpinanController@index')->name('pimpinan.dashboard');
});

Route::group(['prefix'	=>	'pimpinan/surat_masuk'],function(){
	Route::get('/','Pimpinan\SuratMasukController@index')->name('pimpinan.surat_masuk.index');
});