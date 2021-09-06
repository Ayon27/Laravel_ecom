@extends('user.master')

@section('user.conent')

<body class="cnt-home">

    <div class="body-content">
        <div class="container" style=" margin-bottom: 5vh">

            <div class="sign-in-page">

                <div class="row">

                    <!-- create a new account -->
                    <div class="col-md-6 col-sm-6 create-new-account">
                        <h4 class="checkout-subtitle">Welcome to All-Out Vision Limited</h4>
                        <p class="text title-tag-line">Please create your new account.</p>
                        <form class="register-form outer-top-xs" action="{{ route('register') }}" method="POST">
                            @csrf


                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" name="name"
                                    id="name">

                                @error('name')
                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                @enderror

                            </div>


                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Email Address
                                    <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" name="email"
                                    id="email">

                                @error('email')
                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                @enderror

                            </div>



                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Phone Number
                                    <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="phone"
                                    name="phone" maxlength="11" minlength="11">

                                @error('phone')
                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                @enderror

                            </div>


                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="password" name="password">

                                @error('password')
                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                @enderror

                            </div>


                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Confirm Password
                                    <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="password_confirmation" name="password_confirmation">

                                @error('password_confirmation')
                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                @enderror
                            </div>


                            <div class="form-group">

                                <div class="form-check text-center" style="margin-bottom: 1vh">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <strong>By signing up you agree to the <a href="">terms and
                                                conditions</a></strong>
                                    </label>
                                    @error('terms')
                                    <p style="color: red"> <small>{{ $message }}</small> </p>
                                    @enderror
                                </div>


                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button"
                                    style="margin-top: 1vh">Sign
                                    Up</button>

                        </form>


                    </div>
                    <!-- create a new account -->
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->

        </div><!-- /.container -->
    </div><!-- /.body-content -->


</body>


@endsection
