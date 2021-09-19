<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keywords" content="MediaCenter, Template, eCommerce">
        <meta name="robots" content="all">
        <title>@yield('page_title')</title>

        <!-- Bootstrap Core CSS -->
        {{-- <link rel="stylesheet" href="{{ asset('user/assets/css/bootstrap.min.css') }}"> --}}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
            integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('user/assets/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('user/assets/css/blue.css') }}">

        {{-- <link rel="stylesheet" href="{{ asset('user/assets/css/owl.carousel.css') }}"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css"
            integrity="sha512-RWhcC19d8A3vE7kpXq6Ze4GcPfGe3DQWuenhXAbcGiZOaqGojLtWwit1eeM9jLGHFv8hnwpX3blJKGjTsf2HxQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- <link rel="stylesheet" href="{{ asset('user/assets/css/owl.transitions.css') }}"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.transitions.css"
            integrity="sha512-4ioNqjewIy2hSnYs7smFWpvzAB4xcD6NnR2z6ydUZEBg0UDVW3IoKATPoVYMyzKexe8yFU6sPd2VypoH2ZjCTQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- <link rel="stylesheet" href="{{ asset('user/assets/css/animate.min.css') }}"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
            integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- <link rel="stylesheet" href="{{ asset('user/assets/css/rateit.css') }}"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.rateit/1.1.5/rateit.css"
            integrity="sha512-UBZiEmhvSN+QLmroxtPWf4f1SsvHlDTAKqMfRw8g9vxALzXsPd/pkwgULarTBp28QRW+L70bAU6Z5Noh0A+OIg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- <link rel="stylesheet" href="{{ asset('user/assets/css/bootstrap-select.min.css') }}"> --}}
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css"
            integrity="sha512-ZACc4FM2d+Iq2BskSukuyDBB9Y2Ewji0/aRTqThaf3Op5u0MkdL7EqEgE6hnjjbP/Igl0bJCWLlGiNIIfr0Cdg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Icons/Glyphs -->
        <link rel="stylesheet" href="{{ asset('user/assets/css/font-awesome.css') }}">
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/fontawesome.min.css"
            integrity="sha512-P9vJUXK+LyvAzj8otTOKzdfF1F3UYVl13+F8Fof8/2QNb8Twd6Vb+VD52I7+87tex9UXxnzPgWA3rH96RExA7A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}


        {{-- toastr js css --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
            integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />


        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
            rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
            integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
            crossorigin="anonymous" />

        {{-- custom css --}}
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    </head>

    <body>
        <!-- ============================================== HEADER ============================================== -->

        @include('user.layouts.header')

        <!-- ============================================== HEADER : END ============================================== -->





        @yield('user.conent')


        <!-- /.body-content -->





        <!-- ============================================================= FOOTER ============================================================= -->
        @include('user.layouts.footer')
        <!-- ============================================================= FOOTER : END============================================================= -->


        <!-- JavaScripts  -->
        <script src="{{ asset('user/assets/js/jquery-1.11.1.min.js') }}"></script>
        <script src="{{ asset('user/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('user/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
        <script src="{{ asset('user/assets/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('user/assets/js/echo.min.js') }}"></script>
        <script src="{{ asset('user/assets/js/jquery.easing-1.3.min.js') }}"></script>
        <script src="{{ asset('user/assets/js/bootstrap-slider.min.js') }}"></script>
        <script src="{{ asset('user/assets/js/jquery.rateit.min.js') }}"></script>
        <script src="{{ asset('user/assets/js/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('user/assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('user/assets/js/scripts.js') }}"></script>
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

    </body>



</html>
