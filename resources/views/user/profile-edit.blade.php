@extends('user.master')

@section('user.conent')

<div class="container" style="margin-top: 6vh; margin-bottom: 5vh">
    <div class="main-body">


        <div class="row gutters-sm">

            @include('user.layouts.profile-main')

            <div class="col-md-5" style="margin-top: 5vh">
                <div class="card mb-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.profile.edit.save') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="email">Name</label>
                                <input type="text" class="form-control" id="name" aria-describedby="name" required
                                    value="{{ $user->name }}" name="name">

                                @error('name')
                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}">
                                @error('email')
                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ $user->phone }}" maxlength="11" minlength="11">
                                @error('phone')
                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Photo</label>
                                <input type="file" class="form-control" id="image" name="image"
                                    value="{{ $user->phone }}">
                                @error('image')
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img_to_show').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection
