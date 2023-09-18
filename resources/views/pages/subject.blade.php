<!-- การเรียกใช้งาน Tempate -->
@extends('layouts.main_template')
@section('title')
    หาติวเตอร์
@endsection
@section('content')
    <!--ส่วนของ Feature -->
    {{-- <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">หาติวเตอร์ สอนพิเศษ</h1>
        <div class="card col-md-12 mx-auto" style="border: 1;">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div class="col">
                        <div class="card h-60 bg-light">
                            <img src="{{ asset('assets/images/computer.png') }}" class="card-img-top" style="height: 190px;"
                                alt="...">
                            <div class="card-body">
                                <h5 class="card-title">วิชาคอมพิวเตอร์</h5>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted"><a href="#" class="btn-detail" onclick="toggleTutorContent();">หาติวเตอร์</a></small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-60 bg-light">
                            <img src="{{ asset('assets/images/physics.png') }}" class="card-img-top" style="height: 190px;"
                                alt="...">
                            <div class="card-body">
                                <h5 class="card-title">วิชาฟิสิกส์</h5>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted"><a href="{{ url('subject') }}"
                                        class="btn-detail">หาติวเตอร์</a></small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-60 bg-light">
                            <img src="{{ asset('assets/images/chemistry.png') }}" class="card-img-top"
                                style="height: 190px;" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">วิชาเคมี</h5>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted"><a href="{{ url('subject') }}"
                                        class="btn-detail">หาติวเตอร์</a></small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-60 bg-light">
                            <img src="{{ asset('assets/images/biology.png') }}" class="card-img-top" style="height: 190px;"
                                alt="...">
                            <div class="card-body">
                                <h5 class="card-title">วิชาชีวะวิทยา</h5>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted"><a href="{{ url('subject') }}"
                                        class="btn-detail">หาติวเตอร์</a></small>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div> --}}
    <!-- แสดงข้อความแจ้งเตือน -->


    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">หาติวเตอร์ คอร์สเรียนพิเศษ</h1>
        <h1>เลือกรายวิชา</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card col-md-12 mx-auto" style="border: 1;">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @foreach ($subjects as $subject)
                        <div class="col">
                            <div class="card h-60 bg-light">
                                <!-- แสดงรายวิชา -->
                                <img src="{{ asset($subject->subject_image) }}" class="card-img-top" style="height: 190px;"
                                    alt="...">
                                <div class="card-body">
                                    <div class="subject-title">
                                        <h5 class="card-title">วิชา{{ $subject->subject_name }}</h5>

                                        <div class="btn-group" role="group" aria-label="First group">
                                            <a href="{{ url('course-open/' . $subject->subject_id) }}" class="btn-detail">
                                                หาติวเตอร์
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endsection

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Get all buttons with class "btn-detail"
                    const buttons = document.querySelectorAll(".btn-detail");

                    // Add click event listeners to each button
                    buttons.forEach(function(button) {
                        button.addEventListener("click", function() {
                            // Get the subject name from the "data-subject" attribute
                            const subject = button.getAttribute("data-subject");

                            // Hide all content sections
                            const contentSections = document.querySelectorAll(".subject-content");
                            contentSections.forEach(function(section) {
                                section.style.display = "none";
                            });

                            // Show the content section corresponding to the clicked button
                            const subjectContent = document.getElementById(subject + "-content");
                            subjectContent.style.display = "block";

                            // Scroll to the content section
                            subjectContent.scrollIntoView({
                                behavior: "smooth"
                            });
                        });
                    });
                });
            </script>
