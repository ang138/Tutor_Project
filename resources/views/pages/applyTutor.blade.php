    <!-- การเรียกใช้งาน Tempate -->
    @extends('layouts.main_template')
    @section('title')
        บริการของเรา
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
                        <div class="col-md-8 pt-1 ">
                            <div class="card" style="border: 0;">
                                <div class="card-body pt-3 pb-2">
                                    <form>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">*คำนำหน้า (Name Title)</label>
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>---คำนำหน้า---</option>
                                                <option value="1">นาย</option>
                                                <option value="2">นางสาว</option>
                                            </select>
                                        </div>
                                        <div class="form-group pt-3">
                                            <label for="exampleFormControlSelect1">ชื่อ</label>
                                            <input type="text" class="form-control" placeholder="First name">
                                        </div>
                                        <div class="form-group pt-3">
                                            <label for="exampleFormControlSelect1">นามสกุล</label>
                                            <input type="text" class="form-control" placeholder="Last name">
                                        </div>
                                        <div class="form-group pt-3">
                                            <label for="exampleInputEmail1">ชื่อเล่น</label>
                                            <input type="text" class="form-control" placeholder="First name">
                                        </div>
                                        <div class="form-group pt-3">
                                            <label for="startDate">วันเกิด</label>
                                            <input id="startDate" class="form-control" type="date" />
                                        </div>

                                        {{-- <div class="row pt-3">
                                            <div class="col">
                                                <label for="exampleFormControlSelect1">ชื่อ</label>
                                                <input type="text" class="form-control" placeholder="First name">
                                            </div>
                                            <div class="col">
                                                <label for="exampleFormControlSelect1">นามสกุล</label>
                                                <input type="text" class="form-control" placeholder="Last name">
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col">
                                                <label for="exampleInputEmail1">ชื่อเล่น</label>
                                                <input type="text" class="form-control" placeholder="First name">
                                            </div>
                                            <div class="col">
                                                <label for="startDate">วันเกิด</label>
                                                <input id="startDate" class="form-control" type="date" />
                                            </div>
                                        </div> --}}

                                        <div class="form-group pt-3">
                                            <label for="exampleFormControlSelect1">เบอร์โทรศัพท์</label>
                                            <input type="text" class="form-control" placeholder="First name">
                                        </div>

                                        <div class="form-group pt-3">
                                            <label for="exampleFormControlSelect1">*Line ID</label>
                                            <input type="text" class="form-control" placeholder="First name">
                                        </div>
                                        <div class="form-group pt-3 pb-3">
                                            <label for="exampleFormControlSelect1">Facebook</label>
                                            <input type="text" class="form-control" placeholder="First name">
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ------------------------------ --}}
                    <div class="row pt-3" style="padding-left: 10px; padding-right: 10px">
                        <div class="card" style="background-color: #6A9BBE; width: 30rem;">
                            <div class="card-body pt-3 pb-2">
                                <h4 style="text-align: center; font-weight: bold;">ประวัติการศึกษา (Education Background)
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-8 pt-1 ">
                            <div class="card" style="border: 0;">
                                <div class="card-body pt-3 pb-2">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">*คำนำหน้า (Name Title)</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>---คำนำหน้า---</option>
                                            <option value="1">นาย</option>
                                            <option value="2">นางสาว</option>
                                        </select>
                                    </div>
                                    <div class="form-group pt-3">
                                        <label for="exampleFormControlSelect1">*คำนำหน้า (Name Title)</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>---คำนำหน้า---</option>
                                            <option value="1">นาย</option>
                                            <option value="2">นางสาว</option>
                                        </select>
                                    </div>
                                    <div class="form-group pt-3">
                                        <label for="exampleFormControlSelect1">ชื่อ</label>
                                        <input type="text" class="form-control" placeholder="First name">
                                    </div>
                                    <div class="form-group pt-3">
                                        <label for="exampleFormControlSelect1">นามสกุล</label>
                                        <input type="text" class="form-control" placeholder="Last name">
                                    </div>
                                    <div class="form-group pt-3">
                                        <label for="exampleInputEmail1">ชื่อเล่น</label>
                                        <input type="text" class="form-control" placeholder="First name">
                                    </div>

                                    {{-- <div class="row pt-3">
                                            <div class="col">
                                                <label for="exampleFormControlSelect1">ชื่อ</label>
                                                <input type="text" class="form-control" placeholder="First name">
                                            </div>
                                            <div class="col">
                                                <label for="exampleFormControlSelect1">นามสกุล</label>
                                                <input type="text" class="form-control" placeholder="Last name">
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="col">
                                                <label for="exampleInputEmail1">ชื่อเล่น</label>
                                                <input type="text" class="form-control" placeholder="First name">
                                            </div>
                                            <div class="col">
                                                <label for="startDate">วันเกิด</label>
                                                <input id="startDate" class="form-control" type="date" />
                                            </div>
                                        </div> --}}

                                    <div class="mb-3 pt-3">
                                        <label for="formFile" class="form-label">Default file input example</label>
                                        <input class="form-control" type="file" id="formFile">
                                    </div>
                                    <div class="form-group pt-1">
                                        <label for="exampleFormControlSelect1">Facebook</label>
                                        <input type="text" class="form-control" placeholder="First name">
                                    </div>
                                    <div class="apply row mb-5 pt-12">
                                        <button type="submit" class="apply-btn btn-primary"> {{ __('Login') }}</button>
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
    @endsection
