<!-- การเรียกใช้งาน Tempate -->
@extends('layouts.admin_template')
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

        <!-- แสดงข้อความแจ้งเตือน -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>ข้อมูลนิสิต</h1>
        <a href="addStudent" class="btn-detail">เพิ่มข้อมูล</a>
        <table>
            <thead>
                <tr>
                    <th>รหัสนิสิต</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>อีเมล</th>
                    <th>คณะ</th>
                    <th>แก้ไข</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->std_id }}</td>
                        <td>{{ $student->std_name }}</td>
                        <td>{{ $student->std_surname }}</td>
                        <td>{{ $student->std_email }}</td>
                        <td>{{ $student->std_faculty }}</td>
                        <td>
                            <a href="{{ url('edit-student/' . $student->std_id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('deleteStudent', ['std_id' => $student->std_id]) }}" method="POST" onsubmit="return confirm('ยืนยันการลบข้อมูลนิสิต?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <!-- Add more rows with data here -->
            </tbody>
        </table>
        <div class="btn-tutor">
            <button class="btn">Add New</button>
        </div>
    </div>
@endsection
