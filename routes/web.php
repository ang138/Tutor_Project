<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
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

Route::get('subject', [SubjectController::class, 'subject']);

Route::get('course-open/{subject_id}', [SubjectController::class, 'showcourseOpen'])->name('courseOpen');

Route::get('course-open-detail/{course_id}', [SubjectController::class, 'courseOpenDetail'])->name('courseOpenDetail');

Route::get('enroll-form/{course_id}', [SubjectController::class, 'enrollForm'])->name('enrollmentCourse');

Route::post('/insert-enroll-course/{course_id}', [SubjectController::class, 'insertEnrollCourseAction'])
    ->name('insertEnrollCourseAction');

Route::get('enrollHistory', [HomeController::class, 'enrollHistory']);

Route::post('/searchEnroll', [HomeController::class, 'searcheEroll'])->name('searchEnroll');


Route::get('applyTutor', [HomeController::class, 'applyTutor']);
Route::get('contact', [HomeController::class, 'contact']);

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

    Route::post('api/fetch-majors', [AdvisorController::class, 'fetchMajors'])->name('fetch-majors');
    Route::post('/fetch-advisors', [AdvisorController::class, 'fetchAdvisors'])->name('fetch-advisors');
    Route::post('/fetch-advisors-2', [AdvisorController::class, 'fetchAdvisors2'])->name('fetch-advisors-2');

    // -------------------------------หน้าหลังเข้าสู่ระบบของแอดมิน---------------------------------------------------
    Route::get('adminHome', [AdminController::class, 'adminHome'])->name('adminHome')->middleware('status');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');

    Route::put('/admin/images/{id}', [AdminController::class, 'updateImage'])->name('admin.image.update');

    Route::delete('/admin/images/{id}', [AdminController::class, 'deleteImage'])->name('admin.image.delete');

    // -------------------------------จัดการข้อมุลนิสิต------------------------------------
    // -----แสดงข้อมูลนิสิต-----
    Route::get('manageStudent', [StudentController::class, 'manageStudent'])->name('manageStudent');

    // -----เพิ่มข้อมูลนิสิต-----
    Route::get('/addStudent', [StudentController::class, 'insertstdform']);
    Route::post('/insert-student', [StudentController::class, 'insertstd']);

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

    Route::get('detail-student/{std_id}', [AdvisorController::class, 'detailStudent']);
    Route::post('approve-student/{std_id}', [AdvisorController::class, 'approveStudent'])->name('approveStudent');
    //  Route::put('update-advisor/{advisor_id}', [AdvisorController::class, 'updateAdvisor']);

    // -------------------------------หน้าหลังเข้าสู่ระบบของนิสิต---------------------------------------------------
    Route::get('/tutorHome', [StudentController::class, 'tutorHome'])->name('tutorHome')->middleware('tutor');

    Route::put('/student/images/{std_id}', [StudentController::class, 'studentImageProfile'])->name('std.image.profile');

    Route::get('manageSubject', [StudentController::class, 'manageSubject']);

    Route::get('enrollment', [StudentController::class, 'enrollment']);

    Route::get('/user-enroll/{course_id}', [CourseController::class, 'viewUserEnroll']);

    Route::get('user-detail/{cus_id}', [CourseController::class, 'viewUserDetail']);

    // -----เพิ่มข้อรายวิชา-----
    Route::get('addCourse', [CourseController::class, 'addcourseform']);
    Route::post('insert-course', [CourseController::class, 'insertcourse']);
    // Route::post('insert-student', [StudentController::class, 'insertstd']);

    // -----อัปเดตรายวิชา------
    Route::get('/course-details/{course_id}', [CourseController::class, 'viewCourseDetails']);
    Route::get('edit-course/{course_id}', [CourseController::class, 'editCourse']);
    Route::put('update-course/{course_id}', [CourseController::class, 'updatenewCourse']);

    Route::post('/update-course-status/{course_id}', [CourseController::class, 'updateCourseStatus'])->name('updateCourseStatus');

});
