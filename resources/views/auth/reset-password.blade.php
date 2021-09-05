{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
@csrf

<input type="hidden" name="token" value="{{ $request->route('token') }}">

<div class="block">
    <x-jet-label for="email" value="{{ __('Email') }}" />
    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)"
        required autofocus />
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

<div class="flex items-center justify-end mt-4">
    <x-jet-button>
        {{ __('Reset Password') }}
    </x-jet-button>
</div>
</form>
</x-jet-authentication-card>
</x-guest-layout> --}}

@extends('user.index')

@section('user.conent')

<div class="body-content">

    <div class="container" style=" margin-bottom: 5vh">

        <div class="sign-in-page">

            <div class="row align-items-center">
                <!-- Sign-in -->
                <div class="col-md-6 col-sm-12 sign-in">

                    <h4 class="">Reset your account Password</h4>
                    <p class="">Please enter as follows</p>


                    <form class="register-form outer-top-xs" method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Email
                                <span>*</span></label>
                            <input type="email" class="form-control unicase-form-control text-input" id="email"
                                name="email" required>

                            @error('email')
                            <p style="color: red"> <small>{{ $message }}</small> </p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">New Password
                                <span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input" id="password"
                                name="password" required>

                            @error('password')
                            <p style="color: red"> <small>{{ $message }}</small> </p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Confirm Password
                                <span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input"
                                id="password_confirmation" name="password_confirmation" required>

                            @error('password_confirmation')
                            <p style="color: red"> <small>{{ $message }}</small> </p>
                            @enderror
                        </div>

                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Update
                            Password</button>

                    </form>
                </div>
                <!-- Sign-in -->

            </div><!-- /.row -->

        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div><!-- /.body-content -->

@endsection
