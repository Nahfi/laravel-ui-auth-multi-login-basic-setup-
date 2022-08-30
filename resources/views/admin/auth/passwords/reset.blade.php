
@extends('layouts.admin.auth.admin_auth_app')
@section('admin_auth_page_title')
    Update Password
@endsection
@section('admin_auth_content')
<div class="">
    <div class="text-center">
        <h5 class="mb-0">Update Your Password!</h5>
        
        @if (Session::has('reset_link_send_success'))
            <div class="alert alert-success">
                {{ Session::get('reset_link_send_success') }}
            </div>
        @endif
    </div>
    <form class="mt-2 pt-2" action="{{ route('admin.updatePassword.post') }}" method="POST">
        @csrf
        <div class="form-group mb-4">
            <input type="hidden" name="token" value="{{ $data['reset_data']->token }}">
            <input type="email"  class="form-control" id="input-username"  name="email" value="{{ $data['reset_data']->email }}" placeholder="Enter Email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-4">
            
            <input type="password" class="form-control" id="input-new-password" name="password" placeholder="Enter new password">
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

    <div class="mt-2 text-center">
        <p class="text-muted mb-0">Remember Password? <a href="{{ route('admin.login') }}"
                class="text-primary fw-semibold"> Login</a> </p>
    </div>


</div>
@endsection