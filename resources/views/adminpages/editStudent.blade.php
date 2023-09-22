    <!-- การเรียกใช้งาน Tempate -->
    @extends('layouts.admin_template')
    @section('title')
        สมัครติวเตอร์
    @endsection
    @section('content')
        <div class="container pt-5">
            <h1 style="text-align: center; font-weight: bold;">แก้ไขข้อมูลนิสิต</h1>
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
                                    <form action="{{ url('update-student/' . $student->std_id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">รหัสนิสิต:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="First name"
                                                    name="std_id" value="{{ $student->std_id }}">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">ชื่อ:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="ชื่อ"
                                                    name="std_name" value="{{ $student->std_name }}">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">นามสกุล:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="นามสกุล"
                                                    name="std_surname" value="{{ $student->std_surname }}">
                                            </div>
                                        </div>
                                        <!-- แก้ไขส่วนนี้เพื่อรับข้อมูลวัน เดือน ปีเกิด -->
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">วันเกิด:</label>
                                            <div class="col-lg-10">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <select class="form-select" name="birth_day">
                                                            <option value="">วัน</option>
                                                            @for ($day = 1; $day <= 31; $day++)
                                                                <option value="{{ $day }}"
                                                                    {{ $birth_day == $day ? 'selected' : '' }}>
                                                                    {{ $day }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <select class="form-select" name="birth_month">
                                                            <option value="">เดือน</option>
                                                            @php
                                                                $thaiMonths = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
                                                            @endphp
                                                            @foreach ($thaiMonths as $key => $month)
                                                                <option value="{{ $key + 1 }}">{{ $month }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <select class="form-select" name="birth_year">
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
                                                <input type="email" class="form-control" placeholder="อีเมล"
                                                    name="std_email" value="{{ $student->std_email }}">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row" style="display: none">
                                            <label for="name" class="col-lg-2 col-form-label">รหัสผ่าน:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="รหัสผ่าน"
                                                    name="std_password" value="{{ $student->std_password }}">
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
                                                    <option value="">เลือกคณะ</option>
                                                    @foreach ($faculties as $faculty)
                                                        <!-- Display the selected faculty -->
                                                        <option value="{{ $faculty->id }}"
                                                            {{ $faculty->id == $student->std_faculty ? 'selected' : '' }}>
                                                            {{ $faculty->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Major Dropdown (Initially disabled) -->
                                        <div class="form-group pt-3 row">
                                            <label for="major" class="col-lg-2 col-form-label">สาขา:</label>
                                            <div class="col-lg-10">
                                                <select id="major-dd" class="form-select" name="std_major" disabled>
                                                    {{-- {{ $student->std_faculty ? '' : 'disabled' }}> --}}
                                                    <option value="">เลือกสาขา</option>
                                                    @foreach ($majors as $major)
                                                        <!-- Display the selected major -->
                                                        <option value="{{ $major->id }}"
                                                            {{ $major->id == $student->std_major ? 'selected' : '' }}>
                                                            {{ $major->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Advisor Dropdown (Initially disabled) -->
                                        <div class="form-group pt-3 row">
                                            <label for="advisor"
                                                class="col-lg-2 col-form-label">อาจารย์ที่ปรึกษา:</label>
                                            <div class="col-lg-10">
                                                <select id="advisor-dd" class="form-select" name="advisor1_id" disabled>
                                                    {{-- {{ $student->std_major ? '' : 'disabled' }}> --}}
                                                    <option value="">เลือกอาจารที่ปรึกษา</option>
                                                    @foreach ($advisors as $advisor)
                                                        <!-- Display the selected advisor -->
                                                        <option value="{{ $advisor->advisor_id }}"
                                                            {{ $advisor->advisor_id == $studentAdvisors->advisor1_id ? 'selected' : '' }}>
                                                            {{ $advisor->advisor_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="advisor" class="col-lg-2 col-form-label">อาจารย์ที่ปรึกษาคนที่ 2
                                                (ถ้ามี):</label>
                                            <div class="col-lg-10">
                                                <select id="advisor2-dd" class="form-select" name="advisor2_id" disabled>
                                                    {{-- {{ $student->std_major ? '' : 'disabled' }}> --}}
                                                    <option value="">เลือกอาจารที่ปรึกษาคนที่2 (ถ้ามี)</option>
                                                    @foreach ($advisors as $advisor)
                                                        <!-- Display the selected advisor 2 -->
                                                        <option value="{{ $advisor->advisor_id }}"
                                                            {{ $advisor->advisor_id == $studentAdvisors->advisor2_id ? 'selected' : '' }}>
                                                            {{ $advisor->advisor_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>



                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">ชั้นปี:</label>
                                            <div class="col-lg-10">
                                                <select class="form-select" aria-label="Default select example"
                                                    name="std_class">
                                                    <option selected>เลือกชั้นปี</option>
                                                    <option value="1"
                                                        {{ $student->std_class == 1 ? 'selected' : '' }}>
                                                        1</option>
                                                    <option value="2"
                                                        {{ $student->std_class == 2 ? 'selected' : '' }}>2</option>
                                                    <option value="3"
                                                        {{ $student->std_class == 3 ? 'selected' : '' }}>3</option>
                                                    <option value="4"
                                                        {{ $student->std_class == 4 ? 'selected' : '' }}>4</option>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ------------------------------ --}}

                    <div class="d-flex justify-content-center mt-3">
                        {{-- <div class="btn-group" role="group" aria-label="First group">
                            <a href="{{ url('manageStudent') }}" class="btn btn-danger btn-sm me-2">ย้อนกลับ</a>
                            </a>
                        </div> --}}
                        <div class="btn-group" role="group" aria-label="Second group">
                            <button type="submit" value="Update student" class="btn btn-primary btn-sm"
                                id="update-button">ยืนยันแก้ไข</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        {{-- <script>
            $('#faculty-dd').on('change', function() {
                var idFaculty = this.value;
                $("#major-dd").html('');
                $.ajax({
                    url: "{{ url('api/fetch-majors') }}",
                    type: "POST",
                    data: {
                        faculty_id: idFaculty,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#major-dd').html('<option value="">เลือกสาขา</option>');
                        $.each(result.majors, function(key, value) {
                            $("#major-dd").append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                    }
                });
            });
        </script> --}}

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

                $(document).ready(function() {
                    $('#update-button').click(function(e) {
                        e.preventDefault(); // ป้องกันฟอร์มส่งค่าไปก่อนที่เราจะแสดง Sweet Alert

                        Swal.fire({
                            title: 'คุณแน่ใจหรือไม่?',
                            text: "คุณต้องการที่จะแก้ไขข้อมูลนิสิตหรือไม่?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'ยืนยัน',
                            cancelButtonText: 'ยกเลิก'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // หากผู้ใช้คลิก "ยืนยัน" ให้ส่งค่าฟอร์ม
                                $('form').submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endsection
