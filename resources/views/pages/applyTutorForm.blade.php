@extends('layouts.main_template')

@section('title')
    สมัครติวเตอร์
@endsection

@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">สมัครติวเตอร์</h1>
        <!-- แสดงข้อความแจ้งเตือน -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card col-md-8 mx-auto" style="border: 1;">
            <div class="card-body">

                <div class="row justify-content-center">
                    <div class="col-md-9 pt-1 ">
                        <div class="card" style="border: 0;">
                            <div class="card-body pt-3 pb-2">
                                <h4>ตรวจสอบข้อมูลส่วนตัว</h4>
                                <hr>
                                {{-- <form action="{{ route('updateStudent', $student->std_id) }}" method="POST"> --}}
                                <form id="updateStudentForm" action="{{ url('updateStudent/' . $student->std_id) }}"
                                    method="POST" onsubmit="return validateForm()">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">รหัสนิสิต:</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="First name"
                                                name="std_id" value="{{ $student->std_id }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">ชื่อ:</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="ชื่อ" name="std_name"
                                                value="{{ $student->std_name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">นามสกุล:</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="นามสกุล"
                                                name="std_surname" value="{{ $student->std_surname }}" readonly>
                                        </div>
                                    </div>
                                    <!-- แก้ไขส่วนนี้เพื่อรับข้อมูลวัน เดือน ปีเกิด -->
                                    <div class="form-group pt-3 row" style="display: none">
                                        <label for="name" class="col-lg-2 col-form-label">วันเกิด:</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <select class="form-select" name="birth_day" disabled>
                                                        <option value="">วัน</option>
                                                        @for ($day = 1; $day <= 31; $day++)
                                                            <option value="{{ $day }}"
                                                                {{ $birth_day == $day ? 'selected' : '' }}>
                                                                {{ $day }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <select class="form-select" name="birth_month" disabled>
                                                        <option value="">เดือน</option>
                                                        @for ($month = 1; $month <= 12; $month++)
                                                            <option value="{{ $month }}"
                                                                {{ $birth_month == $month ? 'selected' : '' }}>
                                                                {{ $month }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <select class="form-select" name="birth_year" disabled>
                                                        <option value="">ปี</option>
                                                        @for ($year = date('Y'); $year >= 1900; $year--)
                                                            <option value="{{ $year }}"
                                                                {{ $birth_year == $year ? 'selected' : '' }}>
                                                                {{ $year }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">อีเมล:</label>
                                        <div class="col-lg-10">
                                            <input type="email" class="form-control" placeholder="อีเมล" name="std_email"
                                                value="{{ $student->std_email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row" style="display: none">
                                        <label for="name" class="col-lg-2 col-form-label">รหัสผ่าน:</label>
                                        <div class="col-lg-10">
                                            <input type="hidden" class="form-control" placeholder="รหัสผ่าน"
                                                name="std_password" value="{{ $student->std_password }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row" style="display: none">
                                        <label for="name" class="col-lg-2 col-form-label">สถานะ:</label>
                                        <div class="col-lg-10">
                                            <input type="hidden" name="std_status" value="3" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">คณะ:</label>
                                        <div class="col-lg-10">
                                            <select id="faculty-dd" class="form-select" aria-label="Default select example"
                                                name="std_faculty" disabled>
                                                <option value="">เลือกคณะ</option>
                                                @foreach ($faculties as $faculty)
                                                    <option value="{{ $faculty->id }}"
                                                        {{ $student->std_faculty == $faculty->id ? 'selected' : '' }}>
                                                        {{ $faculty->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">สาขา:</label>
                                        <div class="col-lg-10">
                                            <select id="major-dd" class="form-select"
                                                aria-label="Default select example" name="std_major" disabled>
                                                <option value="">เลือกสาขา</option>
                                                @foreach ($majors as $major)
                                                    @if ($student->std_faculty == $major->faculty_id || old('std_faculty') == $major->faculty_id)
                                                        <option value="{{ $major->id }}"
                                                            {{ $student->std_major == $major->id ? 'selected' : '' }}>
                                                            {{ $major->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">ชั้นปี:</label>
                                        <div class="col-lg-10">
                                            <select class="form-select" aria-label="Default select example"
                                                name="std_class" disabled>
                                                <option selected>เลือกชั้นปี</option>
                                                <option value="1" {{ $student->std_class == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="2" {{ $student->std_class == 2 ? 'selected' : '' }}>2
                                                </option>
                                                <option value="3" {{ $student->std_class == 3 ? 'selected' : '' }}>3
                                                </option>
                                                <option value="4" {{ $student->std_class == 4 ? 'selected' : '' }}>4
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <h4 class="pt-5">กรอกข้อมูลผลการศึกษา</h4>
                                    <hr>
                                    <div class="form-group pt-1 row">
                                        <label for="name" class="col-lg-2 col-form-label">GPAX:</label>
                                        <div class="col-lg-10">
                                            <input type="number" id="std_gpax" min="0" max="4"
                                                class="form-control" placeholder="เกรดเฉลี่ยสะสม" name="std_gpax"
                                                required>
                                        </div>
                                    </div>
                                    <h4 class="pt-5">กรอกข้อมูลช่องทางติดต่อ</h4>
                                    <hr>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">เบอร์มือถือ:</label>
                                        <div class="col-lg-10">
                                            <input type="number" id="std_tel" class="form-control"
                                                placeholder="เบอร์มือถือ" name="std_tel" min="0" max="9999999999"
                                                required>
                                        </div>
                                    </div>

                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">ลิ้งค์เฟสบุ๊ค:</label>
                                        <div class="col-lg-10">
                                            <input type="url" class="form-control" placeholder="ลิ้งค์เฟสบุ๊ค"
                                                name="std_facebook" id="std_facebook" required>
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">Line ID:</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="Line ID"
                                                name="std_line" required>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{-- <div class="btn-group" role="group" aria-label="First group">
                        <a href="{{ url('applyTutor') }}" class="btn-submittutor">ย้อนกลับ</a>
                        </a>
                    </div> --}}
                    <div class="btn-group" role="group" aria-label="Second group">
                        <button type="submit" value="Update student" class="btn-submittutor">สมัครติวเตอร์</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function validateForm() {
            const stdTelInput = document.getElementById("std_tel");
            const stdGpaxInput = document.getElementById("std_gpax");
            const stdFacebookInput = document.getElementById("std_facebook");

            const telValue = stdTelInput.value;
            const gpaxValue = parseFloat(stdGpaxInput.value);
            const facebookURL = stdFacebookInput.value;
            const facebookPattern = /^(https?:\/\/)?(www\.)?facebook\.com\/[a-zA-Z0-9._-]+$/;

            let isValid = true;

            if (!/^\d{10}$/.test(telValue)) {
                stdTelInput.setCustomValidity("โปรดป้อนเบอร์มือถือที่ถูกต้อง (10 หลัก)");
                isValid = false;
            } else {
                stdTelInput.setCustomValidity("");
            }

            if (isNaN(gpaxValue) || gpaxValue < 0 || gpaxValue > 4) {
                stdGpaxInput.setCustomValidity("โปรดป้อน GPAX ที่อยู่ในช่วง 0 ถึง 4");
                isValid = false;
            } else {
                stdGpaxInput.setCustomValidity("");
            }

            if (!facebookPattern.test(facebookURL)) {
                stdFacebookInput.setCustomValidity("โปรดป้อนลิงค์ Facebook ที่ถูกต้อง");
                isValid = false;
            } else {
                stdFacebookInput.setCustomValidity("");
            }

            if (isValid) {
                // ถ้าข้อมูลถูกต้องให้แสดง Sweet Alert และยืนยันการสมัคร
                Swal.fire({
                    title: 'ยืนยันการสมัครติวเตอร์',
                    text: 'คุณต้องการที่จะสมัครติวเตอร์ใช่หรือไม่?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'ใช่',
                    cancelButtonText: 'ไม่ใช่'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // ถ้าผู้ใช้กด "ใช่" ให้ส่งคำร้องขอไปยังฟังก์ชัน updateStudent()
                        document.getElementById('updateStudentForm').submit();
                    }
                });
            }

            // ไม่ต้องส่งคำร้องขอในขั้นตอนนี้
            return false;
        }
    </script>
@endsection
