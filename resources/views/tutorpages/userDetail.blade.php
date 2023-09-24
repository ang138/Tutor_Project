@extends('layouts.tutor_template')
@section('title')
    ติดต่อเรา
@endsection
@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">ข้อมูลผู้ลงทะเบียนเรียน</h1>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row justify-content-center pt-2">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>ข้อมูลส่วนตัว</h3>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">ชื่อ</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->cus_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">นามสกุล</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->cus_surname }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">อีเมล</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->cus_email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">วันเกิด</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->cus_birthdate }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">เบอร์โทรศัพท์</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->cus_tel }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Facebook</p>
                            </div>
                            <div class="col-sm-9">
                                @if ($user->cus_facebook)
                                    <p class="text-muted mb-0">
                                        <a href="{{ $user->cus_facebook }}" target="_blank"> ไปยังโปรไฟล์ Facebook</a>
                                    </p>
                                @else
                                    <p class="text-muted mb-0">ไม่ได้ระบุลิงค์ Facebook</p>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Line</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->cus_line }}</p>
                            </div>
                        </div>
                        <hr>
                        <h3 class="pt-3">หลักฐานการชำระเงิน</h3>
                        <hr>
                        <div class="row">
                            <div class="col-sm-9">
                                <img src="{{ asset($user->cus_bill) }}"
                            style="width: 200px; height: 185px;">
                            </div>
                        </div>
                        <hr>
                        {{-- <div class="d-flex justify-content-center mt-3">
                            <div class="btn-group" role="group" aria-label="First group">
                                <a href="{{ url('user-enroll', ['id' => $user->course_id]) }}" class="btn btn-danger btn-sm me-2">ย้อนกลับ</a>
                            </div>
                        </div> --}}
                    </div>

                </div>
            </div>
            <!-- You can add more HTML and details about the student as necessary -->
        </div>
    @endsection
