@extends('admin.master')

@section('admin.dash')

{{-- Edit category --}}
<section class="content">
    <div class="row justify-content-center">


        <div class="col-md-6 col-sm-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Division "{{ $division->division}}"</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <form action="{{ route('locations-division-update') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" id="id" value="{{ $division->id }}">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <h5>Division Name<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            value="{{ $division->division}}">
                                        <div class="help-block"></div>

                                        @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Shipping Charge<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="shipping_charge" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            value="{{ $division->shipping_charge}}">
                                        <div class="help-block"></div>

                                        @error('shipping_charge')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-info mt-5">Update District</button>
                                </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>

@endsection
