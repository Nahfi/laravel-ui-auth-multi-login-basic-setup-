@extends('layouts.admin.admin_app')
@section('admin_page_title')
    Dashboard | Task
@endsection
@section('home_active')
    active
@endsection
@section('admin_css')
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
    </style>
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                    </div>

                </div>
            </div>

        </div>
        <!-- end page title -->


    </div> <!-- container-fluid -->
</div>

@section('admin_js')
    <script>


     </script>


@endsection
@endsection


