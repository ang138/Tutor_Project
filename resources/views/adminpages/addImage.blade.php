@extends('layouts.admin_template')

@section('content')
<div class="container pt-5">
    <h1 style="text-align: center; font-weight: bold;">ข้อมูลรูปภาพ</h1>

    <!-- แสดงข้อความแจ้งเตือน -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="addStudent" class="btn"><i class="fa fa-plus"></i> เพิ่มข้อมูลรูปภาพ</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ชื่อรูป</th>
                <th>รูป</th>
                <th>แก้ไข</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($images as $image)
                <tr>
                    <td>{{ $image->image_name }}</td>
                    <td><img src="{{ asset($image->image_path) }}" alt="{{ $image->image_name }}" width="100"></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="First group">
                            <a href="" class="btn btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                        </div>

                        <div class="btn-group" role="group" aria-label="Second group">
                            <form action="" method="POST" onsubmit="return confirm('ยืนยันการลบข้อมูลรูปภาพ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
