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

        <div class="container">
            <div class="card">
                <div class="card-body pt-4">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ชื่อ</th>
                                    <th>นามสกุล</th>
                                    <th>อีเมล</th>
                                    <th>คณะ</th>
                                    <th>สาขา</th>
                                    <th>แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($advisors as $advisor)
                                    <tr>
                                        <td>{{ $advisor->advisor_name }}</td>
                                        <td>{{ $advisor->advisor_surname }}</td>
                                        <td>{{ $advisor->advisor_email }}</td>
                                        <td>{{ $advisor->faculty_name }}</td>
                                        <td>{{ $advisor->major_name }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <a href="{{ url('edit-advisor/' . $advisor->advisor_id) }}"
                                                    class="btn btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </div>

                                            <div class="btn-group" role="group" aria-label="Second group">
                                                <form
                                                    action="{{ route('deleteAdvisor', ['advisor_id' => $advisor->advisor_id]) }}"
                                                    method="POST" id="delete-form-{{ $advisor->advisor_id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $advisor->advisor_id }})"
                                                        style="background-color: red">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Add more rows with data here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script>
        function confirmDelete(advisorId) {
            Swal.fire({
                title: 'ยืนยันการลบ',
                text: 'คุณแน่ใจที่จะลบข้อมูลอาจารย์นี้?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ไม่ใช่'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ถ้าคุณคลิก "ใช่" ให้ส่งคำร้องขอลบอาจารย์ไปยังเซิร์ฟเวอร์
                    document.getElementById(`delete-form-${advisorId}`).submit();
                }
            });
        }
    </script>
@endsection
