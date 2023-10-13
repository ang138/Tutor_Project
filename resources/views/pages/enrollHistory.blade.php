@extends('layouts.main_template')
@section('title')
    ค้นหาประวัติการลงทะเบียนเรียน
@endsection
@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">ค้นหาข้อมูลผู้ใช้ที่ลงทะเบียนเรียน</h1>
        <h3 style="text-align: center;">ดูประวัติการลงทะเบียนเรียนกับติวเตอร์ มหาวิทยาลัยทักษิณ วิทยาเขตพัทลุง</h3>
        <!-- Tutor Application Form -->
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <!-- แบบฟอร์มค้นหานิสิต -->
                            <form method="POST" action="{{ route('searchEnroll') }}" onsubmit="return validateSearchForm()">
                                @csrf

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div id="error-message" style="text-align: center;"></div>

                                <div class="form-group pt-3">
                                    <label for="std_id">อีเมลที่ใช้ลงทะเบียนเรียน:</label>
                                    <input type="text" class="form-control" id="cus_email" name="cus_email"
                                        placeholder="กรอกอีเมลที่ใช้ลงทะเบียนเรียน">
                                </div>
                                {{-- <div class="form-group pt-3 row">
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
                                                @php
                                                    $thaiMonths = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
                                                @endphp
                                                @foreach ($thaiMonths as $key => $month)
                                                    <option value="{{ $key + 1 }}">{{ $month }}</option>
                                                @endforeach
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
                                </div> --}}
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

    <script>
        // Function to validate the search form
        function validateSearchForm() {
            // Get the values from the form fields
            const cus_email = document.getElementById('cus_email').value;
            // const birth_day = document.getElementById('birth_day').value;
            // const birth_month = document.getElementById('birth_month').value;
            // const birth_year = document.getElementById('birth_year').value;

            // Check if any of the fields are empty or not valid
            // if (cus_email === '' || birth_day === '' || birth_month === '' || birth_year === '') {
            if (cus_email === '') {
                // Display an error message on the form
                const errorMessage = document.getElementById('error-message');
                errorMessage.innerHTML = '<div class="alert alert-danger">กรุณากรอกข้อมูลให้ครบถ้วนและถูกต้อง</div>';
                return false; // Prevent form submission
            }

            // Add additional validation logic if needed
            // ...

            return true; // Allow form submission
        }
    </script>
@endsection
