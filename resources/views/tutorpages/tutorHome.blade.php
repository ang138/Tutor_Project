<!-- resources/views/tutorpages/editCourse.blade.php -->

@extends('layouts.tutor_template')
@section('title', 'แก้ไขข้อมูลคอร์ส')

@section('content')
    <div class="container py-5">
        <h1 style="text-align: center; font-weight: bold;">ข้อมูลส่วนตัวของติวเตอร์</h1>
        <div class="row pt-3">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                            class="rounded-circle img-fluid" style="width: 150px;" id="profile-picture"> --}}

                        <!-- Display the current profile picture -->
                        <img src="{{ asset($students->std_image) }}" alt="avatar"
                            class="rounded-circle img-fluid profile-picture" style="width: 150px; height: 135px;">
                        <!-- Add an "onclick" event to trigger the edit form -->
                        <br><a href="" id="edit-button"><i class="fa fa-edit"></i>แก้ไขรูปโปรไฟล์</a>

                        <form id="profile-picture-form"
                            action="{{ route('std.image.profile', ['std_id' => $students->std_id]) }}" method="POST"
                            enctype="multipart/form-data" style="display: none;">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 pt-3">
                                <label for="formFile" class="form-label">ใบชำระเงิน</label>
                                <input class="form-control" type="file" id="formFile" name="std_image" value="{{ $students->std_image }}" accept="image/*">
                                @error('std_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="btn-group" role="group" aria-label="Second group">
                                <button type="submit" value="Add student" class="btn btn-primary btn-sm">ยืนยัน</button>
                            </div>
                        </form>

                        <h5 class="my-3">{{ $students->std_name }} {{ $students->std_surname }}</h5>
                        <p class="text-muted mb-1">ติวเตอร์</p>
                        <p class="text-muted mb-4">มหาวิทยาลัยทักษิณ วิทยาเขตพัทลุง</p>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fa fa-phone-square fa-lg"></i>
                                <p class="mb-0">{{ $students->std_tel }}</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                <p class="mb-0">{{ $students->std_facebook }}</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-line fa-lg" style="color: #59ca3d;"></i>
                                <p class="mb-0">{{ $students->std_line }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">ชื่อ</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->std_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">นามสกุล</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->std_surname }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">อีเมล</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->std_email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">คณะ</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->faculty_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">สาขา</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->major_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">ชั้นปี</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->std_class }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">เกรดเแลี่ยสะสม (GPAX)</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->std_gpax }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">วันเกิด</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $students->birthdate }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle the click event on the "Edit" button
            $("#edit-button").click(function(e) {
                e.preventDefault(); // Prevent the default link behavior
                $("#profile-picture-form").toggle(); // Toggle the form's visibility
            });
        });
    </script>

@endsection
