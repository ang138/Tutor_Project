@extends('layouts.tutor_template')
@section('title')
    ติดต่อเรา
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
        <div class="table-responsive">
            <table class="table">
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
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->course_id }}</td>
                            <td>{{ $course->subject_name }}</td>
                            <td>{{ $course->location }}</td>
                            <td>{{ $course->course_type }}</td>
                            <td>{{ $course->teaching_days }}</td>
                            <td>{{ $course->teaching_times }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="First group">
                                    <a href="{{ url('course-details/' . $course->course_id) }}" class="btn btn-sm">
                                        ดูรายละเอียด
                                    </a>
                                </div>
                            </td>
                            <td>
                                @if ($course->course_status == 3)
                                    ลงทะเบียนเต็มแล้ว
                                @else
                                    <form action="{{ route('updateCourseStatus', ['course_id' => $course->course_id]) }}"
                                        method="POST" id="course-status-form">
                                        @csrf
                                        <div class="d-flex align-items-center">
                                            <label for="toggle-button-label">
                                                @if ($course->course_status == 1)
                                                    เปิดลงทะเบียนแล้ว
                                                @else
                                                    ปิดลงทะเบียนแล้ว
                                                @endif
                                            </label>
                                            <button
                                                class="@if ($course->course_status == 1) red-button @endif btn btn-sm toggle-button"
                                                type="submit" id="toggle-button" data-course-id="{{ $course->course_id }}"
                                                data-status="{{ $course->course_status }}"
                                                @if ($course->course_status == 3) disabled @endif>
                                                {{ $course->course_status == 2 ? 'เปิดลงทะเบียน' : 'ปิดลงทะเบียน' }}
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </td>
                            <!-- Add more course-related data here -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- เพิ่ม jQuery หากยังไม่ได้เพิ่ม -->
    <script>
        document.querySelectorAll('.toggle-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var courseId = this.getAttribute('data-course-id');
                var currentStatus = parseInt(this.getAttribute('data-status'));

                // คำขอ AJAX ไปยังเซิร์ฟเวอร์เพื่ออัปเดต course_status
                // ในตาราง courses โดยใช้ courseId และ currentStatus
                // (ในตัวอย่างนี้จะใช้ jQuery สำหรับ AJAX)

                $.ajax({
                    url: '/update-course-status', // เปลี่ยนเป็น URL ที่ใช้ในแอปของคุณ
                    method: 'POST',
                    data: {
                        courseId: courseId,
                        currentStatus: currentStatus
                    },
                    success: function(response) {
                        // อัปเดตข้อความบนปุ่มตามสถานะที่ได้รับจากเซิร์ฟเวอร์
                        if (currentStatus === 1) {
                            button.textContent = 'ปิดลงทะเบียน';
                            button.setAttribute('data-status', 2);
                        } else {
                            button.textContent = 'เปิดลงทะเบียน';
                            button.setAttribute('data-status', 1);
                        }
                    },
                    error: function() {
                        // จัดการกรณีเกิดข้อผิดพลาด
                    }
                });
            });
        });
    </script>
@endsection
