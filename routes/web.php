<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManageAdvisorController;
use App\Http\Controllers\ManageStudentController;
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


    // -------------------------------หน้าหลังเข้าสู่ระบบของแอดมิน---------------------------------------------------
    Route::get('adminHome', [AdminController::class, 'adminHome'])->name('adminHome')->middleware('status');

    // -------------------------------จัดการข้อมุลนิสิต------------------------------------
    // -----แสดงข้อมูลนิสิต-----
    Route::get('manageStudent', [AdminController::class, 'manageStudent'])->name('manageStudent');

    // -----เพิ่มข้อมูลนิสิต-----
    Route::get('addStudent', [AdminController::class, 'insertstdform']);
    Route::post('insert-student', [AdminController::class, 'insertstd']);

    // -----อัปเดตข้อมูลนิสิต------
    Route::get('edit-student/{std_id}', [AdminController::class, 'editStudent']);
    Route::put('update-student/{std_id}', [AdminController::class, 'updateStudent']);

    // -----ลบข้อมูลนิสิต-----
    Route::delete('delete-student/{std_id}', [AdminController::class, 'deleteStudent'])->name('deleteStudent');




    // -------------------------------จัดการข้อมุลอาจารย์------------------------------------
    // -----แสดงข้อมูลอาจารย์-----
    Route::get('manageAdvisor', [AdminController::class, 'manageAdvisor'])->name('manageAdvisor');

    // -----เพิ่มข้อมูลอาจารย์-----
    Route::get('/addAdvisor', [AdminController::class, 'insertadvisorform']);
    Route::get('/get-majors/{facultyId}', [AdminController::class, 'getMajors']);
    Route::post('/insert-advisor', [AdminController::class, 'insertadvisor']);


    // -----อัปเดตข้อมูลอาจารย์------
    Route::get('edit-advisor/{advisor_id}', [AdminController::class, 'editAdvisor']);
    Route::put('update-advisor/{advisor_id}', [AdminController::class, 'updateAdvisor']);

     // -----ลบข้อมูลนิสิต-----
     Route::delete('delete-advisor/{advisor_id}', [AdminController::class, 'deleteAdvisor'])->name('deleteAdvisor');



    // -------------------------------หน้าหลังเข้าสู่ระบบของอาจารย์ที่ปรึกษา---------------------------------------------------
    Route::get('advisorHome', [AdvisorController::class, 'advisorHome'])->name('advisorHome')->middleware('advisor');
    Route::get('approveTutor', [AdvisorController::class, 'approveTutor']);

    // -------------------------------หน้าหลังเข้าสู่ระบบของนิสิต---------------------------------------------------
    Route::get('tutorHome', [TutorController::class, 'tutorHome'])->name('tutorHome');
    Route::get('manageSubject', [TutorController::class, 'manageSubject']);
    Route::get('enrollment', [TutorController::class, 'enrollment']);

});
