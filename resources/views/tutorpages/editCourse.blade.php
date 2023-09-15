<!-- resources/views/tutorpages/editCourse.blade.php -->

@extends('layouts.tutor_template')
@section('title', 'แก้ไขข้อมูลคอร์ส')

@section('content')
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">รายวิชาที่ต้องการเปิดสอน</h1>
        <div class="card col-md-8 mx-auto" style="border: 1;">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-8 pt-1 ">
                        <div class="card" style="border: 0;">
                            <div class="card-body pt-3 pb-2">

                                <!-- Display any validation errors here -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ url('update-course/' . $course->course_id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Select Subject -->
                                    <div class="form-group">
                                        <label for="subject_id">รายวิชา</label>
                                        <select class="form-control" id="subject_id" name="subject_id">
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->subject_id }}"
                                                    @if ($subject->subject_id == $course->course_name) selected @endif>
                                                    {{ $subject->subject_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <hr>

                                    <!-- Course Content -->
                                    <div class="form-group">
                                        <label for="course_content">รายละเอียด</label>
                                        <textarea class="form-control" id="task_textarea" name="course_content" rows="4">{{ $course->course_content }}</textarea>
                                    </div>
                                    <hr>

                                    <!-- Location -->
                                    <div class="form-group">
                                        <label>สถานที่สะดวกสอน</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="location[]"
                                                value="บริเวณ ม.ทักษิณ วิทยาเขตพัทลุง" id="location1"
                                                @if (in_array('บริเวณ ม.ทักษิณ วิทยาเขตพัทลุง', $locations)) checked @endif>
                                            <label class="form-check-label" for="location1">บริเวณ ม.ทักษิณ
                                                วิทยาเขตพัทลุง</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="location[]"
                                                value="ออนไลน์" id="location2"
                                                @if (in_array('ออนไลน์', $locations)) checked @endif>
                                            <label class="form-check-label" for="location2">ออนไลน์</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- Course Type -->
                                    <div class="form-group">
                                        <label>การสอน</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="course_type"
                                                id="flexRadioDefault1" value="สอนรวม"
                                                @if ($course->course_type == 'สอนรวม') checked @endif>
                                            <label class="form-check-label" for="flexRadioDefault1">สอนรวม</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="course_type"
                                                id="flexRadioDefault2" value="สอนตัวต่อตัว"
                                                @if ($course->course_type == 'สอนตัวต่อตัว') checked @endif>
                                            <label class="form-check-label" for="flexRadioDefault2">สอนตัวต่อตัว</label>
                                        </div>
                                    </div>
                                    <hr>

                                    <!-- Number of Students -->
                                    <div class="form-group">
                                        <label for="number_of_students">จำนวนผู้เรียนที่เปิดรับ</label>
                                        <input type="number" class="form-control" id="number_of_students"
                                            name="number_of_students" value="{{ $course->number_of_students }}">
                                    </div>

                                    <!-- Teaching Days -->
                                    <div class="form-group">
                                        <label for="teaching_days">วันที่สะดวกสอน</label>
                                        <input type="text" class="form-control" id="teaching_days" name="teaching_days"
                                            value="{{ $course->teaching_days }}">
                                    </div>

                                    <!-- Teaching Times -->
                                    <div class="form-group">
                                        <label for="teaching_times">เวลาที่สะดวกสอน</label>
                                        <input type="text" class="form-control" id="teaching_times" name="teaching_times"
                                            value="{{ $course->teaching_times }}">
                                    </div>

                                    <!-- Course Price -->
                                    <div class="form-group">
                                        <label for="course_price">ราคา/ชั่วโมง</label>
                                        <input type="text" class="form-control" id="course_price" name="course_price"
                                            value="{{ $course->course_price }}">
                                    </div>

                                    <!-- Message to Students -->
                                    <div class="form-group">
                                        <label for="message_to_students">ข้อความถึงผู้เรียน</label>
                                        <textarea class="form-control" id="message_to_students" name="message_to_students" rows="4">{{ $course->message_to_students }}</textarea>
                                    </div>

                                    <div class="form-group pt-3">
                                        <label for="message_to_students">ใบชำระเงิน</label>
                                        <img src="{{ asset($course->payment_receipt) }}" alt="" width="100">
                                    </div>

                                    <div class="form-group">
                                        <label for="image_file">อัปโหลดรูปใบชำระเงินใหม่ (หากต้องการแทนที่):</label>
                                        <input type="file" class="form-control-file" id="image_file"
                                            name="payment_receipt" value="{{ $course->payment_receipt }}"
                                            accept="image/*">
                                    </div>

                                    <div class="form-group pt-3 row" style="display: none">
                                        <label for="name" class="col-lg-2 col-form-label">สถานะ:</label>
                                        <div class="col-lg-10">
                                            <input type="hidden" name="course_status" value="1">
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mt-3">
                                        <div class="btn-group" role="group" aria-label="First group">
                                            <a href="{{ url('manageSubject') }}" class="btn btn-danger btn-sm me-2">ย้อนกลับ</a>
                                        </div>
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <button type="submit" class="btn btn-primary btn-sm">ยืนยันแก้ไข</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#task_textarea'))
            .catch(error => {
                console.error(error);
            });

        // Get references to the radio buttons and the input field
        const radioOption1 = document.getElementById('flexRadioDefault1');
        const radioOption2 = document.getElementById('flexRadioDefault2');
        const numberOfStudentsInput = document.getElementById('number_of_students');

        // Add event listeners to the radio buttons
        radioOption1.addEventListener('change', toggleNumberOfStudentsField);
        radioOption2.addEventListener('change', toggleNumberOfStudentsField);

        // Initial check when the page loads
        toggleNumberOfStudentsField();

        function toggleNumberOfStudentsField() {
            if (radioOption1.checked) {
                // If "สอนรวม" is selected, enable the input field
                numberOfStudentsInput.removeAttribute('disabled');

                // Ensure the input field has a minimum value of 2
                numberOfStudentsInput.min = 2;

                // Check if the current value is less than 2, and set it to 2 if needed
                if (numberOfStudentsInput.value < 2) {
                    numberOfStudentsInput.value = 2;
                }
            } else {
                // If "สอนตัวต่อตัว" is selected, disable the input field and set it to 1
                numberOfStudentsInput.setAttribute('disabled', 'disabled');
                numberOfStudentsInput.value = 1;
            }
        }
    </script>
@endsection
