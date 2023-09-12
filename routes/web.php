<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManageAdvisorController;
use App\Http\Controllers\ManageStudentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TutorController;
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

// -------------------------------หน้าหลัก---------------------------------------------------
Route::get('/', [HomeController::class, 'home']);
Route::get('about', [HomeController::class, 'about']);
Route::get('applyTutor', [HomeController::class, 'applyTutor']);
Route::get('contact', [HomeController::class, 'contact']);
Route::get('subject', [HomeController::class, 'subject']);
Route::get('detail', [HomeController::class, 'detail']);

// routes/web.php
Route::get('/searchStudent', [HomeController::class, 'showTutorForm'])->name('applyTutorForm');
Route::post('/searchStudent', [HomeController::class, 'searchStudent'])->name('searchStudent');

Route::put('/updateStudent/{std_id}', [HomeController::class, 'updateStudent'])->name('updateStudent');

Route::get('checkTutorStatus', [HomeController::class, 'checkTutorStatus'])->name('checkTutorStatus');


// -------------------------------หน้าสำหรับการเข้าสู่ระบบ---------------------------------------------------
Route::middleware(['guest'])->group(function ()
{
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    // Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
});

// -------------------------------หน้าหลังทำการเข้าสู่ระบบ---------------------------------------------------
Route::middleware(['auth'])->group(function ()
{
    // -----ออกจากระบบ-----
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


    // -----แสดงสาขาวิชา-----
    Route::post('api/fetch-majors', [AdvisorController::class, 'fetchMajors']);


    // -------------------------------หน้าหลังเข้าสู่ระบบของแอดมิน---------------------------------------------------
    Route::get('adminHome', [AdminController::class, 'adminHome'])->name('adminHome')->middleware('status');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');

    Route::put('/admin/images/{id}', [AdminController::class, 'updateImage'])->name('admin.image.update');

    Route::delete('/admin/images/{id}', [AdminController::class, 'deleteImage'])->name('admin.image.delete');



    // -------------------------------จัดการข้อมุลนิสิต------------------------------------
    // -----แสดงข้อมูลนิสิต-----
    Route::get('manageStudent', [StudentController::class, 'manageStudent'])->name('manageStudent');

    // -----เพิ่มข้อมูลนิสิต-----
    Route::get('addStudent', [StudentController::class, 'insertstdform']);
    Route::post('insert-student', [StudentController::class, 'insertstd']);

    // -----อัปเดตข้อมูลนิสิต------
    Route::get('edit-student/{std_id}', [StudentController::class, 'editStudent']);
    Route::put('update-student/{std_id}', [StudentController::class, 'updateStudent']);

    // -----ลบข้อมูลนิสิต-----
    Route::delete('delete-student/{std_id}', [StudentController::class, 'deleteStudent'])->name('deleteStudent');




    // -------------------------------จัดการข้อมุลอาจารย์------------------------------------
    // -----แสดงข้อมูลอาจารย์-----
    Route::get('manageAdvisor', [AdvisorController::class, 'manageAdvisor'])->name('manageAdvisor');

    // -----เพิ่มข้อมูลอาจารย์-----
    Route::get('/addAdvisor', [AdvisorController::class, 'insertadvisorform']);
    Route::post('/insert-advisor', [AdvisorController::class, 'insertadvisor']);


    // -----อัปเดตข้อมูลอาจารย์------
    Route::get('edit-advisor/{advisor_id}', [AdvisorController::class, 'editAdvisor']);
    Route::put('update-advisor/{advisor_id}', [AdvisorController::class, 'updateAdvisor']);

     // -----ลบข้อมูลนิสิต-----
     Route::delete('delete-advisor/{advisor_id}', [AdvisorController::class, 'deleteAdvisor'])->name('deleteAdvisor');



    // -------------------------------หน้าหลังเข้าสู่ระบบของอาจารย์ที่ปรึกษา---------------------------------------------------
    Route::get('advisorHome', [AdvisorController::class, 'advisorHome'])->name('advisorHome')->middleware('advisor');
    Route::get('approveTutor', [AdvisorController::class, 'approveTutor']);

    // -------------------------------หน้าหลังเข้าสู่ระบบของนิสิต---------------------------------------------------
    Route::get('tutorHome', [StudentController::class, 'tutorHome'])->name('tutorHome');
    Route::get('manageSubject', [StudentController::class, 'manageSubject']);
    Route::get('enrollment', [StudentController::class, 'enrollment']);

});
