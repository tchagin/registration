<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Badges\BadgeController;
use App\Http\Controllers\Exhibitions\ExhibitionController;
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
    return view('index');
})->name('home');

Route::get('/lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::get('/choose-lang', [ExhibitionController::class, 'chooseLang'])->name('choose.lang');

Route::get('/exhibitions', [ExhibitionController::class, 'index'])->name('exhibitions');
Route::get('/exhibitions/step-1', [ExhibitionController::class, 'applicationStep1'])->name('application.step1');
Route::get('/exhibitions/step-2', [ExhibitionController::class, 'applicationStep2'])->name('application.step2');
//Route::get('/exhibitions/step-3', [ExhibitionController::class, 'applicationStep3'])->name('application.step3');
Route::post('/exhibitions/store', [ExhibitionController::class, 'applicationStore'])->name('application.store');

Route::get('/badge/{slug}', [BadgeController::class, 'index'])->name('badge');
Route::post('/badge/send', [BadgeController::class, 'send'])->name('badge.send');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});
//Route::get('/register', '\App\Http\Controllers\Admin\UserController@create')->name('register.create');
//Route::post('/register', '\App\Http\Controllers\Admin\UserController@store')->name('register.store');
Route::get('/logout', '\App\Http\Controllers\Admin\UserController@logout')->name('logout');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function (){
//Route::group(['prefix' => 'admin'], function (){
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('/exhibitions', App\Http\Controllers\Admin\Exhibition\ExhibitionController::class);
    Route::resource('/inputs', \App\Http\Controllers\Admin\Form\FormController::class);
    Route::resource('/members', \App\Http\Controllers\Admin\Members\MemberController::class);
    Route::get('/member-list', [\App\Http\Controllers\Admin\Members\MemberController::class, 'memberList'])->name('member-list');
    Route::get('/emp_list',[\App\Http\Controllers\Admin\Members\MemberController::class, 'ss_processing']);
    Route::resource('/visitors', \App\Http\Controllers\Admin\Members\VisitorController::class);
    Route::post('/add-visitor/{member}', [\App\Http\Controllers\Admin\Members\MemberController::class, 'addVisitor'])->name('addVisitor');
    Route::get('/selected-add-visitors', [\App\Http\Controllers\Admin\Members\MemberController::class, 'selectedAddVisitor'])->name('selectedAddVisitor');
    Route::get('/customDelete/{member}', [\App\Http\Controllers\Admin\Members\MemberController::class, 'customDelete'])->name('customDelete');

    Route::resource('/advertising', \App\Http\Controllers\Admin\Advertisings\AdvertisingController::class);
    Route::resource('/industries', \App\Http\Controllers\Admin\Industries\IndustryController::class );
    Route::resource('/distribution', \App\Http\Controllers\Admin\Distribution\DistributionController::class);

    Route::resource('/entrances', \App\Http\Controllers\Admin\Entrances\EntranceController::class);
    Route::resource('/admins', \App\Http\Controllers\Admin\Admins\AdminsController::class);
    Route::get('/edit-pass/{admin}', [\App\Http\Controllers\Admin\Admins\AdminsController::class, 'editPass'])->name('editAdminPass');
    Route::put('/edit-pass/{admin}', [\App\Http\Controllers\Admin\Admins\AdminsController::class, 'storeNewPass'])->name('storeAdminPass');

    Route::get('/qr-panel', [\App\Http\Controllers\Admin\QrPanel\QrPanelController::class, 'index'])->name('panel');
    Route::post('/edit-status-visitor', [\App\Http\Controllers\Admin\QrPanel\QrPanelController::class, 'editStatus'])->name('scaner.status');
});

