@extends('admin.master')

@section('admin.dash')

<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Manage Shipping Locations</h3>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">

            <div class="col-md-8 col-sm-12">
                @foreach ($divisions as $item)
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Divisions <span class="badge badge-pill badge-success">
                                {{ count($divisions) }} </span></h3>
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
                                                    <th>Districts</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($divisions['districts'] as $item)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{ $item->district }}</td>
                                                    <td class="sorting_1">{{ $item->discount }}%</td>
                                                    <td class="sorting_1">
                                                        {{ Carbon\Carbon::parse($item->validity)->format('D, d F Y')}}
                                                    </td>
                                                    <td>
                                                        @if ($item->validity < Carbon\Carbon::now()) <span href="#">
                                                            <span class="badge badge-pill badge-warning">Expired</span>
                                                            </span>
                                                            @else
                                                            @if($item->status == 1)
                                                            <a href="{{ route('voucher.toggle', $item->id) }}">
                                                                <span
                                                                    class="badge badge-pill badge-success">Active</span></a>
                                                            @else
                                                            <a href="{{ route('voucher.toggle', $item->id) }}">
                                                                <span
                                                                    class="badge badge-pill badge-danger">Inactive</span>
                                                            </a>
                                                            @endif
                                                            @endif



                                                    </td>
                                                    <td><a href="{{ route('voucher.edit', $item->id) }}"
                                                            class="btn btn-info"> <i class="fa fa-pencil"></i>
                                                            Edit</a>
                                                        <a href="{{ route('voucher.delete',$item->id) }}"
                                                            class="btn btn-danger"><i class="fa fa-trash"
                                                                onclick="return confirm('Are you sure you want to delete this item?');">
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
                @endforeach
            </div>


            <!-- /.col -->


            {{-- Add category --}}
            <div class="col-md-4 col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Division</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">

                        <form action="{{ route('locations-division-add') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-12">

                                    <div class="form-group">
                                        <h5>Division Name<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" required=""
                                                data-validation-required-message="This field is required" value="">
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
                                                data-validation-required-message="This field is required" value="">
                                            <div class="help-block"></div>

                                            @error('shipping_charge')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-info mt-5">Add</button>
                                    </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


                <!-- /.box -->
            </div>

        </div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Add District</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">

                <form action="{{ route('locations-division-add') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <h5>Select Division<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="division_id" id="select" required="" class="form-control"
                                        aria-invalid="false" required>

                                        <option value="" selected disabled>Select Division</option>

                                        @foreach ($divisions as $item)
                                        <option value="{{ $item->id }}">{{ $item->division }}</option>
                                        @endforeach

                                    </select>
                                    <div class="help-block"></div>
                                </div>
                                @error('division_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>District Name<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="district_name" class="form-control" required=""
                                        data-validation-required-message="This field is required" value="">
                                    <div class="help-block"></div>

                                    @error('district_name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-info mt-5">Add</button>
                            </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>





@endsection
