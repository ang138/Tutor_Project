@extends('layouts.main_template')
@section('title')
    สมัครติวเตอร์
@endsection
@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">ค้นหาข้อมูลนิสิต</h1>
        <h3 style="text-align: center;">เพื่อทำการสมัครติวเตอร์/ตรวจสอบสถานะการเป็นติวเตอร์</h3>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Tutor Application Form -->
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <!-- แบบฟอร์มค้นหานิสิต -->
                            <form method="POST" action="{{ route('searchStudent') }}" onsubmit="return validateSearchForm()">
                                @csrf

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div id="error-message" style="text-align: center;"></div>

                                <div class="form-group">
                                    <label for="std_id">ค้นหานิสิตโดยรหัสนิสิต (Student ID):</label>
                                    <input type="text" class="form-control" id="std_id" name="std_id"
                                        placeholder="กรอกรหัสนิสิต" maxlength="9">
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

    <!-- JavaScript to toggle form visibility and validate the search form -->
    <script>
        // Function to validate the search form
        function validateSearchForm() {
            // Get the values from the form fields
            const std_id = document.getElementById('std_id').value;
            const birth_day = document.getElementById('birth_day').value;
            const birth_month = document.getElementById('birth_month').value;
            const birth_year = document.getElementById('birth_year').value;

            // Check if any of the fields are empty or not valid
            if (std_id === '' || birth_day === '' || birth_month === '' || birth_year === '') {
                // Display an error message on the form
                const errorMessage = document.getElementById('error-message');
                errorMessage.innerText = 'กรุณากรอกข้อมูลให้ครบถ้วนและถูกต้อง';
                errorMessage.style.color = 'red';
                return false; // Prevent form submission
            }

            // Add additional validation logic if needed
            // ...

            return true; // Allow form submission
        }

        $(document).ready(function() {
            $("input[name='experience']").change(function() {
                if ($(this).val() === "has_experience") {
                    $("#tutorApplicationForm").show();
                    $("#tutorApplicationSubForm").show();
                } else {
                    $("#tutorApplicationForm").hide();
                    $("#tutorApplicationSubForm").hide();
                }
            });

            // Add this code to show/hide the form based on the search result
            $("#tutorApplicationForm").hide(); // Initially hide the form
            $("#tutorApplicationSubForm").hide(); // Initially hide the sub-form

            $("form").on("submit", function(e) {
                e.preventDefault(); // Prevent the form from submitting normally

                // Perform your search here and check if a student is found
                var studentFound = true; // Replace with your actual search logic

                if (studentFound) {
                    $("#tutorApplicationForm").show(); // Show the form if a student is found
                    $("#tutorApplicationSubForm").show(); // Show the sub-form if a student is found
                } else {
                    // Display an error message or handle the case when no student is found
                    alert("Student not found!");
                }
            });
        });
    </script>
@endsection
