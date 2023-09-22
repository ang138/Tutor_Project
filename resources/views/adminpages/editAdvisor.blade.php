    <!-- การเรียกใช้งาน Tempate -->
    @extends('layouts.admin_template')
    @section('title')
        สมัครติวเตอร์
    @endsection
    @section('content')
        <div class="container pt-5">
            <h1 style="text-align: center; font-weight: bold;">แก้ไขข้อมูลอาจารย์</h1>
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
                                    <form action="{{ url('update-advisor/' . $advisor->advisor_id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        {{-- <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">รหัสอาจารย์:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="First name"
                                                    name="advisor_id" value="{{ $advisor->advisor_id }}">
                                            </div>
                                        </div> --}}
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">ชื่อ:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="ชื่อ"
                                                    name="advisor_name" value="{{ $advisor->advisor_name }}">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">นามสกุล:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="นามสกุล"
                                                    name="advisor_surname" value="{{ $advisor->advisor_surname }}">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">อีเมล:</label>
                                            <div class="col-lg-10">
                                                <input type="email" class="form-control" placeholder="อีเมล"
                                                    name="advisor_email" value="{{ $advisor->advisor_email }}">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">รหัสผ่าน:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="รหัสผ่าน"
                                                    name="advisor_password" value="{{ $advisor->advisor_password }}">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row" style="display: none">
                                            <label for="name" class="col-lg-2 col-form-label">สถานะ:</label>
                                            <div class="col-lg-10">
                                                <input type="hidden" name="advisor_status" value="2">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">คณะ:</label>
                                            <div class="col-lg-10">
                                                <select id="faculty-dd" class="form-select"
                                                    aria-label="Default select example" name="advisor_faculty">
                                                    <option value="">เลือกคณะ</option>
                                                    @foreach ($faculties as $faculty)
                                                        <option value="{{ $faculty->id }}"
                                                            {{ $advisor->advisor_faculty == $faculty->id ? 'selected' : '' }}>
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
                                                    aria-label="Default select example" name="advisor_major">
                                                    <option value="">เลือกสาขา</option>
                                                    @foreach ($majors as $major)
                                                        @if ($advisor->advisor_faculty == $major->faculty_id)
                                                            <option value="{{ $major->id }}"
                                                                {{ $advisor->advisor_major == $major->id ? 'selected' : '' }}>
                                                                {{ $major->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ------------------------------ --}}

                    <div class="d-flex justify-content-center mt-3">
                        <div class="btn-group" role="group" aria-label="First group">
                            <a href="{{ url('manageAdvisor') }}" class="btn btn-danger btn-sm me-2">ย้อนกลับ</a>
                            </a>
                        </div>
                        <div class="btn-group" role="group" aria-label="Second group">
                            <button type="submit" value="Update advisor"
                                class="btn btn-primary btn-sm" id="update-button">ยืนยันแก้ไข</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
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

            $(document).ready(function() {
                $('#update-button').click(function(e) {
                    e.preventDefault(); // ป้องกันฟอร์มส่งค่าไปก่อนที่เราจะแสดง Sweet Alert

                    Swal.fire({
                        title: 'คุณแน่ใจหรือไม่?',
                        text: "คุณต้องการที่จะแก้ไขข้อมูลอาจารย์ที่ปรึกษาหรือไม่?",
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
        </script>
    @endsection
