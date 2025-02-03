<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MasterHeadController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\PublicController;

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



Route::controller(PublicController::class)->group(function(){
    Route::get('/','index')->name('public');
    Route::get('data','get_Data')->name('public.data');
    Route::get('detail','detail')->name('detail');
    Route::post('send/contact','storeMessage')->name('send.contact');
    Route::get('editor/mark-read', 'markAsRead')->name('editor.mark-read');


});

Route::controller(AuthController::class)->middleware('guest')->group(function(){
    Route::get('login','index')->name('login');
    Route::post('login/auth','authenticate')->name('login.auth');
    
});

Route::prefix('editor')->middleware('auth')->group(function(){
    Route::controller(AuthController::class)->group(function(){
        Route::post('logout','logout')->name('logout');
    });
    Route::controller(HomeController::class)->group(function(){
        Route::get('/','index')->name('editor.home');
        Route::get('notif','notification')->name('editor.notif');
    });
    Route::controller(UserController::class)->group(function(){
        Route::get('/users','index')->name('editor.users');
        Route::get('/users/data','getData')->name('editor.users.data');
        Route::post('/users/store','storeData')->name('editor.users.store');
        Route::get('/users/detail','detail')->name('editor.users.detail');
        Route::post('/users/update','updateData')->name('editor.users.update');
        Route::delete('/users/delete','deleteData')->name('editor.users.delete');
    });
    Route::controller(MasterHeadController::class)->group(function(){
        Route::get('/master-head','index')->name('editor.master-head');
        Route::get('/master-head/data','getData')->name('editor.master-head.data');
        Route::post('/master-head/store','storeData')->name('editor.master-head.store');
        Route::get('/master-head/detail','detail')->name('editor.master-head.detail');
        Route::post('/master-head/update','updateData')->name('editor.master-head.update');
        Route::delete('/master-head/delete','deleteData')->name('editor.master-head.delete');
    });
    Route::controller(ContactController::class)->group(function(){
        Route::get('/contact','index')->name('editor.contact');
        Route::get('/contact/data','getData')->name('editor.contact.data');
        Route::delete('/contact/delete','deleteData')->name('editor.contact.delete');
    });
    Route::controller(ServiceController::class)->group(function(){
        Route::get('/service','index')->name('editor.service');
        Route::get('/service/data','getData')->name('editor.service.data');
        Route::post('/service/store','storeData')->name('editor.service.store');
        Route::get('/service/detail','detail')->name('editor.service.detail');
        Route::post('/service/update','updateData')->name('editor.service.update');
        Route::delete('/service/delete','deleteData')->name('editor.service.delete');
    });
    Route::controller(PortofolioController::class)->group(function(){
        Route::get('/portofolio','index')->name('editor.portofolio');
        Route::get('/portofolio/data','getData')->name('editor.portofolio.data');
        Route::post('/portofolio/store','storeData')->name('editor.portofolio.store');
        Route::get('/portofolio/detail','detail')->name('editor.portofolio.detail');
        Route::post('/portofolio/update','updateData')->name('editor.portofolio.update');
        Route::delete('/portofolio/delete','deleteData')->name('editor.portofolio.delete');
    });
    Route::controller(AboutController::class)->group(function(){
        Route::get('/about','index')->name('editor.about');
        Route::get('/about/data','getData')->name('editor.about.data');
        Route::post('/about/store','storeData')->name('editor.about.store');
        Route::get('/about/detail','detail')->name('editor.about.detail');
        Route::post('/about/update','updateData')->name('editor.about.update');
        Route::delete('/about/delete','deleteData')->name('editor.about.delete');
    });
});

