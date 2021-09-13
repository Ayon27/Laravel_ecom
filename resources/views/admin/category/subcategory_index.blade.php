@extends('admin.master')

@section('admin.dash')

<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Manage Subcategory</h3>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">

            <div class="col-md-9 col-sm-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Subcategory <span class="badge badge-pill badge-success">
                                {{ count($subcats) }} </span></h3>
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
                                                    <th>Category Name </th>
                                                    <th>Subcategory En</th>
                                                    <th>Subcategory Bn</th>
                                                    <th>Added By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($subcats as $item)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{ $item ['category'] ['category_name_en'] }}
                                                    </td>
                                                    <td>{{ $item->subcat_name_en }}</td>
                                                    <td>{{ $item->subcat_name_bn }}</td>


                                                    <td>{{ $item->admin->name }}</td>

                                                    <td><a href="{{ route('subcategory.edit', $item->id) }}"
                                                            class="btn btn-info"> <i class="fa fa-pencil"></i>
                                                            Edit</a>
                                                        <a href="{{ route('subcategory.soft-delete',$item->id) }}"
                                                            class="btn btn-danger"><i class="fa fa-trash"> </i>
                                                            Delete</a>
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

                {{-- deleted subcategories --}}
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Deleted Subcategory
                            <span class="badge badge-pill badge-danger">
                                {{ count($subcats_deleted) }} </span>
                        </h3>
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
                                                    <th>Category Name </th>
                                                    <th>Subcategory En</th>
                                                    <th>Subcategory Bn</th>
                                                    <th>Added By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($subcats_deleted as $item)


                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{ $item ['category'] ['category_name_en'] }}
                                                    </td>
                                                    <td>{{ $item->subcat_name_en }}</td>

                                                    <td>{{ $item->subcat_name_en }}</td>


                                                    <td>{{ $item->admin->name }}</td>

                                                    <form action="{{ route('subcategory.restore') }}" method="POST">
                                                        @csrf

                                                        <input type="hidden" name="subcategory_restore_id"
                                                            value="{{ $item->id }}">
                                                        <td><button class="btn btn-info">
                                                                <i class="fa fa-undo"></i>
                                                                Restore</button>
                                                    </form>

                                                    <a href="{{ route('subcategory.delete',$item->id) }}"
                                                        class="btn btn-danger" id="deletePermanent"
                                                        onclick="return confirm('Are you sure you want to delete this item? Deleting this will result in removal of its dependant items');"><i
                                                            class=" fa fa-trash">
                                                        </i>
                                                        Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                        </table>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                </div>

                <!-- /.box -->
            </div>

            <!-- /.col -->


            {{-- Add subcategory --}}
            <div class="col-md-3 col-sm-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add a Subcategory</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">

                        <form action="{{ route('subcategory.add') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-12">

                                    <div class="form-group">
                                        <h5>Select Category<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" id="select" required="" class="form-control"
                                                aria-invalid="false" required>

                                                <option value="" selected disabled>Select Category</option>

                                                @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->category_name_en }}</option>
                                                @endforeach

                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                        @error('category_id')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>Subcategory Name (English) <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_name_en" class="form-control"
                                                required="" data-validation-required-message="This field is required"
                                                value="">
                                            <div class="help-block"></div>

                                            @error('subcategory_name_en')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>



                                    </div>

                                    <div class="form-group">
                                        <h5>Subcategory Name (Bengali) <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subcategory_name_bn" class="form-control"
                                                required="" data-validation-required-message="This field is required"
                                                value="">
                                            <div class="help-block"></div>
                                        </div>

                                        @error('subcategory_name_bn')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </div>



                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-info mt-5">Add Subcategory</button>
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





@endsection
