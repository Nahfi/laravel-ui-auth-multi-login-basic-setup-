
@extends('layouts.customer.auth.customer_auth_app')
@section('customer_auth_page_title')
Reset Password | Task
@endsection
@section('customer_auth_content')
<div class="auth-content my-auto">
    <div class="text-center">
        <h5 class="mb-0">Update for Password!</h5>

        @if (Session::has('reset_link_send_success'))
            <div class="alert alert-success">
                {{ Session::get('reset_link_send_success') }}
            </div>
        @endif
    </div>
    <form class="mt-4 pt-2" method="POST" action="{{ route('password.update') }}">
        @csrf
        <div class="form-group mb-4">
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="email"  class="form-control @error('password') is-invalid @enderror " id="input-username"  name="email" value="{{ $email ?? old('email') }}" placeholder="Enter Email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror


        </div>
        <div class="form-group mb-4">

            <input type="password" class="form-control @error('password') is-invalid @enderror" id="input-new-password" name="password" placeholder="Enter new password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror


        </div>
        <div class="form-group mb-4">

            <input type="password" class="form-control" id="input-new-password_confirm" name="password_confirmation" placeholder="Enter confirm password">
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror


        </div>
        <div class="mb-3">
            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Update Password</button>
        </div>
    </form>

    <div class="mt-5 text-center">
        <p class="text-muted mb-0">Remember Password? <a href="{{ route('admin.login') }}"
                class="text-primary fw-semibold"> Login</a> </p>
    </div>
</div>
@endsection
