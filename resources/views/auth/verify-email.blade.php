{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
</div>

@if (session('status') == 'verification-link-sent')
<div class="mb-4 font-medium text-sm text-green-600">
    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
</div>
@endif

<div class="mt-4 flex items-center justify-between">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <div>
            <x-jet-button type="submit">
                {{ __('Resend Verification Email') }}
            </x-jet-button>
        </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
            {{ __('Log Out') }}
        </button>
    </form>
</div>
</x-jet-authentication-card>
</x-guest-layout> --}}

@extends('user.master')

@section('user.conent')
<div class="container" style=" margin-bottom: 10vh; margin-top: 10vh">

    <div class="sign-in-page">

        <div class="row align-items-center">
            <!-- Sign-in -->
            <div class="col-md-12 col-sm-12 sign-in">

                <h3 class="text-center" style="margin-bottom: 5vh">Thank you for signing up!</h3>
                <h5 class=""> Could you verify your email address by clicking on the link we just emailed to you? If
                    you didn't receive the email, we will gladly send you another. However do check that spam
                    folder beforehand! </h5>

                <form class="register-form outer-top-xs text-center" method="POST"
                    action="{{ route('verification.send') }}">
                    @csrf

                    <button type="submit" class="btn-upper btn btn-primary">Resend Verification
                        Email</button>

                </form>

                <form class="register-form outer-top-xs text-center" method="POST" action="{{ route('user.logout') }}"
                    id="logoutform">
                    @csrf

                    <a href="{{ route('user.logout') }}" style="color: gray; text-decoration: none;">Logout</a>
                </form>

            </div>
            <!-- Sign-in -->

        </div><!-- /.row -->

    </div><!-- /.sigin-in-->


</div><!-- /.container -->


@endsection
