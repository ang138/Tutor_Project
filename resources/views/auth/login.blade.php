@extends('layouts.main_template')

@section('content')
    {{-- <div class="wrapper">
        <form action="">
            <div class="input-box">
                <input id="email" type="email" placeholder="Enter Email" @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <i class='bx bx-envelope'></i>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-box">
                <input id="password" type="password" placeholder="Enter Password" @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                {{ __('Login') }}
            </button>
        </form>
    </div> --}}




    <div class="container pt-5">
        <h1 style="text-align: center; font-weight: bold;">เข้าสู่ระบบ</h1>
        <div class="row justify-content-center">
            <div class="col-md-6 pt-4">
                <div class="card" style="background-color: #6A9BBE;">
                    <div class="card-body pt-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <div class="input-box">
                                    <input id="email" type="email" placeholder="Enter Email"
                                        @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                        required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-6 d-flex justify-content-center">
                                    <input id="email" type="email" placeholder="Enter Email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                            </div>

                            <div class="row mb-3">
                                <div class="input-box">
                                    <input id="password" type="password" placeholder="Enter Password"
                                        @error('password') is-invalid @enderror" name="password"
                                        requiredautocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-6">
                                    <input id="password" type="password" placeholder="Enter Password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                            </div>
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="button row mb-5">
                                <button type="submit" class="btn btn-primary"> {{ __('Login') }} </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
