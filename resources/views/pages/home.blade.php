@extends('layouts.main_template')
@section('title')
    หน้าหลัก
@endsection
@section('content')
    <!-- Slide Image -->
    <div class="container">
        <div class="card col-md-12 mx-auto" style="border: none; height: auto;">
            <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($images as $key => $image)
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="{{ $key }}" {{ $key == 0 ? 'class=active' : '' }}></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach ($images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset($image->image_path) }}" class="d-block mx-auto"
                                    alt="{{ $image->alt_text }}" style="width: 100%; height: auto;">
                            </div>
                        @endforeach
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--ส่วนของ Feature -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 text-center">
                <i class="fas fa-home fa-3x text-success mb-3"></i>
                <h2 class="head-title">หน้าหลัก</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi enim magnam, ex provident doloribus
                    reprehenderit doloremque tenetur pariatur temporibus quisquam excepturi. Totam iusto aliquam nostrum
                    praesentium soluta laudantium quibusdam. Accusamus!</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-concierge-bell fa-3x text-warning mb-3"></i>
                <h2 class="head-title">เกี่ยวกับเรา</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, omnis nisi cumque nesciunt sed
                    beatae hic magni modi laboriosam ullam quam doloremque tempore commodi maiores, fugiat, porro
                    necessitatibus debitis placeat?</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-cloud-showers-heavy fa-3x text-danger mb-3"></i>
                <h2 class="head-title">บริการ</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt sequi hic aliquam magni odio
                    accusantium vero numquam quo labore odit? Totam, eius. Aperiam sapiente, eius accusantium distinctio
                    tempore iure minima.</p>
            </div>
        </div>
    </div>

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
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                    additional content. This content is a little bit longer.</p>
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
                                <p class="card-text">This card has supporting text below as a natural lead-in to additional
                                    content.</p>
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
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                    additional content. This card has even longer content than the first to show that equal
                                    height action.</p>
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
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                    additional content. This card has even longer content than the first to show that equal
                                    height action.</p>
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
