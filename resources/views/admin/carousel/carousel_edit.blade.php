@extends('admin.master')

@section('admin.dash')

{{-- Edit category --}}
<section class="content">
    <div class="row justify-content-center">


        <div class="col-md-6 col-sm-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Slider</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <form action="{{ route('carousel-update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="carousel_id" id="id" value="{{ $carousel->id }}">

                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <h5>Image Title<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="title" class="form-control"
                                            value="{{ $carousel->title }}">
                                        <div class="help-block"></div>

                                        @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </div>



                                </div>

                                <div class="form-group">
                                    <h5>Image Description <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <textarea type="text" name="description" class="form-control"
                                            rows="5">{{ $carousel->description }}" </textarea>
                                        <div class="help-block"></div>
                                    </div>

                                    @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <h5>Slider Image <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="file" id="image" name="carousel_image" class="form-control"
                                            value="{{ $carousel->carousel_image }}">
                                    </div>
                                    <div id="img_div">
                                        <img id="thumbnail" src="{{ asset($carousel->carousel_image) }}" alt=""
                                            id="image_display">
                                    </div>
                                    @error('carousel_image')
                                    <p style="color: red"> <small>{{ $message }}</small> </p>
                                    @enderror

                                </div>



                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-info mt-5">Update Slide</button>
                                </div>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e){
            $('#img_div').remove();
        });
    });
</script>
@endsection
