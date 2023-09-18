<!-- การเรียกใช้งาน Tempate -->
@extends('layouts.main_template')
@section('title')
    หาติวเตอร์
@endsection
@section('content')
    <div class="container py-5">
        <h1 style="text-align: center; font-weight: bold;">ข้อมูลรายละเอียดคอร์สและติวเตอร์</h1>
        <div class="row pt-3">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="text-center">
                        <img src="{{ asset($students->std_image) }}"
                            style="width: 200px; height: 185px;">
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">ชื่อ</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->std_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">นามสกุล</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->std_surname }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">คณะ</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->faculty_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">สาขา</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->major_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">ชั้นปี</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->std_class }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">GPAX</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->std_gpax }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fa fa-envelope fa-lg"></i>
                                <p class="mb-0">{{ $students->std_email }}</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fa fa-phone-square fa-lg"></i>
                                <p class="mb-0">{{ $students->std_tel }}</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                <p class="mb-0">{{ $students->std_facebook }}</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-line fa-lg" style="color: #59ca3d;"></i>
                                <p class="mb-0">{{ $students->std_line }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">รายวิชา</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->subject_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">เนื้อหาที่จะสอน</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{!! $students->course_content !!}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">สถานที่สะดวกสอน</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->location }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">การสอน</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->course_type }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">วันที่สะดวกสอน</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->teaching_days }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">เวลาที่สะดวกสอน</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->teaching_times }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">ราคาคอร์ส</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->course_price }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">ข้อความถึงผู้เรียน</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->message_to_students }}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <div class="btn-group" role="group" aria-label="First group">
                                <a href="{{ url('course-open', ['id' => $students->subject_id]) }}" class="btn-detail btn-sm">ย้อนกลับ</a>
                            </div>
                            <div class="btn-group" role="group" aria-label="Second group">
                                <a href="{{ url('enroll-form', ['course_id' => $course->course_id]) }}" class="btn-detail btn-sm">ลงทะเบียนเรียน</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
