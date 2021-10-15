@extends('user.master')

@section('user.conent')

<div class="body-content">

    <div class="container" style=" margin-bottom: 10vh; margin-top:10vh">

        <div class="sign-in-page">

            <div class="row">
                <!-- Sign-in -->
                <div class="col-md-3"></div>
                <div class="col-md-6 col-sm-12 sign-in" style="margin-top: 3vh; margin-bottom:3vh">

                    <h4 class="">Forgot Password?</h4>
                    <p class="">Please enter your email address. We'll send you a link to reset your password</p>


                    <form class="register-form outer-top-xs" method="POST" action="{{ route('password.email') }}">
                        @csrf


                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Email Address
                                <span>*</span></label>
                            <input type="email" class="form-control unicase-form-control text-input" id="email"
                                name="email">

                            @if (session('status'))
                            <div class="alert alert-warning" role="alert" style="margin-top: 2vh">
                                {{session('status')}}
                            </div>
                            @endif

                        </div>

                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Send</button>

                    </form>
                </div>
                <!-- Sign-in -->

            </div><!-- /.row -->

        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div><!-- /.body-content -->

@endsection
