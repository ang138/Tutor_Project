    <!-- การเรียกใช้งาน Tempate -->
    @extends('layouts.main_template')
    @section('title')
        สมัครติวเตอร์
    @endsection
    @section('content')
        <div class="container pt-5">
            <h1 style="text-align: center; font-weight: bold;">สมัครติวเตอร์</h1>
            <div class="card col-md-8 mx-auto" style="border: 1;">
                <div class="card-body">
                    {{-- ------------------------ --}}
                    <div class="row" style="padding-left: 10px; padding-right: 10px">
                        <div class="card" style="background-color: #6A9BBE; width: 28rem;">
                            <div class="card-body pt-3 pb-2">
                                <h4 style="text-align: center; font-weight: bold;">ข้อมูลส่วนตัว (Personal Information)</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-9 pt-1 ">
                            <div class="card" style="border: 0;">
                                <div class="card-body pt-3 pb-2">
                                    <form>

                                        <div class="form-group row">
                                            <label for="name" class="col-lg-2 col-form-label">คำนำหน้า:</label>
                                            <div class="col-lg-10">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected>---คำนำหน้า---</option>
                                                    <option value="1">นาย</option>
                                                    <option value="2">นางสาว</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">ชื่อ:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="First name">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">นามสกุล:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="Last name">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">วันเกิด:</label>
                                            <div class="col-lg-10">
                                                <div class="row g-3">
                                                    <div class="col-sm-3">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option selected>วันที่</option>
                                                            <option value="1">นาย</option>
                                                            <option value="2">นางสาว</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option selected>เดือน</option>
                                                            <option value="1">นาย</option>
                                                            <option value="2">นางสาว</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm">
                                                        <select class="form-select" aria-label="Default select example">
                                                            <option selected>ปี</option>
                                                            <option value="1">นาย</option>
                                                            <option value="2">นางสาว</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">เบอร์มือถือ:</label>
                                            <div class="col-lg-10">
                                                <input type="tel" class="form-control" name="mobile_number"
                                                    id="mobile_number" pattern="[0-9]{10}" maxlength="10" required>
                                                <span id="mobile_error" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">Line ID:</label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" placeholder="Last name">
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">Facebook:</label>
                                            <div class="col-lg-10">
                                                <div class="input-group">
                                                    <span class="input-group-text"
                                                        id="basic-addon3">https://www.facebook.com/</span>
                                                    <input type="text" class="form-control" id="basic-url"
                                                        aria-describedby="basic-addon3">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ------------------------------ --}}
                    <div class="row pt-3" style="padding-left: 10px; padding-right: 10px">
                        <div class="card" style="background-color: #6A9BBE; width: 30rem;">
                            <div class="card-body pt-3 pb-2">
                                <h4 style="text-align: center; font-weight: bold;">การศึกษา (Education)</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-9 pt-1 ">
                            <div class="card" style="border: 0;">
                                <div class="card-body pt-3 pb-2">
                                    <div class="form-group row">
                                        <label for="name" class="col-lg-2 col-form-label">คณะ:</label>
                                        <div class="col-lg-10">
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>---คำนำหน้า---</option>
                                                <option value="1">นาย</option>
                                                <option value="2">นางสาว</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">สาขา:</label>
                                        <div class="col-lg-10">
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>---คำนำหน้า---</option>
                                                <option value="1">นาย</option>
                                                <option value="2">นางสาว</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">ชั้นปี:</label>
                                        <div class="col-lg-10">
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>---คำนำหน้า---</option>
                                                <option value="1">นาย</option>
                                                <option value="2">นางสาว</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">เกรดเฉลี่ย:</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" placeholder="GPAX">
                                        </div>
                                    </div>
                                    <div class="form-group pt-3 row">
                                        <label for="name" class="col-lg-2 col-form-label">ใบเกรด:</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" type="file" id="formFile">
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ------------------------------ --}}
                    <div class="row pt-3" style="padding-left: 10px; padding-right: 10px">
                        <div class="card" style="background-color: #6A9BBE; width: 35rem;">
                            <div class="card-body pt-3 pb-2">
                                <h4 style="text-align: center; font-weight: bold;">ประสบการณ์การสอน (Teaching experience)
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-9 pt-1 ">
                            <div class="card" style="border: 0;">
                                <div class="card-body pt-3 pb-2">
                                    <div class="form-group row">
                                        <label for="experience" class="col-lg-4 col-form-label">ประสบการณ์การสอน:</label>
                                        <div class="col-lg-8">
                                            <div class="form-check pt-1">
                                                <input class="form-check-input" type="radio" name="experience" id="no_experience" value="no_experience">
                                                <label class="form-check-label" for="no_experience">ยังไม่มีประสบการณ์การสอน</label>
                                            </div>
                                            <div class="form-check pt-3">
                                                <input class="form-check-input" type="radio" name="experience" id="has_experience" value="has_experience">
                                                <label class="form-check-label" for="has_experience">มีประสบการณ์การสอน</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="hr" />

                                    <!-- แบบฟอร์มเพิ่มเมือเลือก -> มีประสบการณ์การสอน -->
                                    <div class="form-group row" id="additional_form" style="display: none;">
                                        <!-- แบบฟอร์มเพิ่ม -->
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">สาขา:</label>
                                            <div class="col-lg-10">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected>---คำนำหน้า---</option>
                                                    <option value="1">นาย</option>
                                                    <option value="2">นางสาว</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group pt-3 row">
                                            <label for="name" class="col-lg-2 col-form-label">ชั้นปี:</label>
                                            <div class="col-lg-10">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected>---คำนำหน้า---</option>
                                                    <option value="1">นาย</option>
                                                    <option value="2">นางสาว</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="apply row mb-5">
                                        <small class="text-muted"><a href="#" class="btn-apply">บันทึก</a></small>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ------------------------------ --}}
                </div>
            </div>
        </div>
        <script>
            document.getElementById('mobile_number').addEventListener('input', function() {
                const mobileNumber = this.value;
                const mobileError = document.getElementById('mobile_error');

                // เช็ครูปแบบเบอร์มือถือ (ต้องเป็นตัวเลขและมี 10 หลัก)
                const mobilePattern = /^[0-9]{10}$/;

                if (mobilePattern.test(mobileNumber)) {
                    // ถ้าเบอร์มือถือถูกต้อง
                    mobileError.textContent = ''; // ลบข้อความผิดพลาด (ถ้ามี)
                } else {
                    // ถ้าเบอร์มือถือไม่ถูกต้อง
                    mobileError.textContent = 'กรุณากรอกเบอร์มือถือ 10 หลัก';
                }
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // เมื่อ radio button ถูกเลือก
                $("input[name='experience']").change(function() {
                    if ($(this).val() === "has_experience") {
                        // ถ้าเลือก "มีประสบการณ์การสอน" แสดงแบบฟอร์มเพิ่ม
                        $("#additional_form").show();
                    } else {
                        // ถ้าเลือก "ยังไม่มีประสบการณ์การสอน" ซ่อนแบบฟอร์มเพิ่ม
                        $("#additional_form").hide();
                    }
                });
            });
        </script>
    @endsection
