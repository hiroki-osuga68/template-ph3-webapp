<?php
// ファサードの追加
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
// メールテスト用のクラス
use App\Mail\Test;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'WebappController@index')->middleware('auth')->name('webapp');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// 最終的にはログインしてユーザーごとのwebappが表示されるように変更
Route::get('/webapp', 'WebappController@index')->middleware('auth')->name('webapp');
// 投稿機能
Route::post('/webapp/store', 'WebappController@store')->middleware('auth')->name('store');

// メールテスト
Route::get('/test', function () {
    Mail::to('test@example.com')->send(new Test);
    return 'メール送信しました！';
});

// 管理者
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('admin-register');

Route::view('/admin', 'admin')->middleware('auth:admin')->name('admin-home');

// 学習コンテンツ管理
// prefixがあってるか後で検証
Route::prefix('admin_content')->group(function () {
    Route::get('/', 'AdmincontentController@index')->name('admin_content.index');
    Route::post('/', 'AdmincontentController@store')->name('admin_content.store');
    // 編集ルーティング
    Route::get('/edit/{id}', 'AdmincontentController@edit')->name('admin_content.edit');
    Route::post('/update/{id}', 'AdmincontentController@update')->name('admin_content.update');
    Route::post('/destroy/{id}', 'AdmincontentController@destroy')->name('admin_content.destroy');
    Route::post('/restore/{id}', 'AdmincontentController@restore')->name('admin_content.restore');
});

// 学習言語管理
// prefixがあってるか後で検証
Route::prefix('admin_language')->group(function () {
    Route::get('/', 'AdminlanguageController@index')->name('admin_language.index');
    Route::post('/', 'AdminlanguageController@store')->name('admin_language.store');
    // 編集ルーティング
    Route::get('/edit/{id}', 'AdminlanguageController@edit')->name('admin_language.edit');
    Route::post('/update/{id}', 'AdminlanguageController@update')->name('admin_language.update');
    Route::post('/destroy/{id}', 'AdminlanguageController@destroy')->name('admin_language.destroy');
    Route::post('/restore/{id}', 'AdminlanguageController@restore')->name('admin_language.restore');
});

// ユーザー管理
Route::prefix('admin_users_table')->group(function () {
    Route::get('/', 'AdminuserstableController@index')->name('admin_users_table.index');
    Route::post('/', 'AdminuserstableController@store')->name('admin_users_table.store');
});
// 管理者の管理
Route::prefix('admin_admins_table')->group(function () {
    Route::get('/', 'AdminadminstableController@index')->name('admin_admins_table.index');
    Route::post('/', 'AdminadminstableController@store')->name('admin_admins_table.store');
});