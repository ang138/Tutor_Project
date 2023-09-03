<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TutorController;
use App\Http\Middleware\Advisor;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function ()
{
    return view('welcome');
});

Route::get('/', [HomeController::class, 'home']);
Route::get('about', [HomeController::class, 'about']);
Route::get('applyTutor', [HomeController::class, 'applyTutor']);
Route::get('contact', [HomeController::class, 'contact']);




// สำหรับการลงทะเบียนและเข้าสู่ระบบ

// Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

// Route::get('tutor/home', [App\Http\Controllers\HomeController::class, 'index'])->name('tutor.home');
// Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('status');

Route::middleware(['guest'])->group(function ()
{
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    // Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
});

Route::middleware(['auth'])->group(function ()
{
    // หน้าหลังเข้าสู่ระบบของแอดมิน
    Route::get('adminHome', [AdminController::class, 'adminHome'])->name('adminHome')->middleware('status');


    // หน้าหลังเข้าสู่ระบบของอาจารย์ที่ปรึกษา
    Route::get('advisorHome', [AdvisorController::class, 'advisorHome'])->name('advisorHome')->middleware('advisor');


    // หน้าหลังเข้าสู่ระบบของนิสิต
    Route::get('tutorHome', [TutorController::class, 'tutorHome'])->name('tutorHome');
    Route::get('manageSubject', [TutorController::class, 'manageSubject']);
    Route::get('enrollment', [TutorController::class, 'enrollment']);





});
