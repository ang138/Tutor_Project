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

    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">หาติวเตอร์ สอนพิเศษ</h1>
        <h1>เลือกรายวิชา</h1>
        <div class="card col-md-12 mx-auto" style="border: 1;">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-4 g-4">

                    @php
                    // Define an array of subjects with corresponding data
                    $subjects = [
                        'computer' => [
                            ['subject' => 'คอมพิวเตอร์ 1', 'location' => 'สถานที่ 1', 'day' => 'วันอังคาร', 'email' => 'john@example.com'],
                            ['subject' => 'คอมพิวเตอร์ 2', 'location' => 'สถานที่ 2', 'day' => 'วันพุธ', 'email' => 'jane@example.com'],
                        ],
                        'physics' => [
                            ['subject' => 'ฟิสิกส์ 1', 'location' => 'สถานที่ 3', 'day' => 'วันจันทร์', 'email' => 'mary@example.com'],
                        ],
                        'chemistry' => [
                            ['subject' => 'เคมี 1', 'location' => 'สถานที่ 4', 'day' => 'วันอังคาร', 'email' => 'peter@example.com'],
                            ['subject' => 'เคมี 2', 'location' => 'สถานที่ 5', 'day' => 'วันพุธ', 'email' => 'susan@example.com'],
                        ],
                        'biology' => [
                            ['subject' => 'ชีวะวิทยา 1', 'location' => 'สถานที่ 6', 'day' => 'วันจันทร์', 'email' => 'david@example.com'],
                        ],
                        'biologystic' => [
                            ['subject' => 'ชีวะวิทยา 1', 'location' => 'สถานที่ 6', 'day' => 'วันจันทร์', 'email' => 'david@example.com'],
                        ],
                        'football' => [
                            ['subject' => 'ชีวะวิทยา 1', 'location' => 'สถานที่ 6', 'day' => 'วันจันทร์', 'email' => 'david@example.com'],
                        ],
                    ];
                    @endphp

                    @foreach ($subjects as $subjectId => $subjectData)
                    <div class="col">
                        <div class="card h-60 bg-light">
                            <img src="{{ asset("assets/images/{$subjectId}.png") }}" class="card-img-top"
                                style="height: 190px;" alt="...">
                            <div class="card-body">
                                <div class="subject-title">
                                    <h5 class="card-title">วิชา{{ ucfirst($subjectId) }}</h5>
                                    <button class="btn-detail" data-subject="{{ $subjectId }}">หาติวเตอร์</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        @foreach ($subjects as $subjectId => $subjectData)
        <div class="subject-content" id="{{ $subjectId }}-content" style="display: none;">
            <div class="container pt-5">
                <h1>หาติวเตอร์ {{ ucfirst($subjectId) }}</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 25%;">วิชา</th>
                            <th style="width: 25%;">สถานที่สอน</th>
                            <th style="width: 25%;">วันเรียน</th>
                            <th style="width: 25%;">รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjectData as $data)
                        <tr>
                            <td>{{ $data['subject'] }}</td>
                            <td>{{ $data['location'] }}</td>
                            <td>{{ $data['day'] }}</td>
                            <td>
                                <small class="text-muted">
                                    <center><a href="{{ url('detail') }}" class="btn-subject">รายละเอียด</a></center>
                                </small>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
                subjectContent.scrollIntoView({ behavior: "smooth" });
            });
        });
    });
</script>
