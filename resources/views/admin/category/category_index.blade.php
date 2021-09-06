@extends('admin.master')

@section('admin.dash')

<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Manage Categories</h3>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">


        <div class="row">


            <div class="col-md-8 col-sm-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Categories</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable"
                                            role="grid" aria-describedby="example1_info">

                                            <thead>
                                                <tr>
                                                    <th>Category Name En</th>
                                                    <th>Category Name Bn</th>
                                                    <th>Category Icon</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($categories as $item)


                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{ $item->category_name_en }}</td>
                                                    <td>{{ $item->category_name_en }}</td>
                                                    <td><img src="{{ asset($item->category_icon) }}" alt=""
                                                            style="max-height: 50px; max-width:50px"></td>
                                                    <td><a href="" class="`btn btn-info">Edit</a>
                                                        <a href="" class="`btn btn-danger">Delete</a>
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


                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>


@endsection
