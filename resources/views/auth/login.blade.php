@extends('user.master')

@section('user.conent')


<div class="body-content">

    <div class="container" style=" margin-bottom: 5vh">

        <div class="sign-in-page">

            <div class="row align-items-center">
                <!-- Sign-in -->
                <div class="col-md-6 col-sm-12 sign-in">

                    <h4 class="">Sign in</h4>
                    <p class="">Hello, Welcome to your account.</p>

                    <div class="social-sign-in outer-top-xs">
                        <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with
                            Facebook</a>
                        <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with
                            Twitter</a>
                    </div>

                    <form class="register-form outer-top-xs" method="POST"
                        action="{{ isset($guard) ? url($guard.'/login') : route('login') }}">
                        @csrf



                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Email Address
                                <span>*</span></label>
                            <input type="email" class="form-control unicase-form-control text-input" id="email"
                                name="email">

                            @error('email')
                            <p style="color: red"> <small>{{ $message }}</small> </p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputPassword1">Password
                                <span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input" id="password"
                                name="password">

                            @error('password')
                            <p style="color: red"> <small>{{ $message }}</small> </p>
                            @enderror
                        </div>

                        <div class="radio outer-xs">

                            <a href="{{ route('password.request') }}" class="forgot-password pull-right"
                                style="color: red"><i class="fa fa-key" aria-hidden="true"></i>Forgot your
                                Password?</a>
                        </div>

                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>

                    </form>
                </div>
                <!-- Sign-in -->

            </div><!-- /.row -->

        </div><!-- /.sigin-in-->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->

@endsection
