@extends('layouts.main_template')
@section('title')
    ค้นหาประวัติการลงทะเบียนเรียน
@endsection
@section('content')
<div class="container pt-5">
    <h1 style="text-align: center; font-weight: bold;">ค้นหาข้อมูลผู้ใช้ที่ลงทะเบียนเรียน</h1>
    <h3 style="text-align: center;">เพื่อดูประวัติการลงทะเบียนเรียนกับติวเตอร์ มหาวิทยาลัยทักษิณ วิทยาเขตพัทลุง</h3>
    <!-- Tutor Application Form -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <!-- แบบฟอร์มค้นหานิสิต -->
                        <form method="POST" action="{{ route('searchEnroll') }}" onsubmit="return validateSearchForm()">
                            @csrf
                            <div class="form-group pt-3">
                                <label for="std_id">อีเมลที่ใช้ลงทะเบียนเรียน:</label>
                                <input type="text" class="form-control" id="cus_email" name="cus_email"
                                    placeholder="กรอกอีเมลที่ใช้ลงทะเบียนเรียน">
                            </div>
                            <div class="form-group pt-3 row">
                                <label for="birthdate" class="col-lg-2 col-form-label">วันเกิด:</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <select class="form-select" name="birth_day" id="birth_day">
                                            <option value="">วัน</option>
                                            @for ($day = 1; $day <= 31; $day++)
                                                <option value="{{ $day }}">{{ $day }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <select class="form-select" name="birth_month" id="birth_month">
                                            <option value="">เดือน</option>
                                            @for ($month = 1; $month <= 12; $month++)
                                                <option value="{{ $month }}">{{ $month }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <select class="form-select" name="birth_year" id="birth_year">
                                            <option value="">ปี</option>
                                            @for ($year = date('Y'); $year >= 1900; $year--)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <div class="btn-group" role="group">
                                    <button type="submit" class="btn-search">ค้นหา</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
