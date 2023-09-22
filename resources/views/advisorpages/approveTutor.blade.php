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

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>รายการนิสิตที่อยู่ในการดูแล</h1>
        <!-- ครอบตารางด้วย card -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center mb-3">
                    @if (count($students) > 0)
                        <table style="width: 80%">
                            <thead>
                                <tr>
                                    <th>รหัสนิสิต</th>
                                    <th>ชื่อ</th>
                                    <th>นามสกุล</th>
                                    <th>ดูรายละเอียด</th>
                                    <th style="width: 20%">อนุมัติการเป็นติวเตอร์</th>
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
                                            <a href="{{ url('detail-student/' . $student->std_id) }}"
                                                class="btn btn-info">ดูรายละเอียด</a>
                                        </td>
                                        <td>
                                            <form id="approvalForm{{ $student->std_id }}"
                                                action="{{ route('approveStudent', ['std_id' => $student->std_id]) }}"
                                                method="post">
                                                @csrf
                                                <!-- Add any hidden fields if needed -->
                                                <button type="button" class="btn btn-success"
                                                    onclick="showConfirmation('{{ $student->std_id }}')">อนุมัติ</button>
                                            </form>
                                        </td>
                                        <!-- แสดงข้อมูลอื่น ๆ ตามที่คุณต้องการแสดง -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <table style="width: 80%">
                            <thead>
                                <tr>
                                    <th>รหัสนิสิต</th>
                                    <th>ชื่อ</th>
                                    <th>นามสกุล</th>
                                    <th>ดูรายละเอียด</th>
                                    <th style="width: 20%">อนุมัติการเป็นติวเตอร์</th>
                                    <!-- เพิ่มคอลัมน์อื่น ๆ ตามที่คุณต้องการแสดง -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5">
                                        <h4 style="text-align: center;">ยังไม่มีข้อมูลนิสิตที่สมัครติวเตอร์</h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Include SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        function showConfirmation(studentId) {
            Swal.fire({
                title: "ยืนยันการอนุมัติ",
                text: "คุณต้องการที่จะอนุมัตินิสิตรหัส " + studentId + " เป็นติวเตอร์ใช่หรือไม่?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "ใช่, อนุมัติ",
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, manually submit the form
                    document.getElementById('approvalForm' + studentId).submit();
                }
            });
        }
    </script>
@endsection
