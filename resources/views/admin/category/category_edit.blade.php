@extends('admin.master')

@section('admin.dash')

{{-- Edit category --}}
<section class="content">
    <div class="row justify-content-center">


        <div class="col-md-6 col-sm-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Category "{{ $category->category_name_en }}"</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="category_id" id="id" value="{{ $category->id }}">

                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Category Name (English) <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_name_en" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            value="{{ $category->category_name_en }}">
                                        <div class="help-block"></div>

                                        @error('category_name_en')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </div>



                                </div>

                                <div class="form-group">
                                    <h5>Category Name (Bengali) <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="category_name_bn" class="form-control" required=""
                                            data-validation-required-message="This field is required"
                                            value="{{ $category->category_name_bn }}">
                                        <div class="help-block"></div>
                                    </div>

                                    @error('category_name_bn')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>


                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-info mt-5">Update Category</button>
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
