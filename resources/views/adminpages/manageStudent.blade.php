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
        <h1 style="text-align: center; font-weight: bold;">ข้อมูลนิสิต</h1>

        <!-- แสดงข้อความแจ้งเตือน -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="addStudent" class="btn"><i class="fa fa-plus"></i> เพิ่มข้อมูลนิสิต</a>
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
                        <td>{{ $student->faculty_name }}</td>
                        <td>{{ $student->major_name }}</td>
                        <td>{{ $student->std_class }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="First group">
                                <a href="{{ url('edit-student/' . $student->std_id) }}" class="btn btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </div>

                            <div class="btn-group" role="group" aria-label="Second group">
                                <form action="{{ route('deleteStudent', ['std_id' => $student->std_id]) }}" method="POST"
                                    onsubmit="return confirm('ยืนยันการลบข้อมูลนิสิต?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <!-- Add more rows with data here -->
            </tbody>
        </table>
    </div>
@endsection
