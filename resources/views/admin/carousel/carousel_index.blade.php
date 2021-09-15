@extends('admin.master')

@section('admin.dash')

<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Manage Slider Images</h3>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">

            <div class="col-md-8 col-sm-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Slider Images <span class="badge badge-pill badge-success">
                                {{ count($carousels) }} </span></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                                <div class="row">
                                    <div class="col-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable"
                                            role="grid" aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th style="width: 25%">Slide Image</th>
                                                    <th style="width: 8%">Title</th>
                                                    <th style="width: 35%">Description</th>
                                                    <th>Status</th>
                                                    <th style="width: 15%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($carousels as $item)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1"><img src="{{ asset($item->carousel_image) }}"
                                                            alt=""></td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>{{ $item->description }}</td>

                                                    @if($item->status == 1)
                                                    <td><a href="{{ route('carousel-toggle', $item->id) }}"><span
                                                                class="badge badge-pill badge-success"><strong>Active</strong>
                                                            </span></a></td>
                                                    @else
                                                    <td><a href="{{ route('carousel-toggle', $item->id) }}"><span
                                                                class="badge badge-pill badge-danger">
                                                                <strong>Inactive</strong></span> </a></td>
                                                    @endif

                                                    <td><a href="{{ route('carousel-edit', $item->id) }}"
                                                            class="btn btn-info"> <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('carousel-delete',$item->id) }}"
                                                            class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this item?');"><i
                                                                class="fa fa-trash">
                                                            </i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- {{ $categories->links() }} --}}
                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->

                <!-- /.box -->
            </div>

            <!-- /.col -->

            {{-- Add carosuel --}}
            <div class="col-md-4 col-sm-12">

                <div class="box ">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title ">Add an image to the slider</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">

                        <form action="{{ route('carousel-add') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-12">

                                    <div class="form-group">
                                        <h5>Image Title<span class="text-danger"></span></h5>
                                        <div class="controls">
                                            <input type="text" name="title" class="form-control">
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
                                                rows="5"> </textarea>
                                            <div class="help-block"></div>
                                        </div>

                                        @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <h5>Slider Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="carousel_image" class="form-control" required
                                                id="carousel_image"> </div>

                                        <img id="thumbnail" src="" alt="">
                                        @error('carousel_image')
                                        <p style="color: red"> <small>{{ $message }}</small> </p>
                                        @enderror
                                    </div>

                                    <div class="row text-center">
                                        <img class="text-center ml-5" id="img_to_show" src="" alt="">
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-info mt-5">Add Slide</button>
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
    <!-- /.content -->

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#carousel_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img_to_show').attr('src', e.target.result).width(426).height(240);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>




@endsection
