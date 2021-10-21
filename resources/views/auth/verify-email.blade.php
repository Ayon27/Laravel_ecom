@extends('user.master')

@section('user.conent')
<div class="container" style=" margin-bottom: 10vh; margin-top: 10vh">

    <div class="sign-in-page">

        <div class="row align-items-center">
            <!-- Sign-in -->
            <div class="col-md-12 col-sm-12 sign-in">

                <h2 class="text-center" style="margin-bottom: 5vh">Thank you for signing up!</h2>
                <h5 style="line-height: 2"> Could you verify your email address by clicking on the
                    link
                    we just
                    emailed to you?
                    If
                    you didn't receive the email, we will gladly send you another. However, do check that spam
                    folder beforehand! </h5>

                <form class="register-form outer-top-xs text-center" method="POST"
                    action="{{ route('verification.send') }}">
                    @csrf

                    <button type="submit" class="btn-upper btn btn-primary m-t-20">Resend Verification
                        Email</button>

                </form>

                <form class="register-form outer-top-xs text-center " method="POST" action="{{ route('user.logout') }}"
                    id="logoutform">
                    @csrf

                    <a href="{{ route('user.logout') }}" style="color: gray; text-decoration: none;"
                        class="m-t-20">Logout</a>
                </form>

            </div>
            <!-- Sign-in -->

        </div><!-- /.row -->

    </div><!-- /.sigin-in-->


</div><!-- /.container -->


@endsection
