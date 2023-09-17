@extends('layouts.tutor_template')
@section('title', 'รายละเอียดคอร์ส')

@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">รายละเอียดคอร์ส</h1>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row justify-content-center pt-2">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">วิชา</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $subject }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">รายละเอียด</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{!! $course->course_content !!}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">สถานที่สะดวกสอน</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $course->location }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">การสอน</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $course->course_type }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">จำนวนผู้เรียนที่เปิดรับ</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $course->number_of_students }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">วันที่สะดวกสอน</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $course->teaching_days }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">เวลาที่สะดวกสอน</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $course->teaching_times }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">ราคาคอร์ส</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $course->course_price }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">ข้อความถึงผู้เรียน</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $course->message_to_students }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">ใบชำระเงิน</p>
                            </div>
                            <div class="col-sm-9">
                                <img src="{{ asset($course->payment_receipt) }}" alt="" width="100">
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-center mt-3">
                            <div class="btn-group" role="group" aria-label="First group">
                                <a href="{{ url('manageSubject') }}" class="btn btn-danger btn-sm me-2">ย้อนกลับ</a>
                            </div>
                            <div class="btn-group" role="group" aria-label="Second group">
                                <a href="{{ url('edit-course/' . $course->course_id) }}" class="btn btn-danger btn-sm me-2">แก้ไขข้อมูล</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- You can add more HTML and details about the student as necessary -->
    </div>
@endsection

<script>
    ClassicEditor
        .create(document.querySelector('#task_textarea'))
        .catch(error => {
            console.error(error);
        });
</script>
