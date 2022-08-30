@extends('layouts.customer.customer_app')
@section('user_page_title')
Home
@endsection
@section('home_active')
    mm-active
@endsection
@section('customer_css')
    <style>
        .icon{
            font-size: 40px;
            color: #2AB57E;
        }

        .icon_info{
            font-size: 40px;
            color: #2a74b5;
        }
        .icon_danger{
            font-size: 40px;
            color: #d4241b;
        }
        .icon_info_initialize{
            font-size: 40px;
            color: #043538b9;
        }
        .icon_info_processing{
            font-size: 40px;
            color: #46033ab9;
        }
        .icon_info_success{
            font-size: 40px;
            color: #03461f;
        }
    </style>
@endsection
@section('customer_content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18"> Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        {{--  <div class="row mb-4">
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p>Total Invoice</p>
                                <span> <b>{{ $totalInvoice }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class=" fas fa-file-invoice icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p>Total Project</p>
                                <span> <b>{{ $totalProject }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-project-diagram icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p> Assigned Project</p>
                                <span> <b>{{ $assignedProject }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-project-diagram icon_info_initialize"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p> Running Project</p>
                                <span> <b>{{ $runningProject }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-project-diagram icon_info_processing"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p> Completed Project</p>
                                <span> <b>{{ $completedProject }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-project-diagram icon_info_success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p> Total Spend</p>
                                <span> <b>{{ $totalSpend }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon_danger">৳</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p> Total Paid</p>
                                <span> <b>{{ $totalPaid }}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon_danger">৳</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <p> Total Due</p>
                                <span> <b>{{ $totalDue}}</b> </span>
                            </div>
                            <div class="col-4">
                                <i class="icon_danger">৳</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>  --}}

    </div> <!-- container-fluid -->
</div>
@endsection
