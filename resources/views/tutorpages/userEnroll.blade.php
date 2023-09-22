@extends('layouts.tutor_template')
@section('title')
    ติดต่อเรา
@endsection
@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">รายชื่อผู้ลงทะเบียนในวิชา</h1>
        <!-- ครอบตารางด้วย card -->
        <div class="card">
            <div class="card-body">
                @if (count($enrollments) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ชื่อ</th>
                                    <th>ชื่อ</th>
                                    <th>นามสกุล</th>
                                    <th>อีเมล</th>
                                    <th>ดูรายละเอียดเพิ่มเติม</th>
                                    <!-- Add more user-related columns here -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enrollments as $enrollment)
                                    <tr>
                                        <td>{{ $enrollment->cus_id }}</td>
                                        <td>{{ $enrollment->cus_name }}</td>
                                        <td>{{ $enrollment->cus_surname }}</td>
                                        <td>{{ $enrollment->cus_email }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <a href="{{ url('user-detail/' . $enrollment->cus_id) }}" class="btn btn-sm">
                                                    ดูข้อมูลเพิ่มเติม
                                                </a>
                                            </div>
                                        </td>
                                        <!-- Add more user-related data here -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ชื่อ</th>
                                    <th>ชื่อ</th>
                                    <th>นามสกุล</th>
                                    <th>อีเมล</th>
                                    <th>ดูรายละเอียดเพิ่มเติม</th>
                                    <!-- Add more user-related columns here -->
                                </tr>
                            </thead>
                        </table>
                        <h4 style="text-align: center;">ยังไม่มีผู้ลงทะเบียนเรียนในรายวิชานี้</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
