{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
@csrf

<div>
    <x-jet-label for="name" value="{{ __('Name') }}" />
    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus
        autocomplete="name" />
</div>

<div class="mt-4">
    <x-jet-label for="email" value="{{ __('Email') }}" />
    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
</div>

<div class="mt-4">
    <x-jet-label for="password" value="{{ __('Password') }}" />
    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
        autocomplete="new-password" />
</div>

<div class="mt-4">
    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
        required autocomplete="new-password" />
</div>

@if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
<div class="mt-4">
    <x-jet-label for="terms">
        <div class="flex items-center">
            <x-jet-checkbox name="terms" id="terms" />

            <div class="ml-2">
                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                    class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of
                    Service').'</a>',
                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                    class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy
                    Policy').'</a>',
                ]) !!}
            </div>
        </div>
    </x-jet-label>
</div>
@endif

<div class="flex items-center justify-end mt-4">
    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
        {{ __('Already registered?') }}
    </a>

    <x-jet-button class="ml-4">
        {{ __('Register') }}
    </x-jet-button>
</div>
</form>
</x-jet-authentication-card>
</x-guest-layout> --}}

@extends('user.master')

@section('user.conent')

<body class="cnt-home">

    <div class="body-content">
        <div class="container" style=" margin-bottom: 5vh">

            <div class="sign-in-page">

                <div class="row">

                    <!-- create a new account -->
                    <div class="col-md-6 col-sm-6 create-new-account">
                        <h4 class="checkout-subtitle">Create a new account</h4>
                        <p class="text title-tag-line">Create your new account.</p>
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
                                    name="phone">

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

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="terms" id="terms">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree to the <a href="">terms and conditions</a>
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
