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

    {{-- <div class="container pt-5">
        <!-- แสดงข้อความแจ้งเตือน -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>Data Management</h1>
        <a href="addAdvisor" class="btn-detail">เพิ่มข้อมูล</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>john@example.com</td>
                    <td>
                        <button class="btn">Edit</button>
                        <button class="btn">Delete</button>
                    </td>
                </tr>
                <!-- Add more rows with data here -->
            </tbody>
        </table>
        <div class="btn-tutor">
            <button class="btn">Add New</button>
        </div>
    </div> --}}

    <div class="container pt-5">

    <!-- แสดงข้อความแจ้งเตือน -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1 style="text-align: center; font-weight: bold;">ข้อมูลอาจารย์</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="addAdvisor" class="btn"><i class="fa fa-plus"></i> เพิ่มข้อมูลอาจารย์</a>
    </div>
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
            @foreach ($advisors as $advisor)
                <tr>
                    <td>{{ $advisor->advisor_id }}</td>
                    <td>{{ $advisor->advisor_name }}</td>
                    <td>{{ $advisor->advisor_surname }}</td>
                    <td>{{ $advisor->advisor_email }}</td>
                    <td>{{ $advisor->advisor_faculty }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="First group">
                            <a href="{{ url('edit-advisor/' . $advisor->advisor_id) }}" class="btn btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                        </div>

                        <div class="btn-group" role="group" aria-label="Second group">
                            <form action="{{ route('deleteAdvisor', ['advisor_id' => $advisor->advisor_id]) }}" method="POST"
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
