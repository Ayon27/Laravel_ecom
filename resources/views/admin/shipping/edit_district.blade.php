@extends('admin.master')

@section('admin.dash')

{{-- Edit category --}}
<section class="content">
    <div class="row justify-content-center">


        <div class="col-md-6 col-sm-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update District "{{ $district->district}}"</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <form action="{{ route('locations-district-update') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" id="id" value="{{ $district->id }}">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <h5>Select Division<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="division_id" id="select" required="" class="form-control"
                                            aria-invalid="false" required>

                                            <option value="" selected disabled>Select Division</option>

                                            @foreach ($divisions as $item)
                                            <option value="{{ $item->id }}" {{$item->id == $district->division_id ?
                                                "selected" : "" }}>{{ $item->division }}</option>
                                            @endforeach

                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                    @error('division_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <h5>District<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            value="{{ $district->district}}">
                                        <div class="help-block"></div>

                                        @error('name')
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
