@extends('admin.master')

@section('admin.dash')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Add Product</h3>
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
                    <div class="col">
                        <form method="POST" enctype="multipart/form-data" id="addprod"
                            action="{{ route('save-product') }}">
                            @csrf

                            <div class="row">
                                <div class="col-12">

                                    <div class="row">

                                        <div class="col-md-4"> {{-- sekect category --}}
                                            <div class="form-group">
                                                <h5>Select Category<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" id="select_category" required
                                                        class="form-control">

                                                        <option value="" selected disabled>Select Category</option>

                                                        @foreach ($categories as $item)
                                                        <option value="{{ $item->id }}">{{ $item->category_name_en }}
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
                                                <h5>Product Name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_en" class="form-control"
                                                        required
                                                        data-validation-required-message="This field is required">
                                                </div>
                                                @error('product_name_en')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Size<span class="text-danger">*</span></h5>
                                                <div class="bootstrap-tagsinput">
                                                    <input data-role="tagsinput" type="text"
                                                        placeholder="Add Size in English (Comma separated)"
                                                        name="size_en" required></div>
                                                @error('size_en')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>

                                        </div>


                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Color<span class="text-danger">*</span></h5>
                                                <div class="bootstrap-tagsinput">
                                                    <input data-role="tagsinput" type="text"
                                                        placeholder="Add Color in Bengali (Comma separated)"
                                                        name="color_en" required></div>
                                                @error('color_en')
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
                                                        data-validation-required-message="This field is required">

                                                </div>
                                                @error('product_code')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Product Quantity <span class="text-danger">*</span></h5>
                                                <div class="input-group">
                                                    <input type="number" name="product_quantity" class="form-control"
                                                        required
                                                        data-validation-required-message="This field is required">

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
                                                    <input type="number" name="sell_price" class="form-control" required
                                                        data-validation-required-message="This field is required">
                                                    <span class="input-group-addon"></span> </div>
                                                @error('sell_price')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <h5>Discounted Price <span class="text-danger">*</span></h5>
                                                <div class="input-group"> <span class="input-group-addon">BDT</span>
                                                    <input type="number" name="disc_price" class="form-control" required
                                                        data-validation-required-message="This field is required">
                                                    <span class="input-group-addon"></span> </div>
                                                @error('disc_price')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Product Main Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="img" class="form-control" required
                                                        onchange="previewThumbnail(this)"> </div>

                                                <img id="thumbnail" src="" alt="">
                                                @error('img')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Product Secondary Images <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="multi_img[]" class="form-control" required
                                                        multiple id="multiImg">
                                                </div>
                                                <div class="row" id="preview-img">

                                                </div>
                                                @error('multi_img[]')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>
                                </div>



                                <div class="col-12">

                                    <div class="row">

                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <h5>Short Description (1000 characters max)<span
                                                        class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea type="text" name="short_desc_en" id="short_desc"
                                                        class="form-control" required rows="5"> </textarea>
                                                </div>
                                                @error('short_desc_en')
                                                <p style="color: red"> <small>{{ $message }}</small> </p>
                                                @enderror
                                            </div>

                                        </div>




                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Long Description (3000 characters max)<span
                                                        class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor1" name="long_desc_en" rows="20"
                                                        required></textarea>
                                                </div>
                                                @error('long_desc_en')
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
                                            <input type="checkbox" id="featured" value="1" name="featured" value="1">
                                            <label for="featured">Featured</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="controls">
                                            <input type="checkbox" id="offer" value="1" name="offer" value="1">
                                            <label for="offer">Special Offer</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="text-xs-right mt-5">
                                <button type="submit" class="btn btn-rounded btn-info">Add
                                    Product</button>
                                {{-- <a href="" class="btn btn-outline-danger btn-rounded" onclick="delInput()">Clear</a> --}}
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

$('#select_subcategory').on('click', function(){
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
        alert('No Subcategory Found. Please Add Some First!');
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
}
</script>

<script>
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
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element
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
<script>
    function delInput() {
  document.getElementById("addprod").reset();
};



@endsection
