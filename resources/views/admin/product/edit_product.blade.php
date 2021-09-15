@extends('admin.master')

@section('admin.dash')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Edit Product <strong>"{{ $product->product_name_en }}"</strong> </h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}"><i
                                        class="mdi mdi-home-outline"></i></a></li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
        <div class="box">

            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" id="updtProd" action="{{ route('product.update') }}">
                            @csrf
                            <input type="hidden" name="id" id="" value="{{ $product->id }}">
                            <div class="row">
                                <div class="col-12">

                                    <div class="row">

                                        <div class="col-md-4"> {{-- select category --}}
                                            <div class="form-group">
                                                <h5>Select Category<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" id="select_category" required
                                                        class="form-control">

                                                        <option value="" selected disabled>Select Category</option>

                                                        @foreach ($categories as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $product->category_id ? "selected" : "" }}>
                                                            {{ $item->category_name_en }}
                                                        </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                @error('category_id')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4"> {{-- sekect subcategory --}}
                                            <div class="form-group">
                                                <h5>Select Subcategory <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subcategory_id" id="select_subcategory" required
                                                        class="form-control">
                                                        <option value="" selected disabled>Select Subcategory</option>

                                                        @foreach ($subcategories as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $product->subcategory_id ? "selected" : "" }}>
                                                            {{ $item->subcat_name_en }}
                                                        </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                @error('subcategory_id')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4"> {{-- sekect subsubcategory --}}
                                            <div class="form-group">
                                                <h5>Select Sub-Subcategory <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subsubcategory_id" id="select" required
                                                        class="form-control">
                                                        <option value="" selected disabled>Select Sub-Subcategory
                                                        </option>
                                                        @foreach ($subsubcategories as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $product->subsubcategory_id ? "selected" : "" }}>
                                                            {{ $item->subsubcat_name_en }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('subsubcategory_id')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Name English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_en" class="form-control"
                                                        required
                                                        data-validation-required-message="This field is required"
                                                        value="{{ $product->product_name_en }}">
                                                </div>
                                                @error('product_name_en')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Product Name Bengali <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_bn" class="form-control"
                                                        required
                                                        data-validation-required-message="This field is required"
                                                        value="{{ $product->product_name_bn }}">
                                                </div>
                                                @error('product_name_bn')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Size English <span class="text-danger">*</span></h5>
                                                <div class="bootstrap-tagsinput">
                                                    <input data-role="tagsinput" type="text"
                                                        placeholder="Add Size in English (Comma separated)"
                                                        name="size_en" required
                                                        value=" {{ $product->product_size_en }}"></div>
                                                @error('size_bn')
                                                <p style=" color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Size Bengali<span class="text-danger">*</span></h5>
                                                <div class="bootstrap-tagsinput">
                                                    <input data-role="tagsinput" type="text"
                                                        placeholder="Add Size in Bengali (Comma separated)" required
                                                        name="size_bn" value=" {{ $product->product_size_bn }}">
                                                </div>
                                                @error('size_bn')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Color Bengali<span class="text-danger">*</span></h5>
                                                <div class="bootstrap-tagsinput">
                                                    <input data-role="tagsinput" type="text"
                                                        placeholder="Add Color in Bengali (Comma separated)"
                                                        name="color_en" required
                                                        value=" {{ $product->product_color_en }}">
                                                </div>
                                                @error('color_en')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Color Bengali<span class="text-danger">*</span></h5>
                                                <div class="bootstrap-tagsinput">
                                                    <input data-role="tagsinput" type="text"
                                                        placeholder="Add Color in Bengali (Comma separated)"
                                                        name="color_bn" required
                                                        value=" {{ $product->product_color_bn }}">
                                                </div>
                                                @error('color_bn')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Product Code <span class="text-danger">*</span></h5>
                                                <div class="input-group">
                                                    <input type="text" name="product_code" class="form-control" required
                                                        data-validation-required-message="This field is required"
                                                        value=" {{ $product->product_code }}">

                                                    @error('product_code')
                                                    <p style="color: red"> <small>{{ $message }}</small> </p>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Product Quantity <span class="text-danger">*</span></h5>
                                                <div class="input-group">
                                                    <input type="text" name="product_quantity" class="form-control"
                                                        required
                                                        data-validation-required-message="This field is required"
                                                        value=" {{ $product->quantity }}">

                                                    @error('product_quantity')
                                                    <p style="color: red"> <small>{{ $message }}</small> </p>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Selling Price <span class="text-danger">*</span></h5>
                                                <div class="input-group"> <span class="input-group-addon">BDT</span>
                                                    <input type="text" name="sell_price" class="form-control" required
                                                        data-validation-required-message="This field is required"
                                                        value=" {{ $product->product_actual_price }}">

                                                </div>
                                                @error('sell_price')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Discounted Price <span class="text-danger">*</span></h5>
                                                <div class="input-group"> <span class="input-group-addon">BDT</span>
                                                    <input type="text" name="disc_price" class="form-control" required
                                                        data-validation-required-message="This field is required"
                                                        value=" {{ $product->product_discount_price }}">
                                                </div>
                                                @error('disc_price')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>


                                </div>



                                <div class="col-12">

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Short Description English (1000 characters max)<span
                                                        class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea type="text" name="short_desc_en" id="short_desc"
                                                        class="form-control" required
                                                        rows="5">{{ $product->short_desc_en }}
                                                    </textarea>
                                                </div>
                                                @error('short_desc_en')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Short Description Bengali (1000 characters max)<span
                                                        class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea type="text" name="short_desc_bn" id="short_desc"
                                                        class="form-control" required
                                                        rows="5">{{ $product->short_desc_bn }}
                                                    </textarea>
                                                </div>
                                                @error('short_desc_bn')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Long Description English (3000 characters max)<span
                                                        class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor1" name="long_desc_en" rows="10"
                                                        cols="80">{{ $product->long_desc_en }}"</textarea>
                                                </div>
                                                @error('long_desc_en')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Long Description Bengali (3000 characters max)<span
                                                        class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor2" name="long_desc_bn" rows="10"
                                                        cols="80">{{ $product->long_desc_bn }}</textarea>
                                                </div>
                                                @error('long_desc_bn')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>




                                </div>
                            </div>

                            <div class="row ml-1">
                                <h5>Additional <span class="text-danger"></span></h5>
                            </div>

                            <div class="row mt-5 ml-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="checkbox" id="featured" name="featured" value="1"
                                                {{ $product->featured == 1 ? 'checked' : '' }}>
                                            <label for="featured">Featured</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="checkbox" id="offer" name="offer" value="1"
                                                {{ $product->offer == 1 ? 'checked' : '' }}>
                                            <label for="offer">Special Offer</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="text-xs-right mt-5 float-right">
                                <button type="submit" class="btn btn-rounded btn-info">
                                    Update</button>
                                <a href="" class="btn btn-outline-danger btn-rounded" onclick="delInput()">Reset</a>
                            </div>
                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->

    <section class="content">

        <div class="row">

            <div class="col-12">
                <div class="box bt-3 border-warning">
                    <div class="box-header">
                        <h4 class="box-title">Change <strong>Product Image</strong></h4>
                    </div>

                    <div class="box-body">

                        <form action="{{ route('product.update.image') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="prod_id" id="" value="{{ $product->id }}">
                            <div class="row text-center">
                                @foreach ($prod_imgs as $img)
                                <div class="col-md-3">
                                    <div class="box box-outline-info">
                                        <div class="box-header">
                                            <img src="{{ asset($img->image_loc) }}" alt="product images"
                                                style="width: 200px" id="" name="previewImg">
                                            <div class="box-tools float-right">
                                                <a href="{{ route('product-image-delete', $img->id) }}"
                                                    class="btn btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <i class="fa fa-trash"></i>

                                                </a>
                                            </div>
                                        </div>

                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="multi_img[]" class="form-control-label"><strong> Change
                                                        Image</strong></label>
                                                <input type="file" name="multi_img[{{ $img->id }}]" id="mult_img">
                                                @error('multi_img')
                                                <p style="color: red"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="form-layout-footer">
                                <div class="form-group">
                                    <h5>Add More Images <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="multi_img_new[]" class="form-control" multiple
                                            id="multiImg">
                                    </div>
                                    <div class="row" id="preview-img">

                                    </div>
                                    @error('multi_img_new')
                                    <p style="color: red"> <small>{{ $message }}</small> </p>
                                    @enderror
                                </div>

                                <div class="text-xs-right mt-5 float-right">
                                    <button type="submit" class="btn btn-rounded btn-info">
                                        Update Image</button>
                                    <a href="" class="btn btn-outline-danger btn-rounded" onclick="delInput()">Reset</a>
                                </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>


    </section>


    <section class="content">

        <div class="row">

            <div class="col-12">
                <div class="box bt-3 border-warning">
                    <div class="box-header">
                        <h4 class="box-title">Change <strong>Product Thumbnail</strong></h4>
                    </div>

                    <div class="box-body">

                        <form action="{{ route('product.update.thumbnail') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="old_img" id="" value="{{ $product->product_thumbnail }}">
                            <input type="hidden" name="id" id="" value="{{ $product->id }}">

                            <div class="row text-center">

                                <div class="col-md-3">
                                    <div class="box box-outline-info">
                                        <div class="box-header">
                                            <img src="{{ asset($product->product_thumbnail) }}" alt="product images"
                                                style="width: 200px" id="previewImg">
                                            <div class="box-tools float-right">

                                            </div>
                                        </div>

                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="multi_img[]" class="form-control-label"><strong> Change
                                                        Thumbnail</strong></label>
                                                <input type="file" name="thumbnail" id="mult_img">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-layout-footer">
                                <div class="text-xs-right mt-5 float-right">
                                    <button type="submit" class="btn btn-rounded btn-info">
                                        Update Thumbnail</button>
                                    <a href="" class="btn btn-outline-danger btn-rounded" onclick="delInput()">Reset</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>


    </section>
</div>
<!-- /.content-wrapper -->



<script type="text/javascript">
    $(document).ready(function() {

        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    data: {
                    "_token": "{{ csrf_token() }}",
                },
url: '/admin/sub-subcategory/ajax/'+category_id,
type:"POST",
dataType:"json",
success:function(data) {
$('select[name="subsubcategory_id"]').html('');
var d =$('select[name="subcategory_id"]').empty();
$.each(data, function(key, value){
$('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcat_name_en + '</option>');
});
},
});
} else {
alert('danger');
}
});

