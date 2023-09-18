    <!-- การเรียกใช้งาน Tempate -->
    @extends('layouts.admin_template')
    @section('title')
        สมัครติวเตอร์
    @endsection
    @section('content')
        <div class="container pt-5">
            <h1 style="text-align: center; font-weight: bold;">เพิ่มข้อมูลนิสิต</h1>
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
                                    <form action="/insert-student" method="post">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">รหัสนิสิต:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="First name"
                                                    name="std_id">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">ชื่อ:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="ชื่อ"
                                                    name="std_name">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">นามสกุล:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="นามสกุล"
                                                    name="std_surname">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="birthdate" class="col-lg-2 col-form-label">วันเกิด:</label>
                                            <div class="col-lg-10">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <select class="form-select" name="birth_day">
                                                            <option value="">วัน</option>
                                                            @for ($day = 1; $day <= 31; $day++)
                                                                <option value="{{ $day }}">{{ $day }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <select class="form-select" name="birth_month">
                                                            <option value="">เดือน</option>
                                                            @for ($month = 1; $month <= 12; $month++)
                                                                <option value="{{ $month }}">{{ $month }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <select class="form-select" name="birth_year">
                                                            <option value="">ปี</option>
                                                            @for ($year = date('Y'); $year >= 1900; $year--)
                                                                <option value="{{ $year }}">{{ $year }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">อีเมล:</label>
                                            <div class="col-lg-10">
                                                <input type="email" class="form-control" placeholder="อีเมล"
                                                    name="std_email">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">รหัสผ่าน:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="รหัสผ่าน"
                                                    name="std_password">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row" style="display: none">
                                            <label for="name" class="col-lg-2 col-form-label">สถานะ:</label>
                                            <div class="col-lg-10">
                                                <input type="hidden" name="std_status" value="3">
                                            </div>
                                        </div>
                                        <!-- Faculty Dropdown -->
                                        <div class="form-group pt-3 row">
                                            <label for="faculty" class="col-lg-2 col-form-label">คณะ:</label>
                                            <div class="col-lg-10">
                                                <select id="faculty-dd" class="form-select" name="std_faculty">
                                                    <option value="">Select Faculty</option>
                                                    @foreach ($faculties as $faculty)
                                                        <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Major Dropdown (Initially disabled) -->
                                        <div class="form-group pt-3 row">
                                            <label for="major" class="col-lg-2 col-form-label">สาขา:</label>
                                            <div class="col-lg-10">
                                                <select id="major-dd" class="form-select" name="std_major" disabled>
                                                    <option value="">Select Major</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Advisor Dropdown (Initially disabled) -->
                                        <div class="form-group pt-3 row">
                                            <label for="advisor" class="col-lg-2 col-form-label">อาจารที่ปรึกษา:</label>
                                            <div class="col-lg-10">
                                                <select id="advisor-dd" class="form-select" name="advisor1_id" disabled>
                                                    <option value="">Select Advisor</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="advisor" class="col-lg-2 col-form-label">อาจารที่ปรึกษาคนที่2
                                                (ถ้ามี):</label>
                                            <div class="col-lg-10">
                                                <select id="advisor2-dd" class="form-select" name="advisor2_id" disabled>
                                                    <option value="">Select Advisor</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">ชั้นปี:</label>
                                            <div class="col-lg-10">
                                                <select class="form-select" aria-label="Default select example"
                                                    name="std_class">
                                                    <option selected>เลือกชั้นปี</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group pt-3 row" style="display: none">
                                            <label for="name"
                                                class="col-lg-2 col-form-label">เกรดเฉลี่ยสะสม(GPAX):</label>
                                            <div class="col-lg-10">
                                                <input type="hidden" name="std_gpax" value="">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row" style="display: none">
                                            <label for="name" class="col-lg-2 col-form-label">ใบเกรด:</label>
                                            <div class="col-lg-10">
                                                <input type="hidden" name="std_grade" value="">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row" style="display: none">
                                            <label for="name" class="col-lg-2 col-form-label">เบอร์มือถือ:</label>
                                            <div class="col-lg-10">
                                                <input type="hidden" name="std_tel" value="">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row" style="display: none">
                                            <label for="name" class="col-lg-2 col-form-label">Facebook:</label>
                                            <div class="col-lg-10">
                                                <input type="hidden" name="std_facebook" value="">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row" style="display: none">
                                            <label for="name" class="col-lg-2 col-form-label">Line ID:</label>
                                            <div class="col-lg-10">
                                                <input type="hidden" name="std_line" value="">
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ------------------------------ --}}

                    <div class="d-flex justify-content-center mt-3">
                        <div class="btn-group" role="group" aria-label="First group">
                            <a href="{{ url('manageStudent') }}" class="btn btn-danger btn-sm me-2">ย้อนกลับ</a>
                        </div>
                        <div class="btn-group" role="group" aria-label="Second group">
                            <button type="submit" value="Add student"
                                class="btn btn-primary  btn-sm">ยืนยันการเพิ่ม</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Include jQuery library if not already included -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#faculty-dd').on('change', function() {
                    var facultyId = this.value;

                    // Enable the major dropdown
                    $('#major-dd').prop('disabled', false);

                    // Clear and disable the advisor dropdown
                    $('#advisor-dd').html('<option value="">Select Advisor</option>').prop('disabled', true);

                    // Clear and disable the advisor 2 dropdown
                    $('#advisor2-dd').html('<option value="">Select Advisor</option>').prop('disabled', true);

                    // Send an AJAX request to fetch majors based on the selected faculty
                    $.ajax({
                        url: "{{ route('fetch-majors') }}",
                        type: "POST",
                        data: {
                            faculty_id: facultyId,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            $('#major-dd').html('<option value="">Select Major</option>');
                            $.each(result.majors, function(key, value) {
                                $("#major-dd").append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            });
                        }
                    });
                });

                $('#major-dd').on('change', function() {
                    var facultyId = $('#faculty-dd').val();
                    var majorId = this.value;

                    // Enable the advisor dropdown
                    $('#advisor-dd').prop('disabled', false);

                    // Send an AJAX request to fetch advisors based on the selected faculty and major
                    $.ajax({
                        url: "{{ route('fetch-advisors') }}",
                        type: "POST",
                        data: {
                            faculty_id: facultyId,
                            major_id: majorId,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            $('#advisor-dd').html('<option value="">Select Advisor</option>');
                            $.each(result.advisors, function(key, value) {
                                $("#advisor-dd").append('<option value="' + value
                                    .advisor_id +
                                    '">' + value.advisor_name + '</option>');
                            });
                        }
                    });

                    // Enable the advisor 2 dropdown
                    $('#advisor2-dd').prop('disabled', false);

                    // Send an AJAX request to fetch advisors 2 based on the selected faculty and major
                    $.ajax({
                        url: "{{ route('fetch-advisors-2') }}",
                        type: "POST",
                        data: {
                            faculty_id: facultyId,
                            major_id: majorId,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            $('#advisor2-dd').html('<option value="">Select Advisor</option>');
                            $.each(result.advisors2, function(key, value) {
                                $("#advisor2-dd").append('<option value="' + value
                                    .advisor_id +
                                    '">' + value.advisor_name + '</option>');
                            });
                        }
                    });
                });

                // Add change event handler for advisor dropdown
                $('#advisor-dd').on('change', function() {
                    var advisor1 = this.value;
                    var advisor2 = $('#advisor2-dd').val();

                    if (advisor1 === advisor2) {
                        alert('คุณไม่สามารถเลือกอาจารย์คนที่ 1 และ 2 เหมือนกันได้');
                        $(this).val('').trigger('change'); // Reset the selected value
                    }
                });

                // Add change event handler for advisor 2 dropdown
                $('#advisor2-dd').on('change', function() {
                    var advisor1 = $('#advisor-dd').val();
                    var advisor2 = this.value;

                    if (advisor1 === advisor2) {
                        alert('คุณไม่สามารถเลือกอาจารย์คนที่ 1 และ 2 เหมือนกันได้');
                        $(this).val('').trigger('change'); // Reset the selected value
                    }
                });
            });
        </script>
    @endsection
