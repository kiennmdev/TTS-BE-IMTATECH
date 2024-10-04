@extends('client.layouts.master')

@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Quên Mật Khẩu</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Trang Chủ</a></li>
                    <li class="active">Quên Mật Khẩu</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->
    <!-- Begin Kenne's Login Register Area -->
    <div class="kenne-login-register_area">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6">
                    <!-- Login Form s-->
                    @session('message')
                        <div class="alert alert-success" role="alert">
                            {{session('message')}}
                        </div>
                    @endsession
                    <form action="{{ route('send.mail.reset') }}" method="POST">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Quên Mật Khẩu</h4>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <label>Địa chỉ email*</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="Nhập địa chỉ email" name="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <button class="kenne-login_btn" type="submit">Gửi</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Kenne's Login Register Area  End Here -->
@endsection
