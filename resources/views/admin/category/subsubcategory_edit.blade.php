@extends('admin.master')

@section('admin.dash')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

{{-- Edit subcategory --}}
<section class="content">
    <div class="row justify-content-center">


        <div class="col-md-6 col-sm-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Sub-Subcategory "{{ $subsubcat->subsubcat_name_en }}"</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">

                    <form action="{{ route('sub.subcategory.update') }}" method="POST">
                        @csrf

                        <input type="hidden" value="{{ $subsubcat->id }}" name="subsubcat_id">

                        <div class="row">
                            <div class="col-12">


                                <div class="form-group">
                                    <h5>Select Category<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" id="select" required="" class="form-control"
                                            aria-invalid="false" required>

                                            <option value="{{ $subsubcat ['category'] ['id'] }}" selected>
                                                {{ $subsubcat ['category'] ['category_name_en'] }}
                                            </option>

                                            @foreach ($categories as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == $subsubcat->category_id ? "selected" : "" }}>
                                                {{ $item->category_name_en }}</option>
                                            @endforeach

                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                    @error('category_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Select Subcategory<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" class="form-control">

                                            @foreach ($subcats as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == $subsubcat->subcategory_id ? "selected" : "" }}>
                                                {{ $item->subcat_name_en }}</option>
                                            @endforeach

                                        </select>

                                        <div class="help-block"></div>
                                    </div>
                                    @error('subcategory_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <h5>Sub Subcategory Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subsubcategory_name_en" class="form-control"
                                            required="" data-validation-required-message="This field is required"
                                            value="{{ $subsubcat->subsubcat_name_en }}">
                                        <div class="help-block"></div>

                                        @error('subsubcategory_name_en')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </div>



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
    });
</script>

@endsection
