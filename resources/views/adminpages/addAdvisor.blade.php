<!-- resources/views/form.blade.php -->

@extends('layouts.admin_template')
@section('title')
    เพิ่มข้อมูลอาจารย์
@endsection
@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">เพิ่มข้อมูลอาจารย์</h1>

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
                                <form action="{{ url('/insert-advisor') }}" method="POST">
                                    @csrf
                                    <div class="form-group pt-3 row" style="display: none">
                                        <label for="advisor_id" class="col-lg-2 col-form-label">รหัสอาจารย์:</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="รหัสอาจารย์"
                                                name="advisor_id">
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="advisor_name" class="col-lg-2 col-form-label">ชื่อ:</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="ชื่อ"
                                                name="advisor_name">
                                            @error('advisor_name')
                                                <div class="text-danger">โปรดป้อนชื่อ</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="advisor_surname" class="col-lg-2 col-form-label">นามสกุล:</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="นามสกุล"
                                                name="advisor_surname">
                                            @error('advisor_surname')
                                                <div class="text-danger">โปรดป้อนนามสกุล</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="advisor_email" class="col-lg-2 col-form-label">อีเมล:</label>
                                        <div class="col-lg-10">
                                            <input type="email" class="form-control" placeholder="อีเมล"
                                                name="advisor_email">
                                            @error('advisor_email')
                                                <div class="text-danger">โปรดป้อนอีเมล</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="advisor_password" class="col-lg-2 col-form-label">รหัสผ่าน:</label>
                                        <div class="col-lg-10">
                                            <input type="password" class="form-control" placeholder="รหัสผ่าน"
                                                name="advisor_password">
                                            @error('advisor_password')
                                                <div class="text-danger">โปรดป้อนรหัสผ่าน</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row" style="display: none">
                                        <label for="advisor_status" class="col-lg-2 col-form-label">สถานะ:</label>
                                        <div class="col-lg-10">
                                            <input type="hidden" name="advisor_status" value="2">
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="advisor_faculty" class="col-lg-2 col-form-label">คณะ:</label>
                                        <div class="col-lg-10">
                                            <select id="faculty-dd" class="form-control" name="advisor_faculty">
                                                <option value="">เลือกคณะ</option>
                                                @foreach ($faculties as $faculty)
                                                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('advisor_faculty')
                                                <div class="text-danger">โปรดเลือกคณะ</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="advisor_major" class="col-lg-2 col-form-label">สาขา:</label>
                                        <div class="col-lg-10">
                                            <select id="major-dd" class="form-control" name="advisor_major">
                                                <option value="">เลือกสาขา</option>
                                            </select>
                                            @error('advisor_major')
                                                <div class="text-danger">โปรดเลือกสาขา</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- ------------------------------ --}}
                                    <div class="d-flex justify-content-center mt-3">
                                        {{-- <div class="btn-group" role="group" aria-label="First group">
                                            <a href="{{ url('manageAdvisor') }}"
                                                class="btn btn-danger btn-sm me-2">ย้อนกลับ</a>
                                        </div> --}}
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <button type="submit" class="btn btn-primary btn-sm"
                                                id="submit-button">ยืนยันการเพิ่ม</button>
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

        $('form').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            var form = $(this);

            // Show a SweetAlert to confirm the submission
            Swal.fire({
                title: 'ยืนยันการเพิ่มข้อมูล',
                text: 'คุณแน่ใจที่จะเพิ่มข้อมูลอาจารย์ที่ปรึกษา?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ไม่ใช่'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    form.unbind('submit').submit();
                }
            });
        });
    </script>
@endsection
