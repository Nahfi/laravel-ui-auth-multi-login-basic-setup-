<!doctype html>
<html lang="en">

<head>

        <meta charset="utf-8" />
        <title>@yield('admin_auth_page_title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('photo/settings/general') }}/{{ generalSettings()->favicon }}">

        @include('layouts.admin.auth.includes.css')

    </head>

    <body data-topbar="dark">

    <!-- <body data-layout="horizontal"> -->
        <div class="" style="background: #2AB57E;height:100vh;position:relative;">
            <div class="">
                <div class="row g-0">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 m-auto" style="position: absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
                        <div class="p-4" style="background: white;border-radius:10px;">
                            <div class="">
                                <div class="">
                                    <div class="text-center">
                                        <a style="font-size: 40px ;color: #01c273; text-decoration: none " href="{{ route('admin.login') }}">
                                            Admin Login
                                        </a>
                                    </div>
                                    @yield('admin_auth_content')
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>


       @include('layouts.admin.auth.includes.js')

    </body>
</html>
