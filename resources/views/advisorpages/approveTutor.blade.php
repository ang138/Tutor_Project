<!-- การเรียกใช้งาน Tempate -->
@extends('layouts.advisor_template')
@section('title')
    ติดต่อเรา
@endsection
@section('content')
    {{-- <div class="jumbotron">
        <div class="container pt-5">
            <h2 class="display-3 head-title">ติดต่อเรา</h2>
        </div>
    </div>
    <div class="container">
        <p>ใครอยากเป็นติวเตอร์</p>
    </div> --}}

    <div class="container">
        <h1>รายการนิสิตที่อยู่ในการดูแล</h1>
        <table>
            <thead>
                <tr>
                    <th>รหัสนิสิต</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <!-- เพิ่มคอลัมน์อื่น ๆ ตามที่คุณต้องการแสดง -->
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->std_id }}</td>
                        <td>{{ $student->std_name }}</td>
                        <td>{{ $student->std_name }}</td>
                        <!-- แสดงข้อมูลอื่น ๆ ตามที่คุณต้องการแสดง -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
