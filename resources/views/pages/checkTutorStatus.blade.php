@extends('layouts.main_template')
@section('title')
    สมัครติวเตอร์
@endsection
@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">ข้อมูลการอนุมัติเป็นติวเตอร์</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="applyTutor" class="btn-back"><i class="fa fa-backward"></i> ย้อนกลับ</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>รหัสนิสิต</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>อีเมล</th>
                    <th>คณะ</th>
                    <th>สาขา</th>
                    <th>ชั้นปี</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
                @if ($student)
                    <tr>
                        <td>{{ $student->std_id }}</td>
                        <td>{{ $student->std_name }}</td>
                        <td>{{ $student->std_surname }}</td>
                        <td>{{ $student->std_email }}</td>
                        <td>{{ $student->faculty_name }}</td>
                        <td>{{ $student->major_name }}</td>
                        <td>{{ $student->std_class }}</td>
                        <td>
                            @if ($student->std_status == 4)
                                รออนุมัต
                            @elseif ($student->std_status == 5)
                                อนุมัตแล้ว
                            @endif
                        </td>
                    </tr>
                @endif
                <!-- Add more rows with data here -->
            </tbody>
        </table>
    </div>
@endsection
