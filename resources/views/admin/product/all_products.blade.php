@extends('admin.master')

@section('admin.dash')

<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Manage Products</h3>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">

            <div class="col-md-12 col-sm-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Products <span class="badge badge-pill badge-success">
                                {{ count($products) }} </span></h3>
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
                                                    <th>#</th>
                                                    <th>Product Code</th>
                                                    <th style="width: 4%">Thumbnail</th>
                                                    <th>Product Name</th>
                                                    <th>Category</th>
                                                    <th style="width: 5%">Subcategory</th>
                                                    <th>Sub-Subcategory</th>
                                                    <th>Price</th>
                                                    <th>Discount Price</th>
                                                    <th>Size</th>
                                                    <th>Color</th>
                                                    <th style="width: 5%">Quantity</th>
                                                    <th>Status</th>
                                                    <th style="width: 20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i = 0;
                                                @endphp
                                                @foreach ($products as $item)
                                                <tr role="row" class="odd">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $item->product_code }}</td>
                                                    <td><img src="{{ asset($item->product_thumbnail) }}" alt=""
                                                            class="img-thumbnail" style="width: 50px"></td>
                                                    <td class="">{{ $item->product_name_en }}</td>
                                                    <td>{{ $item ['category']['category_name_en'] }}</td>
                                                    <td>{{ $item ['subcategory']['subcat_name_en'] }}</td>
                                                    <td>{{ $item ['subsubcategory']['subsubcat_name_en'] }}</td>
                                                    <td>{{ $item->product_actual_price}}</td>
                                                    <td>{{ $item->product_discount_price}}</td>
                                                    <td>{{ $item->product_size_en }}</td>
                                                    <td>{{ $item->product_color_en }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>
                                                        @if($item->status ==1)
                                                        <a href="{{ route('product.active.toggle', $item->id) }}">
                                                            <span
                                                                class="badge badge-pill badge-success">Active</span></a>
                                                        @else
                                                        <a href="{{ route('product.active.toggle', $item->id) }}">
                                                            <span class="badge badge-pill badge-danger">Inactive</span>
                                                        </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('product.edit', $item->id) }}"
                                                            class="btn btn-info"> <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('product.destroy',$item->id) }}"
                                                            class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this item?');"><i
                                                                class="fa fa-trash"> </i>
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

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>





@endsection
