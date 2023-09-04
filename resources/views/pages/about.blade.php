<!-- การเรียกใช้งาน Tempate -->
@extends('layouts.main_template')
@section('title')
    หาติวเตอร์
@endsection
@section('content')
    <!--ส่วนของ Feature -->
    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">คอร์สยอดนิยม</h1>
        <div class="card col-md-12 mx-auto" style="border: 1;">
            <div class="card-body">
                {{-- <div class="detail">
                    <div class="row">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('assets/images/slide2.jpg') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                    of
                                    the card's content.</p>
                                <a href="#" class="btn-detail">Link Button</a>
                            </div>
                        </div>
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('assets/images/slide2.jpg') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                    of
                                    the card's content.</p>
                                <a href="#" class="btn-detail">Link Button</a>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div class="col">
                      <div class="card h-100">
                        <img src="{{ asset('assets/images/slide2.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted"><a href="#" class="btn-detail">รายละเอียด</a></small>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card h-100">
                        <img src="{{ asset('assets/images/slide2.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted"><a href="#" class="btn-detail">รายละเอียด</a></small>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card h-100">
                        <img src="{{ asset('assets/images/slide2.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted"><a href="#" class="btn-detail">รายละเอียด</a></small>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="card h-100">
                        <img src="{{ asset('assets/images/slide2.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                        </div>
                        <div class="card-footer">
                          <small class="text-muted"><a href="#" class="btn-detail">รายละเอียด</a></small>
                        </div>
                      </div>
                    </div>
                  </div>


            </div>
        </div>
    </div>
@endsection
