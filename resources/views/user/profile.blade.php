@extends('user.master')

@section('user.conent')

<div class="container" style="margin-top: 6vh; margin-bottom: 5vh">
    <div class="main-body">


        <div class="row gutters-sm">

            @include('user.layouts.profile-main')

            <div class="col-md-5" style="margin-top: 5vh">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h4 class="mb-0">Name :</h4>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <h4> {{ $user->name }} </h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h4 class="mb-0">Email :</h4>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <h4> {{ $user->email }}</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h4 class="mb-0">Phone :</h4>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <h4> {{ $user->phone }}</h4>
                            </div>
                        </div>


                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-primary " target="" href="{{ route('user.profile.edit') }}">Edit
                                    Profile</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

</div>

@endsection
