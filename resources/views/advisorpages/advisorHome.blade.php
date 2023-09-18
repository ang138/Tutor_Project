@extends('layouts.advisor_template')

@section('content')
    <div class="container py-5">
        <h1 style="text-align: center; font-weight: bold;">ข้อมูลส่วนตัวของติวเตอร์</h1>
        <div class="row pt-3">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{url('/assets/images/profile.jpg')}}" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;" id="profile-picture">

                        <!-- Display the current profile picture -->
                        {{-- <img src="{{ asset($advisors->std_image) }}" alt="avatar"
                            class="rounded-circle img-fluid profile-picture" style="width: 150px; height: 135px;"> --}}
                        <!-- Add an "onclick" event to trigger the edit form -->

                        <h5 class="my-3">{{ $advisors->advisor_name }} {{ $advisors->advisor_surname }}</h5>
                        <p class="text-muted mb-1">ติวเตอร์</p>
                        <p class="text-muted mb-4">มหาวิทยาลัยทักษิณ วิทยาเขตพัทลุง</p>
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
                                <p class="text-muted mb-0">{{ $advisors->advisor_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">นามสกุล</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $advisors->advisor_surname }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">อีเมล</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $advisors->advisor_email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">คณะ</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $advisors->faculty_name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">สาขา</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $advisors->major_name }}</p>
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
