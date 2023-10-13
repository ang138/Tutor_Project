<!-- resources/views/tutorpages/editCourse.blade.php -->

@extends('layouts.main_template')
@section('title', 'แก้ไขข้อมูลคอร์ส')

@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">คอร์สที่เปิดสอน</h1>

        <!-- แสดงข้อความแจ้งเตือน -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- <div class="d-flex justify-content-end mb-3">
            <a href="{{ url('subject') }}" class="btn-detail" style="width: 100px;">ย้อนกลับ</a>
        </div> --}}
        <!-- ครอบตารางด้วย card -->
        <div class="container">
            <div class="card">
                <div class="card-body pt-4">
                    <div class="table-responsive">
                        @if (count($courses) === 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ชื่อคอร์ส</th>
                                        <th>สถานที่สะดวกสอน</th>
                                        <th>วันที่สะดวกสอน</th>
                                        <th>เวลาที่สะดวกสอน</th>
                                        <th>ราคา/ชั่วโมง</th>
                                        <th>จำนวนที่รับสอน</th>
                                        <th>ติวเตอร์</th>
                                        <th>ดูรายละเอียดเพิ่มเติม</th>
                                        <!-- Add more table headers for other course details as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="8">
                                            <h4 style="text-align: center;">ยังไม่มีคอร์สที่เปิดสอน</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ชื่อคอร์ส</th>
                                        <th>ติวเตอร์</th>
                                        <th>สถานที่สะดวกสอน</th>
                                        <th>วันที่สะดวกสอน</th>
                                        <th>เวลาที่สะดวกสอน</th>
                                        <th>ราคา/ชั่วโมง</th>
                                        <th>จำนวนที่รับสอน</th>
                                        <th>ดูรายละเอียดเพิ่มเติม</th>
                                        <!-- Add more table headers for other course details as needed -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <!-- Adjust the conditions to match the subject_id -->
                                        <tr>
                                            <td>{{ $course->subject_name }}</td>
                                            <td>{{ $course->std_name }}</td>
                                            <td>{{ $course->location }}</td>
                                            <td>{{ $course->teaching_days }}</td>
                                            <td>{{ $course->teaching_times }}</td>
                                            <td>{{ $course->course_price }}</td>
                                            <td>{{ $course->number_of_students }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="First group">
                                                    <a href="{{ url('course-open-detail/' . $course->course_id) }}"
                                                        class="btn-detail">
                                                        ดูรายละเอียด
                                                    </a>
                                                </div>
                                            </td>

                                            <!-- Display other course details as needed -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
