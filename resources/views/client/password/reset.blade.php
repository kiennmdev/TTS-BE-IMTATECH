@extends('client.layouts.master')

@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Đặt lại mật Khẩu</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Trang Chủ</a></li>
                    <li class="active">Đặt lại mật Khẩu</li>
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
                    <form action="{{ route('reset.update') }}" method="POST">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Đặt lại mật Khẩu</h4>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <label>Địa chỉ email*</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        value="{{ $email }}" placeholder="Nhập địa chỉ email" name="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input type="password" placeholder="Password" name="password" class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Confirm Password</label>
                                    <input type="password" placeholder="Confirm Password" name="password_confirmation">
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
