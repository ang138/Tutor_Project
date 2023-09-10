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
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">รหัสอาจารย์:</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="รหัสอาจารย์"
                                                name="advisor_id">
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">ชื่อ:</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="ชื่อ"
                                                name="advisor_name">
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">นามสกุล:</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="นามสกุล"
                                                name="advisor_surname">
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">อีเมล:</label>
                                        <div class="col-lg-10">
                                            <input type="email" class="form-control" placeholder="อีเมล"
                                                name="advisor_email">
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">รหัสผ่าน:</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="รหัสผ่าน"
                                                name="advisor_password">
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row" style="display: none">
                                        <label for="name" class="col-lg-2 col-form-label">สถานะ:</label>
                                        <div class="col-lg-10">
                                            <input type="hidden" name="advisor_status" value="2">
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="faculty" class="col-lg-2 col-form-label">คณะ:</label>
                                        <div class="col-lg-10">
                                            <select id="faculty" class="form-select" aria-label="เลือกคณะ"
                                                name="advisor_faculty">
                                                <option value="">เลือกคณะ</option>
                                                @foreach ($faculties as $faculty)
                                                    <option value="{{ $faculty->id }}">{{ $faculty->faculty_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="major" class="col-lg-2 col-form-label">สาขา:</label>
                                        <div class="col-lg-10">
                                            <select id="major" class="form-select" aria-label="เลือกสาขา"
                                                name="advisor_major">
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ------------------------------ --}}
                <div class="d-flex justify-content-center mt-3">
                    <div class="btn-group" role="group" aria-label="First group">
                        <a href="{{ url('manageAdvisor') }}" class="btn btn-danger btn-sm me-2">ย้อนกลับ</a>
                    </div>
                    <div class="btn-group" role="group" aria-label="Second group">
                        <button type="submit" value="Add advisor" class="btn btn-primary  btn-sm">ยืนยันการเพิ่ม</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    // เรียกใช้งาน select element ของคณะและสาขา
    var facultySelect = document.getElementById('faculty');
    var majorSelect = document.getElementById('major');

    // เมื่อคณะถูกเลือก
    facultySelect.addEventListener('change', function() {
        var facultyId = this.value;

        // เรียกใช้งาน XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/get-majors/' + facultyId, true);

        // กำหนด callback เมื่อข้อมูลถูกโหลดเสร็จ
        xhr.onload = function() {
            if (xhr.status === 200) {
                // ล้างรายการสาขาที่มีอยู่ก่อนหน้า
                majorSelect.innerHTML = '<option value="">เลือกสาขา</option>';

                // ดึงข้อมูลสาขาและเพิ่มลงใน select dropdown สาขา
                var data = JSON.parse(xhr.responseText);
                for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                        majorSelect.innerHTML += '<option value="' + key + '">' + data[key] + '</option>';
                    }
                }
            } else {
                // กรณีเกิดข้อผิดพลาดในการโหลดข้อมูล
                console.error('เกิดข้อผิดพลาดในการโหลดข้อมูลสาขา');
            }
        };

        // ส่งคำขอ HTTP
        xhr.send();
    });
</script>
