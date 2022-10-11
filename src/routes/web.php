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

Route::get('/', function () {
    return view('welcome');
});

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
