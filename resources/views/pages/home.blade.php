@extends('layouts.main_template')
@section('title')
    หน้าหลัก
@endsection
@section('content')
    <!-- Slide Image -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">

            @php
                ini_set('display_errors', '1');
                ini_set('display_startup_errors', '1');
                error_reporting(E_ALL);
            @endphp

            @foreach ($images as $key => $image)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}"
                    {{ $key == 0 ? 'class=active' : '' }}></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($images as $key => $image)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ asset($image->image_path) }}" class="d-block w-100" alt="{{ $image->alt_text }}">
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
    <!--ส่วนของ Feature -->
    <div class="container mt-5">
        <div class="f-family text-center">
            <h1 style="font-weight: bold">เลือกเรียนกับติวเตอร์ของเราดีอย่างไร ?</h1>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-5 text-center">
                <div class="card">
                    <img src="{{ url('/assets/images/promote1.png') }}" alt="">
                </div>
            </div>
            <div class="col-md-1 text-center">
            </div>
            <div class="col-md-5 text-center">
                <div class="card">
                    <img src="{{ url('/assets/images/promote2.png') }}" alt="">
                </div>
            </div>
        </div>
        <hr>
    </div>
@endsection
