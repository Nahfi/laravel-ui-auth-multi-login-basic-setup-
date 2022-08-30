
@extends('layouts.customer.auth.customer_auth_app')
@section('customer_auth_page_title')
Reset Password | Task
@endsection
@section('customer_auth_content')
<div class="auth-content my-auto">
    <div class="text-center">
        {{-- <h5 class="mb-0">Don't Panic!</h5> --}}
        <p class="text-muted mt-2">We will send all reset instruction in your email!!!</p>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <form class="mt-4 pt-2"  method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group mb-4">
            <input type="email" class="form-control  @error('email') is-invalid @enderror" id="input-username" name="email" placeholder="Enter Email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror


        </div>
        <div class="mb-3">
            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Send Password Reset Link</button>
        </div>
    </form>

    <div class="mt-5 text-center">
        <p class="text-muted mb-0">Do Nothing? <a href="{{ route('login') }}"
                class="text-primary fw-semibold"> Login</a> </p>
    </div>


</div>
@endsection
