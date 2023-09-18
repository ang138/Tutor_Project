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

    <div class="container pt-5">
        <h1>รายการนิสิตที่อยู่ในการดูแล</h1>
        <table>
            <thead>
                <tr>
                    <th>รหัสนิสิต</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>ดูรายละเอียด</th>
                    <th>อนุมัติการเป็นติวเตอร์</th>
                    <!-- เพิ่มคอลัมน์อื่น ๆ ตามที่คุณต้องการแสดง -->
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->std_id }}</td>
                        <td>{{ $student->std_name }}</td>
                        <td>{{ $student->std_surname }}</td>
                        <td>
                            <a href="{{ url('detail-student/' . $student->std_id) }}" class="btn btn-info">ดูรายละเอียด</a>
                        </td>
                        <td>
                            <form action="{{ route('approveStudent', ['std_id' => $student->std_id]) }}" method="post">
                                @csrf
                                <!-- Add any hidden fields if needed -->
                                <button type="submit" class="btn btn-success">อนุมัติ</button>
                            </form>
                        </td>
                        <!-- แสดงข้อมูลอื่น ๆ ตามที่คุณต้องการแสดง -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
