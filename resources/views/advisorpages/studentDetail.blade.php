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
        <h1 style="text-align: center; font-weight: bold;">รายละเอียดนิสิต</h1>
        <div class="row justify-content-center pt-2">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">รหัสนิสิต</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $student->std_id }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">ชื่อ</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $student->std_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">นามสกุล</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $student->std_surname }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">อีเมล</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $student->std_email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">คณะ</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $faculty }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">สาขา</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $major }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">ชั้นปี</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $student->std_class }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">เกรดเฉลี่ยสะสม</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $student->std_gpax }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">วันเกิด</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $student->birthdate }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">เบอร์โทรศัพท์</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $student->std_tel }}</p>
                            </div>
                        </div>
                        <hr>


                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Facebook</p>
                            </div>
                            <div class="col-sm-9">
                                @if ($student->std_facebook)
                                    <p class="text-muted mb-0">
                                        <a href="{{ $student->std_facebook }}" target="_blank"> ไปยังโปรไฟล์ Facebook</a>
                                    </p>
                                @else
                                    <p class="text-muted mb-0">ไม่ได้ระบุลิงค์ Facebook</p>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Line</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $student->std_line }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-center mt-3">
                            {{-- <div class="btn-group" role="group" aria-label="First group">
                                <a href="{{ url('approveTutor') }}"
                                    class="btn btn-danger btn-sm me-2">ย้อนกลับ</a>
                            </div> --}}
                            <div class="btn-group" role="group" aria-label="Second group">
                                <form id="approvalForm{{ $student->std_id }}"
                                    action="{{ route('approveStudent', ['std_id' => $student->std_id]) }}"
                                    method="post">
                                    @csrf
                                    <!-- Add any hidden fields if needed -->
                                    <button type="button" class="btn btn-success"
                                        onclick="showConfirmation('{{ $student->std_id }}')">อนุมัติ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- You can add more HTML and details about the student as necessary -->
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

