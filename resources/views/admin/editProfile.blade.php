@extends('admin.master')

@section('admin.dash')

<section class="content col-md-12 col-sm-10 col-xl-8" style="margin-top: 4vh">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Edit Admin Profile</h4>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Admin Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            value="{{ $admin->name }}">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Admin Email <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="email" name="email" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            value="{{ $admin->email }}">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <h5>Profile Photo <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="image" class="form-control" id="image">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <h5>Preview</h5>

                                        @if($errors->has('image'))
                                        <div class="text-center error text-danger mb-5">
                                            <h5
                                                style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">
                                                {{ $errors->first('image') }}</h5>
                                        </div>
                                        @endif

                                        <div class="" style="margin-top:">
                                            <img src="{{$admin->profile_photo_path === NULL ?asset($admin->profile_photo_url) : asset($admin->profile_photo_path) }}"
                                                alt="profile photo" style="height: 100px; width: 100px" id="img_to_show"
                                                class="rounded10">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-info">Submit</button>
                                </div>
                    </form>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>

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
