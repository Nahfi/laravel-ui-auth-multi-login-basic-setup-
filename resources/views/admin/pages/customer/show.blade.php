@extends('layouts.admin.admin_app')
@section('admin_page_title')
    Show Customer | Task
@endsection
@section('customer_active')
    mm-active
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Customer</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">All Customer</a></li>
                            <li class="breadcrumb-item active">Show Customer</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12 text-center">
                <div class="card">
                    <div class="card-body">
                        <img style="width:100px;height:100px;" class="rounded-circle" src="{{ asset('photo/employee_profile') }}/{{ $customer->photo }}" alt="profile">
                        <hr>
                        <table class="table table-bordered text-center">
                            <tbody>
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $customer->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $customer->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $customer->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td>{{ $customer->address }}</td>
                                </tr>
                                <tr>
                                    <th>Total tk:</th>
                                    <td>{{ $customer->total }}</td>
                                </tr>
                                <tr>
                                    <th>Paid tk:</th>
                                    <td>{{ $customer->paid }}</td>
                                </tr>
                                <tr>
                                    <th>Due tk:</th>
                                    <td>{{ $customer->due }}</td>
                                </tr>
                                <tr>
                                    <th>Created By:</th>
                                    <td>{{ $customer->createdBy->name }}</td>
                                </tr>
                                <tr>
                                    <th>Edited By:</th>
                                    <td>{{ $customer->edited_by != '' ? $customer->editedBy->name: 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>{{ $customer->status }}</td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div>
@endsection
