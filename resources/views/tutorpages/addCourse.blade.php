@extends('layouts.tutor_template')
@section('title')
    ติดต่อเรา
@endsection
@section('content')
<div class="container pt-5">
    <h1 style="text-align: center; font-weight: bold;">รายวิชาที่ต้องการเปิดสอน</h1>
    <div class="card col-md-8 mx-auto" style="border: 1;">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-8 pt-1 ">
                    <div class="card" style="border: 0;">
                        <div class="card-body pt-3 pb-2">
                            <form action="insert-course" method="post" enctype="multipart/form-data">
                                @csrf <!-- ใส่ CSRF token -->

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">รายวิชา</label>
                                    <select class="form-select" aria-label="Default select example" name="subject_id">
                                        <option value="">เลือกรายวิชา</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group pt-3">
                                    <label for="exampleFormControlSelect1">เนื้อหาที่จะสอน</label>
                                    <textarea class="form-control" id="task_textarea" rows="3" name="course_content"></textarea>
                                    @error('course_content')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group pt-3">
                                    <label for="exampleFormControlSelect1">สถานที่สะดวกสอน</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="location[]" value="บริเวณ ม.ทักษิณ วิทยาเขตพัทลุง" id="flexCheckDefault1">
                                    <label class="form-check-label" for="flexCheckDefault1">
                                        บริเวณ ม.ทักษิณ วิทยาเขตพัทลุง
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="location[]" value="ออนไลน์" id="flexCheckDefault2" checked>
                                    <label class="form-check-label" for="flexCheckDefault2">
                                        ออนไลน์
                                    </label>
                                </div>
                                <div class="form-group pt-3">
                                    <label for="exampleFormControlSelect1">การสอน</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="course_type" id="flexRadioDefault1" value="สอนรวม">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        สอนรวม
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="course_type" id="flexRadioDefault2" value="สอนตัวต่อตัว" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        สอนตัวต่อตัว
                                    </label>
                                </div>


                                <div id="numberOfStudentsDiv">
                                    <div class="form-group pt-3">
                                        <label for="number_of_students">จำนวนผู้เรียน</label>
                                        <input type="number" class="form-control" name="number_of_students" id="number_of_students" >
                                        @error('number_of_students')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group pt-3">
                                    <label for="exampleFormControlSelect1">วันที่สะดวกสอน</label>
                                    <input type="text" class="form-control" placeholder="เช่น วันเสาร์-อาทิตย์" name="teaching_days">
                                    @error('teaching_days')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group pt-3">
                                    <label for="exampleFormControlSelect1">เวลาที่สะดวกสอน</label>
                                    <input type="text" class="form-control" placeholder="เช่น 18.00-20.00 น." name="teaching_times">
                                    @error('teaching_times')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group pt-3">
                                    <label for="exampleFormControlSelect1">ราคาคอร์ส</label>
                                    <input type="text" class="form-control" placeholder="ราคา" name="course_price">
                                    @error('course_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 pt-3">
                                    <label for="formFile" class="form-label">ใบชำระเงิน</label>
                                    <input class="form-control" type="file" id="formFile" name="payment_receipt" accept="image/*">
                                    @error('payment_receipt')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group pt-1">
                                    <label for="exampleFormControlSelect1">ข้อความถึงผู้เรียน</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message_to_students"></textarea>
                                    @error('message_to_students')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                        <button type="submit" value="Add student" class="btn btn-primary btn-sm">ยืนยันการเพิ่ม</button>
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
