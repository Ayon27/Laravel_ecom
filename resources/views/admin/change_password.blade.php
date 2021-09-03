@extends('admin.master')

@section('admin.dash')

<section class="content col-md-12 col-sm-10 col-xl-8" style="margin-top: 4vh">

    <!-- Basic Forms -->
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">Change Password</h4>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('admin.password.update') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Current Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="password" name="current_password" class="form-control" required=""
                                            data-validation-required-message="This field is required" value="">
                                        <div class="help-block"></div>
                                    </div>

                                    @error('current_password')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <h5>New Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="password" name="new_password" class="form-control" required=""
                                            data-validation-required-message="This field is required" value="">
                                        <div class="help-block"></div>
                                    </div>

                                    @error('new_password')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <h5>Confirm Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="password" name="new_password_confirm" class="form-control"
                                            required="" data-validation-required-message="This field is required"
                                            value="">
                                        <div class="help-block"></div>
                                    </div>

                                    @error('new_password_confirm')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-info mt-5">Update</button>
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

@endsection