$('#select_subcategory').on('change', function(){
        var subcategory_id = $('#select_subcategory').val();
        if(subcategory_id ) {
        $.ajax({
        data: {
        "_token": "{{ csrf_token() }}",
        },
        url: '/admin/sub-subcategory/getsubsubcat/ajax/'+subcategory_id,
        type:"POST",
        dataType:"json",
        success:function(data) {
        var d =$('select[name="subsubcategory_id"]').empty();
        $.each(data, function(key, value){
        $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcat_name_en + '</option>');
        });
        },
        });
        } else {
        alert('danger');
        }
        });
});

function previewThumbnail(input) {
    if(input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#thumbnail').attr('src', e.target.result).width(80).height(80);
        };
        reader.readAsDataURL(input.files[0]);
    }
};

$(document).ready(function(){
    $('#multiImg').on('change', function(){ //on file input change
    if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
    {
    var data = $(this)[0].files; //this file data

    $.each(data, function(index, file){ //loop though each file
    if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
    var fRead = new FileReader(); //new filereader
    fRead.onload = (function(file){ //trigger function on successful read
    return function(e) {
    var img = $('<img />').addClass('thumb').attr('src', e.target.result) .width(200)
    .height(200); //create image element
    $('#preview-img').append(img); //append image to output element
    };
    })(file);
    fRead.readAsDataURL(file); //URL representing the file's data.
    }
    });

    }else{
    alert("Your browser doesn't support File API!"); //if File API is absent
    }
    });
    });
</script>

@endsection
