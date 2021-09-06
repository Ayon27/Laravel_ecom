<div class="col-md-3 mb-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
                <img style="border-radius: 50%"
                    src="{{$user->profile_photo_path === NULL ? asset(Auth::user()->profile_photo_url) : asset($user->profile_photo_path) }}"
                    alt="profile photo" class="rounded-circle" width="150" id="img_to_show">
                <div class="mt-5">
                    <h2>{{ $user->name }}</h2>
                    <a href="{{ route('user.logout') }}">
                        <button class="btn btn-primary" style="margin-top: 1vh"> Sign Out</button> </a>
                </div>
            </div>
        </div>
    </div>


    <div class="card mt-3" style="margin-top: 2vh">

        <ul class="list-group list-group-horizontal">

            <a href="">
                <li style="margin-top:2vh"
                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">

                    <h6 class="mb-0 text-center"><i class="fas fa-suitcase fa-2x"></i></h6>
                    <h4 class="text-center"><strong>Orders</strong> </h4>

                </li>
            </a>

            <a href="{{ route('user.profile.edit') }}">
                <li style="margin-top:2vh"
                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">

                    <h6 class="mb-0 text-center"><i class="fas fa-user fa-2x"></i></h6>

                    <h4 class="text-center"><strong>Edit Profile</strong> </h4>

                </li>
            </a>

            <a href="{{ route('user.password.change') }}">
                <li style="margin-top:2vh"
                    class="list-group-item d-flex justify-content-between align-items-center flex-wrap">

                    <h6 class="mb-0 text-center"><i class="fas fa-key fa-2x"></i></h6>

                    <h4 class="text-center"><strong>Change Password</strong> </h4>

                </li>
            </a>

        </ul>
    </div>
</div>

<div class="col-md-2"></div>
