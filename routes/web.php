<?php


use Illuminate\Support\Facades\Artisan;
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

Route::get('/', 'HomeController@home')->name('home');

Route::get('/artikel/{article:slug}', 'HomeController@artikelShow')->name('show.artikel');

//Route::get('/artikel', 'HomeController@artikelIndex')->name('index.artikel');

Route::get('/lowongan', 'HomeController@lowongan')->name('home.lowongan');

Route::get('/lowongan/{id}', 'HomeController@showLowongan')->name('home.showLowongan');

Route::get('/business/{id}', 'HomeController@showBusiness')->name('home.showBusiness');

Route::get('/pengumuman', 'HomeController@showPengumuman')->name('home.showPengumuman');

Route::get('/lowongan/kota/{id}', 'HomeController@lowongan_by_kota')->name('home.showLowonganByCity');
Route::get('/lowongan/kategori/{id}', 'HomeController@lowongan_by_category')->name('home.showLowonganByCategory');

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});


Auth::routes(['verify' => true]);



// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/test', function() {

//     return view('home');

// });



Route::group(['middleware' => ['auth','verified']], function () {
    
    Route::get('rekap/user/excel', 'Cetak\CetakExcel@exportPengguna')->name('excel.pengguna');
    Route::get('rekap/pelamar/excel', 'Cetak\CetakExcel@exportPelamar')->name('excel.pelamar');
    
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('setting', 'SettingController@index')->name('setting.index');

    Route::post('setting/user', 'SettingController@updateUser')->name('setting.updateUser');

    Route::post('setting/password', 'SettingController@updatePassword')->name('setting.updatePassword');

    Route::post('setting/business', 'SettingController@updateBusiness')->name('setting.updateBusiness');

    Route::post('setting/mailer', 'SettingController@updateMailer')->name('setting.updateMailer');

    Route::get('setting/profile', 'ProfileController@create')->name('setting.indexProfile');

    Route::post('setting/profile', 'ProfileController@store')->name('setting.storeProfile');

    Route::get('sliders', 'SliderController@index')->name('sliders.index');

    Route::get('sliders/create', 'SliderController@create')->name('sliders.create');

    Route::post('sliders/create', 'SliderController@store')->name('sliders.store');

    Route::delete('sliders/{id}/delete', 'SliderController@destroy')->name('sliders.destroy');

    Route::get('sponsor', 'SponsorController@index')->name('sponsor.index');

    Route::get('sponsor/create', 'SponsorController@create')->name('sponsor.create');

    Route::post('sponsor/create', 'SponsorController@store')->name('sponsor.store');

    Route::delete('sponsor/{id}/delete', 'SponsorController@destroy')->name('sponsor.destroy');
    
    Route::get('video', 'VideoController@index')->name('video.index');

    Route::get('video/create', 'VideoController@create')->name('video.create');

    Route::post('video/create', 'VideoController@store')->name('video.store');

    Route::delete('video/{id}/delete', 'VideoController@destroy')->name('video.destroy');

    
    Route::get('kategori', 'CategoryController@index')->name('category.index');

    Route::get('kategori/create', 'CategoryController@create')->name('category.create');

    Route::post('kategori/create', 'CategoryController@store')->name('category.store');

    Route::delete('kategori/{id}/delete', 'CategoryController@destroy')->name('category.destroy');
    

    Route::resource('users', 'UserController');



    Route::resource('packages', 'PackageController');

    Route::post('subscriptions/{id}/action', 'SubscriptionController@action')->name('subscriptions.action');

    Route::resource('subscriptions', 'SubscriptionController');

    Route::get('jobs/{id}/apply', 'JobController@getApply')->name('jobs.getApply');

    Route::post('jobs/{id}/apply', 'JobController@apply')->name('jobs.apply');

    Route::get('jobs/{id}/approval/{action}', 'JobController@getApproval')->name('jobs.getApproval');

    Route::post('jobs/{id}/action', 'JobController@action')->name('jobs.action');

    Route::resource('jobs', 'JobController');
    Route::get('jobs/{slug}', 'JobController@show2')->name('jobs.show2');

    Route::resource('applicants', 'JobApplicantController');

    Route::get('detail/{id}/applicants', 'JobApplicantController@detail')->name('applicants.detail');

    Route::resource('articles', 'ArticleController');

    Route::resource('guides', 'GuideController');
    
    Route::resource('perusahaan', 'CompanyController');

    Route::get('mitra', 'CompanyController@detail_perusahaan')->name('mitra.list');

    // Route::resource('users', 'UserController');

    // Route::resource('materi', 'MateriController');

    // Route::resource('video', 'VideoController');

    // Route::post('task/{id}/submit', 'TaskController@submit')->name('task.submit');

    // Route::resource('task', 'TaskController');

    // Route::post('soal/exam/answer', 'SoalController@storeAnswer')->name('soal.storeAnswer');

    // Route::post('soal/exam/finish', 'SoalController@examFinish')->name('soal.examFinish');

    // Route::post('soal/{id}/item', 'SoalController@storeItem')->name('soal.storeItem');

    // Route::post('soal/{id}/exam', 'SoalController@examStart')->name('soal.examStart');

    // Route::resource('soal', 'SoalController');

    // Route::get('home/notifications', 'HomeController@loadMoreNotifications');

    // Route::post('home/feed', 'HomeController@feed')->name('home.feed');

    // Route::post('home/reply', 'HomeController@reply')->name('home.reply');



    // Route::get('activity', 'ReportController@activity')->name('report.activity');

    // Route::post('nilai', 'ReportController@saveNilai')->name('report.saveNilai');

    // Route::get('nilai', 'ReportController@nilai')->name('report.nilai');



    // Route::get('setting', 'HomeController@setting')->name('home.setting');

    // Route::post('setting', 'HomeController@updateSetting')->name('home.updateSetting');

    // Route::post('password', 'HomeController@updatePassword')->name('home.updatePassword');

});