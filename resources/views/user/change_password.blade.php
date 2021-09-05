@extends('user.master')

@section('user.conent')
<div class="container" style="margin-top: 6vh; margin-bottom: 5vh">
    <div class="main-body">


        <div class="row gutters-sm">

            @include('user.layouts.profile-main')

            <div class="col-md-5" style="margin-top: 5vh">
                <div class="card mb-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.password.change.save') }}">
                            @csrf

                            <div class="form-group">
                                <label for="current_password">Current Password *</label>
                                <input type="password" class="form-control" id="current_password"
                                    aria-describedby="current password" required name="current_password">

                                @error('current_password')
                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label for="new_password">New Password *</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                                @error('new_password')
                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirm">Confirm Password *</label>
                                <input type="password" class="form-control" id="new_password_confirm"
                                    name="new_password_confirm">
                                @error('new_password_confirm')
                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary"><strong> Update </strong></button>
                            <a href="{{ route('user.profile') }}" class="btn btn-primary" role="button"
                                aria-disabled="true"><strong>Cancel</strong> </a>
                        </form>
                    </div>
                </div>


            </div>
        </div>

    </div>

</div>

@endsection
