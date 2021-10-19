@extends('admin.master')

@section('admin.dash')

{{-- Edit category --}}
<section class="content">
    <div class="row justify-content-center">


        <div class="col-md-6 col-sm-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Voucher "{{ $voucher->name}}"</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <form action="{{ route('voucher.update') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" id="id" value="{{ $voucher->id }}">

                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Voucher Name<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="voucher_name" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            value="{{ $voucher->name}}">
                                        <div class="help-block"></div>

                                        @error('voucher_name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Discount (%)<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" name="discount" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            value="{{ $voucher->discount}}" min="1" max="100">
                                        <div class="help-block"></div>

                                        @error('discount')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Valid Till<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="validity" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            value="{{ $voucher->validity}}">
                                        <div class="help-block"></div>

                                        @error('validity')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-info mt-5">Update Voucher</button>
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
