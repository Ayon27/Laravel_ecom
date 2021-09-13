@extends('admin.master')

@section('admin.dash')

{{-- Edit subcategory --}}
<section class="content">
    <div class="row justify-content-center">


        <div class="col-md-6 col-sm-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Subcategory "{{ $subcategory->subcat_name_en }}"</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <form action="{{ route('subcategory.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="subcategory_id" id="id" value="{{ $subcategory->id }}">

                        <div class="form-group">
                            <h5>Select Category<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="category_id" id="select" required="" class="form-control"
                                    aria-invalid="false" required>

                                    <option value="" selected disabled>Select Category</option>

                                    @foreach ($category as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $subcategory->category_id === $item->id ? "selected"  : "" }}>
                                        {{ $item->category_name_en }}</option>
                                    @endforeach

                                </select>
                                <div class="help-block"></div>
                            </div>
                            @error('category_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Subcategory Name (English) <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subcategory_name_en" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            value="{{ $subcategory->subcat_name_en }}">
                                        <div class="help-block"></div>

                                        @error('subcategory_name_en')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </div>



                                </div>

                                <div class="form-group">
                                    <h5>Subcategory Name (Bengali) <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subcategory_name_bn" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            value="{{ $subcategory->subcat_name_bn }}">
                                        <div class="help-block"></div>
                                    </div>

                                    @error('subcategory_name_bn')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>


                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-info mt-5">Update</button>
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
