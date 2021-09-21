@extends('user.master')
@section('page_title')
{{ $product->product_name_en }}
@endsection

@section('user.conent')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li><a href="#">Clothing</a></li>
                <li class='active'>Floral Print Buttoned</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product'>
            <div class='col-12'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">

                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-galler">

                                <div id="prod-details-main-img">

                                    <div class="single-product-gallery-item">
                                        <a data-lightbox="" data-title="Gallery">
                                            <img class="img-responsive" alt="main image"
                                                src="{{ asset($product->product_thumbnail) }}"
                                                data-echo="{{ asset($product->product_thumbnail) }}" id="img_main" />
                                        </a>
                                    </div><!-- /.single-product-gallery-item -->


                                </div><!-- /.single-product-slider -->


                                <div class="single-product-gallery-thumbs gallery-thumbs">

                                    <div id="owl-single-product-thumbnails">
                                        <div class="item">

                                            <img class="img-responsive" alt=""
                                                src="{{ asset($product->product_thumbnail) }}"
                                                data-echo="{{ asset($product->product_thumbnail) }}"
                                                name="image-gallery"
                                                data-rel="{{ asset($product->product_thumbnail) }}" />
                                        </div>
                                        @foreach ($product['images'] as $image)
                                        <div class="item">

                                            <img class="img-responsive" alt="" src="{{ asset($image->image_loc) }}"
                                                data-echo="{{ asset($image->image_loc) }}" name="image-gallery"
                                                data-rel="{{ asset($image->image_loc) }}" />
                                        </div>
                                        @endforeach
                                    </div><!-- /#owl-single-product-thumbnails -->



                                </div><!-- /.gallery-thumbs -->

                            </div><!-- /.single-product-gallery -->
                        </div><!-- /.gallery-holder -->
                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                <h1 class="name">{{ $product->product_name_en }}</h1>

                                <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="rating rateit-small"></div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="reviews">
                                                <a href="#" class="lnk">(13 Reviews)</a>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.rating-reviews -->

                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">Availability :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <div class="stock-box">
                                                @if ($product->quantity >0)
                                                <strong class="value" style="color: limegreen">In Stock</strong>
                                                @else
                                                <strong class="value">Out of Stock</strong>
                                                @endif
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.stock-container -->
                                <div class="description-container m-t-20">
                                    {{ $product->short_desc_en }}
                                </div><!-- /.description-container -->

                                <div class="price-container info-container m-t-20">
                                    <div class="row">


                                        <div class="col-sm-6">
                                            <div class="price-box">
                                                <span class="price">৳ {{ $product->product_discount_price }}</span>
                                                @if($product->product_actual_price>$product->product_discount_price)
                                                <span class="price-strike">৳{{ $product->product_actual_price }}
                                                </span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="favorite-button m-t-10">
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                    title="Wishlist" href="#">
                                                    <i class="fa fa-heart"></i>
                                                </a>

                                            </div>
                                        </div>

                                    </div><!-- /.row -->
                                </div><!-- /.price-container -->

                                <div class="row" style="margin-top: 2vh">
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label class="info-title control-label">Select Size
                                                <span>*</span></label>
                                            <select class="form-control unicase-form-control"
                                                aria-label=".form-select-lg example">
                                                <option selected disabled>Select a Size</option>
                                                @foreach ($product_size_en as $item)
                                                <option value="{{ $item}}">
                                                    {{ $item}}</option>
                                                @endforeach
                                            </select>

                                        </div>


                                    </div>
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label class="info-title control-label">Select Color
                                                <span>*</span></label>
                                            <select class="form-control unicase-form-control"
                                                aria-label=".form-select-lg example">
                                                <option selected disabled>Select a Color</option>
                                                @foreach ($product_color_en as $item)
                                                <option value="{{ $item}}">
                                                    {{ $item}}</option>
                                                @endforeach
                                            </select>

                                        </div>



                                    </div>



                                </div><!-- /.row -->

                                <div class="quantity-container info-container">
                                    <div class="row">

                                        <div class="col-sm-2">
                                            <span class="label">Qty :</span>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="cart-quantity">
                                                <div class="quant-input">
                                                    <div class="arrows">
                                                        <div class="arrow plus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-asc"></i></span>
                                                        </div>
                                                        <div class="arrow minus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-desc"></i></span>
                                                        </div>
                                                    </div>
                                                    <input type="text" value="1">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-7">
                                            <a href="#" class="btn btn-primary"><i
                                                    class="fa fa-shopping-cart inner-right-vs"></i> ADD TO
                                                CART</a>
                                        </div>


                                    </div><!-- /.row -->
                                </div><!-- /.quantity-container -->






                            </div><!-- /.product-info -->
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
                </div>

                <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                            </ul><!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-9">

                            <div class="tab-content">

                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        <p class="text">{{ $product->long_desc_en }}</p>
                                    </div>
                                </div><!-- /.tab-pane -->
                                <div id="review" class="tab-pane">
                                    <div class="product-tab">

                                        <div class="product-reviews">
                                            <h4 class="title">Customer Reviews</h4>

                                            <div class="reviews">
                                                <div class="review">
                                                    <div class="review-title"><span class="summary">We love this
                                                            product</span><span class="date"><i
                                                                class="fa fa-calendar"></i><span>1 days
                                                                ago</span></span></div>
                                                    <div class="text">"Lorem ipsum dolor sit amet, consectetur
                                                        adipiscing elit.Aliquam suscipit."</div>
                                                </div>

                                            </div><!-- /.reviews -->
                                        </div><!-- /.product-reviews -->



                                        <div class="product-add-review">
                                            <h4 class="title">Write your own review</h4>
                                            <div class="review-table">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th class="cell-label">&nbsp;</th>
                                                                <th>1 star</th>
                                                                <th>2 stars</th>
                                                                <th>3 stars</th>
                                                                <th>4 stars</th>
                                                                <th>5 stars</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="cell-label">Rate</td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                        value="5"></td>
                                                            </tr>

                                                        </tbody>
                                                    </table><!-- /.table .table-bordered -->
                                                </div><!-- /.table-responsive -->
                                            </div><!-- /.review-table -->

                                            <div class="review-form">
                                                <div class="form-container">
                                                    <form role="form" class="cnt-form">

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputName">Your Name
                                                                        <span class="astk">*</span></label>
                                                                    <input type="text" class="form-control txt"
                                                                        id="exampleInputName" placeholder="">
                                                                </div><!-- /.form-group -->
                                                                <div class="form-group">
                                                                    <label for="exampleInputSummary">Summary
                                                                        <span class="astk">*</span></label>
                                                                    <input type="text" class="form-control txt"
                                                                        id="exampleInputSummary" placeholder="">
                                                                </div><!-- /.form-group -->
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputReview">Review <span
                                                                            class="astk">*</span></label>
                                                                    <textarea class="form-control txt txt-review"
                                                                        id="exampleInputReview" rows="4"
                                                                        placeholder=""></textarea>
                                                                </div><!-- /.form-group -->
                                                            </div>
                                                        </div><!-- /.row -->

                                                        <div class="action text-right">
                                                            <button class="btn btn-primary btn-upper">SUBMIT
                                                                REVIEW</button>
                                                        </div><!-- /.action -->

                                                    </form><!-- /.cnt-form -->
                                                </div><!-- /.form-container -->
                                            </div><!-- /.review-form -->

                                        </div><!-- /.product-add-review -->

                                    </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.product-tabs -->

                <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">Related products</h3>
                    <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                        @foreach ($related_products as $item)
                        <div class="item item-carousel">
                            @php $amt =
                            $item->product_actual_price
                            -
                            $item->product_discount_price;
                            $dscnt =
                            ($amt/$item->product_actual_price)*100;
                            @endphp
                            <div class="products">

                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="{{ route('single-product', $item->product_slug_en) }}"><img
                                                    src="{{ asset($item->product_thumbnail) }}" alt=""></a>
                                        </div><!-- /.image -->

                                        <div>@if ($dscnt>0)
                                            <div class="tag hot">
                                                <span>{{round($dscnt)}}%</span>
                                            </div>

                                            @endif</div>
                                    </div><!-- /.product-image -->


                                    <div class="product-info text-left">
                                        <h3 class="name"><a
                                                href="{{ route('single-product', $item->product_slug_en) }}">{{ $item->product_name_en }}</a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>

                                        <div class="product-price">
                                            <span class="price"> ৳{{ $item->product_discount_price}} </span>
                                            @if($item->product_actual_price>$item->product_discount_price)
                                            <span
                                                class="price-before-discount ">৳{{ $item->product_actual_price}}</span>
                                            @endif

                                        </div><!-- /.product-price -->

                                    </div><!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown"
                                                        type="button">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add
                                                        to cart</button>

                                                </li>



                                                <li class="lnk">
                                                    <a class="add-to-cart" href="detail.html" title="Compare">
                                                        <i class="fa fa-signal"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- /.action -->
                                    </div><!-- /.cart -->
                                </div><!-- /.product -->

                            </div><!-- /.products -->
                        </div><!-- /.item -->
                        @endforeach
                    </div><!-- /.home-owl-carousel -->
                </section><!-- /.section -->
                <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

            </div><!-- /.col -->
            <div class="clearfix"></div>
        </div><!-- /.row -->

    </div><!-- /.container -->
</div><!-- /.body-content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("img[name = 'image-gallery']").click(function(e){
                var imgUrl = $(this).data('rel');
                $('#img_main').attr("src", imgUrl);
        });
    });
</script>
@endsection
