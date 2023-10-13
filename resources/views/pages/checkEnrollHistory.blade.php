@extends('layouts.main_template')
@section('title')
    ค้นหาประวัติการลงทะเบียนเรียน
@endsection
@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">ประวัติการลงทะเบียนเรียน</h1>
        {{-- <div class="d-flex justify-content-end mb-3">
            <a href="enrollHistory" class="btn-back"><i class="fa fa-backward"></i> ย้อนกลับ</a>
        </div> --}}

        <!-- ครอบตารางด้วย card -->
        <div class="container">
            <div class="card">
                <div class="card-body pt-4">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ชื่อ</th>
                                    <th>นามสกุล</th>
                                    <th>คอร์สเรียน</th>
                                    <th>ติวเตอร์</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enrollments as $enrollment)
                                    <tr>
                                        <td>{{ $enrollment->cus_name }}</td>
                                        <td>{{ $enrollment->cus_surname }}</td>
                                        <td>{{ $enrollment->subject_name }}</td>
                                        <td>{{ $enrollment->std_name }}</td>
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
@endsection
