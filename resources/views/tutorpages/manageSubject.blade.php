@extends('layouts.tutor_template')
@section('title')
    จัดการรายวิชา
@endsection
@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">ข้อมูลรายวิชาที่เปิดสอน</h1>

        <!-- แสดงข้อความแจ้งเตือน -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('confirmation'))
            <div class="alert alert-success">
                {{ session('confirmation') }}
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="addCourse" class="btn"><i class="fa fa-plus"></i> เพิ่มราวิชาที่ต้องการสอน</a>
        </div>

        <!-- ครอบตารางด้วย card -->
        <div class="container">
            <div class="card">
                <div class="card-body pt-4">
                    @if (count($courses) === 0)
                        <table>
                            <thead>
                                <tr>
                                    <th>รายวิชา</th>
                                    <th>รายวิชา</th>
                                    <th>สถานที่</th>
                                    <th>รูปแบบการสอน</th>
                                    <th>วันที่สะดวกสอน</th>
                                    <th>เวลาที่สะดวกสอน</th>
                                    <th>ดูรายเอียด</th>
                                    <th>เปิด-ปิดรายวิชา</th>
                                    <!-- Add more course-related columns here -->
                                </tr>
                            </thead>
                        </table>
                        <h4 style="text-align: center; padding-top: 15px;">ยังไม่มีคอร์สที่เปิดสอน</h4>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>รายวิชา</th>
                                        <th>รายวิชา</th>
                                        <th style="width: 20%;">สถานที่</th>
                                        <th>รูปแบบการสอน</th>
                                        <th>วันที่สะดวกสอน</th>
                                        <th>เวลาที่สะดวกสอน</th>
                                        <th>ดูรายละเอียด</th>
                                        <th>เปิด-ปิดรายวิชา</th>
                                        <th>สถานะรายวิชา</th>
                                        <!-- Add more course-related columns here -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        @if ($course->course_status != 3)
                                            <tr>
                                                <td>{{ $course->course_id }}</td>
                                                <td>{{ $course->subject_name }}</td>
                                                <td>{{ $course->location }}</td>
                                                <td>{{ $course->course_type }}</td>
                                                <td>{{ $course->teaching_days }}</td>
                                                <td>{{ $course->teaching_times }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="First group">
                                                        <a href="{{ url('course-details/' . $course->course_id) }}"
                                                            class="btn btn-sm">
                                                            ดูรายละเอียด
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>

                                                    @if ($course->course_status == 3)
                                                        ลงทะเบียนเต็มแล้ว
                                                    @else
                                                        <form
                                                            action="{{ route('updateCourseStatus', ['course_id' => $course->course_id]) }}"
                                                            method="POST" class="course-status-form">
                                                            @csrf
                                                            <div class="d-flex align-items-center">
                                                                {{-- <label for="toggle-button-label">
                                                        @if ($course->course_status == 1)
                                                        <i class="fa fa-check fa-lg" style="color: #7dbd3d;"></i> เปิดลงทะเบียนแล้ว
                                                        @else
                                                            ปิดลงทะเบียนแล้ว
                                                        @endif
                                                    </label> --}}
                                                                <button
                                                                    class="@if ($course->course_status == 1) red-button @endif btn btn-sm toggle-button"
                                                                    type="button"
                                                                    data-course-id="{{ $course->course_id }}"
                                                                    data-status="{{ $course->course_status }}"
                                                                    @if ($course->course_status == 3) disabled @endif>
                                                                    {{ $course->course_status == 2 ? 'เปิดลงทะเบียน' : 'ปิดลงทะเบียน' }}
                                                                </button>
                                                            </div>
                                                        </form>
                                                    @endif
                                                </td>
                                                <td>
                                                    <label for="toggle-button-label">
                                                        @if ($course->course_status == 1)
                                                            <p><i class="fa fa-check fa-lg" style="color: #7dbd3d;"></i>
                                                                เปิดลงทะเบียนแล้ว</p>
                                                        @else
                                                            <p><i class="fa fa-times fa-lg" style="color: #d66d3c;"></i>
                                                                ปิดลงทะเบียนแล้ว</p>
                                                        @endif
                                                    </label>
                                                </td>
                                                <!-- Add more course-related data here -->
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- ครอบตารางด้วย card -->
        <div class="container pt-3">
            <h2 style="text-align: center; font-weight: bold;">คอร์สที่ลงทะเบียนเต็ม</h2>
            <div class="card">
                <div class="card-body pt-4">
                    @if (count($coursesWithStatus3) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>รหัสวิชา</th>
                                        <th>รายวิชา</th>
                                        <th style="width: 20%;">สถานที่</th>
                                        <th>รูปแบบการสอน</th>
                                        <th>วันที่สะดวกสอน</th>
                                        <th>เวลาที่สะดวกสอน</th>
                                        <th>สถานะรายวิชา</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coursesWithStatus3 as $course)
                                        <tr>
                                            <td>{{ $course->course_id }}</td>
                                            <td>{{ $course->subject_name }}</td>
                                            <td>{{ $course->location }}</td>
                                            <td>{{ $course->course_type }}</td>
                                            <td>{{ $course->teaching_days }}</td>
                                            <td>{{ $course->teaching_times }}</td>
                                            <td>ลงทะเบียนเต็มแล้ว</td>
                                            <!-- Add more course-related data here -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="table-responsive pt-5">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>รหัสวิชา</th>
                                        <th>รายวิชา</th>
                                        <th>สถานที่</th>
                                        <th>รูปแบบการสอน</th>
                                        <!-- Add more columns as needed -->
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <p style="text-align: center; padding-top: 15px;">ไม่มีคอร์สที่ลงทะเบียนเต็ม</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.querySelectorAll('.toggle-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var courseId = this.getAttribute('data-course-id');
                var currentStatus = parseInt(this.getAttribute('data-status'));

                // Find the parent form of the clicked button
                var form = this.closest('.course-status-form');

                // Show a SweetAlert when the button is clicked
                Swal.fire({
                    title: 'คุณแน่ใจหรือไม่?',
                    text: currentStatus === 1 ? 'ปิดลงทะเบียนหรือไม่?' : 'เปิดลงทะเบียนหรือไม่?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'ใช่',
                    cancelButtonText: 'ไม่ใช่'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the AJAX request for the specific form
                        $.ajax({
                            url: form.getAttribute('action'), // Use the form's action URL
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                courseId: courseId,
                                currentStatus: currentStatus
                            },
                            success: function(response) {
                                // Update the button text and data-status attribute based on the response
                                if (currentStatus === 1) {
                                    button.textContent = 'ปิดลงทะเบียน';
                                    button.setAttribute('data-status', 2);
                                } else {
                                    button.textContent = 'เปิดลงทะเบียน';
                                    button.setAttribute('data-status', 1);
                                }
                                // Show a success message
                                Swal.fire('สำเร็จ!', 'รายวิชาถูกอัปเดตสถานะแล้ว',
                                    'success');
                            },
                            error: function() {
                                // Handle errors here
                                Swal.fire('เกิดข้อผิดพลาด!',
                                    'ไม่สามารถอัปเดตสถานะรายวิชาได้', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>



@endsection
