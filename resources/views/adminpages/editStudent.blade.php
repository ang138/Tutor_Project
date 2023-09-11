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
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">อีเมล:</label>
                                            <div class="col-lg-10">
                                                <input type="email" class="form-control" placeholder="อีเมล"
                                                    name="std_email" value="{{ $student->std_email }}">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
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
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">คณะ:</label>
                                            <div class="col-lg-10">
                                                <select id="faculty-dd" class="form-select" aria-label="Default select example" name="std_faculty">
                                                    <option value="">เลือกคณะ</option>
                                                    @foreach ($faculties as $faculty)
                                                        <option value="{{ $faculty->id }}" {{ $student->std_faculty == $faculty->id ? 'selected' : '' }}>
                                                            {{ $faculty->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">สาขา:</label>
                                            <div class="col-lg-10">
                                                <select id="major-dd" class="form-select" aria-label="Default select example" name="std_major">
                                                    <option value="">เลือกสาขา</option>
                                                    @foreach ($majors as $major)
                                                        @if ($student->std_faculty == $major->faculty_id || old('std_faculty') == $major->faculty_id)
                                                            <option value="{{ $major->id }}" {{ $student->std_major == $major->id ? 'selected' : '' }}>
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
                                                    name="std_class">
                                                    <option selected>เลือกชั้นปี</option>
                                                    <option value="1" {{ $student->std_class == 1 ? 'selected' : '' }}>
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
                                        <div class="form-group pt-3 row" style="display: none">
                                            <label for="name" class="col-lg-2 col-form-label">ใบเกรด:</label>
                                            <div class="col-lg-10">
                                                <input type="hidden" name="std_grade" value="">
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
                            </a>
                        </div>
                        <div class="btn-group" role="group" aria-label="Second group">
                            <button type="submit" value="Update student"
                                class="btn btn-primary btn-sm">ยืนยันแก้ไข</button>
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
        </script>
    @endsection
