<!-- การเรียกใช้งาน Tempate -->
@extends('layouts.main_template')
@section('title')
    หาติวเตอร์
@endsection
@section('content')
    <!--ส่วนของ Feature -->
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">รายละเอียดรายวิชา และ ติวเตอร์</h1>
        <div class="card col-md-12 mx-auto" style="border: 1;">
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 g-4">

                    <div class="col-md-4 text-center">
                        <div class="card bg-light">
                            <img src="{{ asset('assets/images/tutor.jpg') }}" class="card-img-top mx-auto pt-2" style="width: 18rem; alt="...">
                            <div class="card-body">
                                <h5 class="card-title">วิชาคอมพิวเตอร์</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 text-center">
                        <div class="card bg-light" style="height: 100%;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi enim magnam, ex
                                        provident
                                        doloribus
                                        reprehenderit doloremque tenetur pariatur temporibus quisquam excepturi. Totam iusto
                                        aliquam
                                        nostrum
                                        praesentium soluta laudantium quibusdam. Accusamus!</p>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi enim magnam, ex
                                        provident
                                        doloribus
                                        reprehenderit doloremque tenetur pariatur temporibus quisquam excepturi. Totam iusto
                                        aliquam
                                        nostrum
                                        praesentium soluta laudantium quibusdam. Accusamus!</p>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi enim magnam, ex
                                        provident
                                        doloribus
                                        reprehenderit doloremque tenetur pariatur temporibus quisquam excepturi. Totam iusto
                                        aliquam
                                        nostrum
                                        praesentium soluta laudantium quibusdam. Accusamus!</p>
                                </h5>
                                <small class="text-muted">
                                    <button type="submit" class="btn-detail"> {{ __('Login') }} </button>
                                </small>
                            </div>
                        </div>

                    </div>

                    {{-- <div class="col">
                      <div class="card h-70 w-50 bg-light">
                        <img src="{{ asset('assets/images/computer.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">วิชาคอมพิวเตอร์</h5>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card h-60 bg-light">
                        <img src="{{ asset('assets/images/slide2.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted"><a href="{{ url('subject') }}" class="btn-detail">หาติวเตอร์</a></small>
                        </div>
                      </div>
                    </div> --}}
                </div>


            </div>
        </div>
    </div>
@endsection
