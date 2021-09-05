<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="{{ asset('admin/images/favicon.ico') }}">

        <title>AOV - Admin Dashboard</title>

        <!-- Vendors Style-->
        <link rel="stylesheet" href="{{ asset('admin/css/vendors_css.css') }}">
        <!-- Style-->
        <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/css/skin_color.css') }}">

        {{-- toastr js --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
            integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>

    <body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

        <div class="wrapper">

            @include('admin.layouts.header')

            <!-- Left side column. contains the logo and sidebar -->
            @include('admin.layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                @yield('admin.dash')

            </div>

            <!-- /.content-wrapper -->



        </div>
        <!-- ./wrapper -->



    </body>
    @include('admin.layouts.footer')


    <!-- Vendor JS -->
    <script src="{{ asset('admin/js/vendors.min.js') }}"></script>
    <script src="{{ asset('../assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('../assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
    <script src="{{ asset('../assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
    <script src="{{ asset('../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>

    <!--  Admin  -->
    <script src="{{ asset('admin/js/template.js') }}"></script>
    <script src="{{ asset('admin/js/pages/dashboard.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js">
    </script>

    <script>
        @if(Session::has('message'))

             var type = "{{ Session::get('alert-type','info') }}"

             switch(type){
                case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

                case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

                case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

                case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
             }
             @endif
    </script>

</html>
