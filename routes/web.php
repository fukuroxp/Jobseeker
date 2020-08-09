<?php

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

Route::get('/', function () {
    // return redirect('/login');
    return view('home');
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/test', function() {
//     return view('home');
// });

// Route::group(['middleware' => 'auth'], function () {
//     Route::resource('users', 'UserController');
//     Route::resource('materi', 'MateriController');
//     Route::resource('video', 'VideoController');
//     Route::post('task/{id}/submit', 'TaskController@submit')->name('task.submit');
//     Route::resource('task', 'TaskController');
//     Route::resource('kelas', 'KelasController');
//     Route::post('soal/exam/answer', 'SoalController@storeAnswer')->name('soal.storeAnswer');
//     Route::post('soal/exam/finish', 'SoalController@examFinish')->name('soal.examFinish');
//     Route::post('soal/{id}/item', 'SoalController@storeItem')->name('soal.storeItem');
//     Route::post('soal/{id}/exam', 'SoalController@examStart')->name('soal.examStart');
//     Route::resource('soal', 'SoalController');
//     Route::get('home/notifications', 'HomeController@loadMoreNotifications');
//     Route::post('home/feed', 'HomeController@feed')->name('home.feed');
//     Route::post('home/reply', 'HomeController@reply')->name('home.reply');

//     Route::get('activity', 'ReportController@activity')->name('report.activity');
//     Route::post('nilai', 'ReportController@saveNilai')->name('report.saveNilai');
//     Route::get('nilai', 'ReportController@nilai')->name('report.nilai');

//     Route::get('setting', 'HomeController@setting')->name('home.setting');
//     Route::post('setting', 'HomeController@updateSetting')->name('home.updateSetting');
//     Route::post('password', 'HomeController@updatePassword')->name('home.updatePassword');
// });