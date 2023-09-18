@extends('layouts.main_template')
@section('title')
    ติดต่อเรา
@endsection
@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">ลงทะเบียนเรียน</h1>
        <div class="card col-md-8 mx-auto" style="border: 1;">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-8 pt-1 ">
                        <div class="card" style="border: 0;">
                            <div class="card-body pt-3 pb-2">
                                <form action="{{ route('insertEnrollCourseAction', ['course_id' => $course->course_id]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf <!-- CSRF token -->

                                    @if (session('error'))
                                        <div class="alert alert-error">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <h4>กรอกข้อมูลส่วนตัว</h4>
                                    <hr>
                                    <div class="form-group pt-3">
                                        <label for="cus_name">ชื่อ</label>
                                        <input type="text" class="form-control" id="cus_name" name="cus_name"
                                            placeholder="ชื่อ" required>
                                        @error('cus_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group pt-3">
                                        <label for="cus_surname">นามสกุล</label>
                                        <input type="text" class="form-control" id="cus_surname" name="cus_surname"
                                            placeholder="นามสกุล" required>
                                        @error('cus_surname')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group pt-3">
                                        <label for="cus_email">อีเมล</label>
                                        <input type="email" class="form-control" id="cus_email" name="cus_email"
                                            placeholder="อีเมล" required>
                                        @error('cus_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group pt-3">
                                        <label for="cus_birthdate">วันเกิด</label>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <select class="form-select" id="birth_day" name="birth_day" required>
                                                    <option value="">วัน</option>
                                                    @for ($day = 1; $day <= 31; $day++)
                                                        <option value="{{ $day }}">{{ $day }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <select class="form-select" id="birth_month" name="birth_month" required>
                                                    <option value="">เดือน</option>
                                                    @for ($month = 1; $month <= 12; $month++)
                                                        <option value="{{ $month }}">{{ $month }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <select class="form-select" id="birth_year" name="birth_year" required>
                                                    <option value="">ปี</option>
                                                    @for ($year = date('Y'); $year >= 1900; $year--)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group pt-3">
                                        <label for="cus_tel">เบอร์โทรศัพท์</label>
                                        <input type="text" class="form-control" id="cus_tel" name="cus_tel"
                                            placeholder="เบอร์โทรศัพท์" required>
                                        @error('cus_tel')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <label for="basic-url" class="form-label pt-3">Facebook</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon3">https://www.facebook.com/</span>
                                        <input type="text" class="form-control" id="basic-url"
                                            aria-describedby="basic-addon3" name="cus_facebook" placeholder="Facebook"
                                            required>
                                    </div>
                                    <div class="form-group pt-3">
                                        <label for="cus_line">Line</label>
                                        <input type="text" class="form-control" id="cus_line" name="cus_line"
                                            placeholder="Line" required>
                                        @error('cus_line')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="pt-4">
                                        <h4>แนบไฟล์การชำระเงิน</h4>
                                    </div>
                                    <hr>
                                    <div class="form-group pt-3">
                                        <h5>ราคาคอร์ส : {{ $course->course_price }}</h5>
                                    </div>
                                    <div class="form-group pt-3 text-center">
                                        <label for="cus_bill">โปรดสแกนจ่ายตามราคาคอร์สที่แสดง</label>
                                        <img class="pt-2" src="{{ asset($course->payment_receipt) }}" alt=""
                                            width="180">
                                    </div>
                                    <div class="mb-3 pt-4">
                                        <label for="cus_bill" class="form-label">แนบสลิปหลักฐานการโอนเงิน</label>
                                        <input class="form-control" type="file" id="cus_bill" name="cus_bill"
                                            accept="image/*" required>
                                        @error('cus_bill')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-center mt-3">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <button type="submit" class="btn-detail btn-sm">ลงทเบียนเรียน</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
