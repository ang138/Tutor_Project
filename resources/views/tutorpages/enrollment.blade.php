@extends('layouts.tutor_template')
@section('title')
    ติดต่อเรา
@endsection
@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">รายวิชาที่เปิดสอน</h1>
        <!-- ครอบตารางด้วย card -->
        <div class="card">
            <div class="card-body">
                @if (count($courses) === 0)
                    <table>
                        <thead>
                            <tr>
                                <th>รหัสวิชา</th>
                                <th>รายวิชา</th>
                                <th>สถานที่</th>
                                <th>รูปแบบการสอน</th>
                                <th>วันที่สะดวกสอน</th>
                                <th>เวลาที่สะดวกสอน</th>
                                <th>จำนวนผู้ใช้ที่ลงทะเบียน</th>
                                <th>ดูรายเอียด</th>
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
                                    <th>รหัสวิชา</th>
                                    <th>รายวิชา</th>
                                    <th>สถานที่</th>
                                    <th>รูปแบบการสอน</th>
                                    <th>วันที่สะดวกสอน</th>
                                    <th>เวลาที่สะดวกสอน</th>
                                    <th>จำนวนผู้ใช้ที่ลงทะเบียน</th>
                                    <th>ดูรายเอียด</th>
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
                                            <label for="toggle-button-label">
                                                @if ($course->course_status == 3)
                                                    <p>ลงทะเบียนเต็มแล้ว</p>
                                                @else
                                                    <p>ขาดอีก {{ $course->number_of_students }} คน</p>
                                                @endif
                                            </label>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <a href="{{ url('user-enroll/' . $course->course_id) }}" class="btn btn-sm">
                                                    ดูรายชื่อผู้ลงทะเบียน
                                                </a>
                                            </div>
                                        </td>
                                        <!-- Add more course-related data here -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
