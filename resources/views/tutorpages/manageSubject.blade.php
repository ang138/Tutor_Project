<!-- การเรียกใช้งาน Tempate -->
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

        <div class="d-flex justify-content-end mb-3">
            <a href="addCourse" class="btn"><i class="fa fa-plus"></i> เพิ่มราวิชาที่ต้องการสอน</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>รายวิชา</th>
                        <th>จำนวนนิสิต</th>
                        <th>สถานที่</th>
                        <th>ดูรายเอียด</th>
                        <th>เปิด-ปิดรายวิชา</th>
                        <!-- Add more course-related columns here -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->subject_name }}</td>
                            <td>{{ $course->number_of_students }}</td>
                            <td>{{ $course->location }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="First group">
                                    <a href="{{ url('edit-course/' . $course->course_id) }}" class="btn btn-sm">
                                        ดูรายละเอียด
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                  </div>
                            </td>
                            <!-- Add more course-related data here -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
