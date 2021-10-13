@extends('user.master')
@section('page_title')

@endsection
@section('user.conent')


<div class="body-content outer-top-xs" id="top-banner-and-menu" style="position: relative">
    <div class="container">
        <div class="row">
            <!-- ============================================== CONTENT ============================================== -->
            <div class="col-12 homebanner-holder">
                <!-- ========================================== SECTION – HERO ========================================= -->

                <div id="hero" class="" style="">
                    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm" style="height: 60vh">

                        @foreach ($carousels as $carousel)

                        <div class="item"
                            style="background-image: url({{ asset($carousel->carousel_image) }}) ;height:60vh">
                            <div class="container-fluid">
                                <div class="
                                        caption
                                        bg-color
                                        vertical-center
                                        text-left
                                    ">
                                    <div class="big-text fadeInDown-1">
                                        {{ $carousel->title }}
                                    </div>
                                    <div class="excerpt fadeInDown-2 hidden-xs">
                                        <span>{{$carousel->description}}</span>
                                    </div>
                                </div>
                                <!-- /.caption -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                        @endforeach

                        <!-- /.item -->
                    </div>

                    <!-- /.owl-carousel -->
                </div>

                <!-- /.info-boxes -->
                <!-- ============================================== INFO BOXES : END ============================================== -->
                <!-- ============================================== SCROLL TABS ============================================== -->
                <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp" style="margin-top: 5vh">
                    <div class="more-info-tab clearfix">
                        <h3 class="new-product-title pull-left">
                            New Products
                        </h3>
                        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                            <li class="active">
                                <a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a>
                            </li>
                            @foreach ($categories as $category)

                            <li>
                                <a data-transition-type="backSlide" href="#{{ $category->category_slug_en }}"
                                    data-toggle="tab">{{ $category->category_name_en }}</a>
                            </li>
                            @endforeach {{--
                            <li>
                                <a
                                    data-transition-type="backSlide"
                                    href="#laptop"
                                    data-toggle="tab"
                                    >Electronics</a
                                >
                            </li>
                            <li>
                                <a
                                    data-transition-type="backSlide"
                                    href="#apple"
                                    data-toggle="tab"
                                    >Shoes</a
                                >
                            </li>
                            --}}
                        </ul>
                        <!-- /.nav-tabs -->
                    </div>

                    <div class="tab-content outer-top-xs">
                        <div class="tab-pane in active" id="all">
                            <div class="product-slider">
                                <div class="
                                        owl-carousel
                                        home-owl-carousel
                                        custom-carousel
                                        owl-theme
                                    " data-item="5">
                                    @foreach ($products_latest as $product)

                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="{{ url('product/'. $product->product_slug_en) }}"><img
                                                                src="{{ asset($product->product_thumbnail) }}"
                                                                alt="" /></a>
                                                    </div>
                                                    <!-- /.image -->
                                                    @php $amt =
                                                    $product->product_actual_price
                                                    -
                                                    $product->product_discount_price;
                                                    $dscnt =
                                                    ($amt/$product->product_actual_price)*100;
                                                    @endphp
                                                    <div>
                                                        @if ($dscnt>0)
                                                        <div class="tag hot">
                                                            <span>{{
                                                                    round(
                                                                        $dscnt
                                                                    )
                                                                }}%</span>
                                                        </div>
                                                        @else
                                                        <div class="tag new">
                                                            <span>new</span>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="
                                                        product-info
                                                        text-left
                                                    ">
                                                    <h3 class="name">
                                                        <a
                                                            href="{{ url('product/'. $product->product_slug_en) }}">{{ $product->product_name_en }}</a>
                                                    </h3>
                                                    <div class="
                                                            rating
                                                            rateit-small
                                                        "></div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        <span class="price">
                                                            <strong>৳{{ $product->product_discount_price}}
                                                            </strong>
                                                        </span>

                                                        @if($product->product_actual_price>$product->product_discount_price)
                                                        <span class="
                                                                price-before-discount
                                                            ">৳{{ $product->product_actual_price}}</span>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-price -->
                                                </div>
                                                <!-- /.product-info -->
                                                <div class="
                                                        cart
                                                        clearfix
                                                        animate-effect
                                                    ">
                                                    <div class="action">
                                                        <ul class="
                                                                list-unstyled
                                                            ">
                                                            <li class="
                                                                    add-cart-button
                                                                    btn-group
                                                                ">
                                                                <button data-toggle="tooltip" class="
                                                                        btn
                                                                        btn-primary
                                                                        icon
                                                                    " type="button" title="Add Cart">
                                                                    <i class="
                                                                            fa
                                                                            fa-shopping-cart
                                                                        "></i>
                                                                </button>
                                                                <button class="
                                                                        btn
                                                                        btn-primary
                                                                        cart-btn
                                                                    " type="button">
                                                                    Add to cart
                                                                </button>
                                                            </li>
                                                            <li class="
                                                                    lnk
                                                                    wishlist
                                                                ">
                                                                <a data-toggle="tooltip" class="
                                                                        add-to-cart
                                                                    " href="detail.html" title="Wishlist">
                                                                    <i class="
                                                                            icon
                                                                            fa
                                                                            fa-heart
                                                                        "></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->
                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->
                                    @endforeach
                                </div>
                                <!-- /.home-owl-carousel -->
                            </div>
                            <!-- /.product-slider -->
                        </div>
                        <!-- /.tab-pane -->
                        @foreach ($categories as $category)

                        <div class="tab-pane" id="{{ $category->category_slug_en }}">
                            <div class="product-slider">
                                <div class="
                                        owl-carousel
                                        home-owl-carousel
                                        custom-carousel
                                        owl-theme
                                    " data-item="5">
                                    @foreach ($products_latest as $product)
                                    @if($product->category_id == $category->id)

                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="{{ url('product/'. $product->product_slug_en) }}"><img
                                                                src="{{ asset($product->product_thumbnail) }}"
                                                                alt="" /></a>

                                                        @php $amt =
                                                        $product->product_actual_price
                                                        -
                                                        $product->product_discount_price;
                                                        $dscnt =
                                                        ($amt/$product->product_actual_price)*100;
                                                        @endphp

                                                        <div>
                                                            @if ($dscnt>0)
                                                            <div class="tag hot">
                                                                <span>{{
                                                                        round(
                                                                            $dscnt
                                                                        )
                                                                    }}%</span>
                                                            </div>
                                                            @else
                                                            <div class="tag new">
                                                                <span>new</span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- /.image -->
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="
                                                        product-info
                                                        text-left
                                                    ">
                                                    <h3 class="name">
                                                        <a
                                                            href="{{ url('product/'. $product->product_slug_en) }}">{{ $product->product_name_en }}</a>
                                                    </h3>
                                                    <div class="
                                                            rating
                                                            rateit-small
                                                        "></div>
                                                    <div class="description"></div>
                                                    <div class="product-price">
                                                        <span class="price">
                                                            <strong>৳{{ $product->product_discount_price}}
                                                            </strong>
                                                        </span>
                                                        @if($product->product_actual_price>$product->product_discount_price)
                                                        <span
                                                            class="price-before-discount">৳{{ $product->product_actual_price}}</span>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-price -->
                                                </div>
                                                <!-- /.product-info -->
                                                <div class="
                                                        cart
                                                        clearfix
                                                        animate-effect
                                                    ">
                                                    <div class="action">
                                                        <ul class="
                                                                list-unstyled
                                                            ">
                                                            <li class="
                                                                    add-cart-button
                                                                    btn-group
                                                                ">
                                                                <button data-toggle="tooltip" class="
                                                                        btn
                                                                        btn-primary
                                                                        icon
                                                                    " type="button" title="Add Cart">
                                                                    <i class="
                                                                            fa
                                                                            fa-shopping-cart
                                                                        "></i>
                                                                </button>
                                                                <button class="
                                                                        btn
                                                                        btn-primary
                                                                        cart-btn
                                                                    " type="button">
                                                                    Add to cart
                                                                </button>
                                                            </li>
                                                            <li class="
                                                                    lnk
                                                                    wishlist
                                                                ">
                                                                <a data-toggle="tooltip" class="
                                                                        add-to-cart
                                                                    " href="detail.html" title="Wishlist">
                                                                    <i class="
                                                                            icon
                                                                            fa
                                                                            fa-heart
                                                                        "></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->
                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    @endif
                                    <!-- /.item -->
                                    @endforeach
                                </div>
                                <!-- /.home-owl-carousel -->
                            </div>
                            <!-- /.product-slider -->
                        </div>
                        @endforeach
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.scroll-tabs -->
                <!-- ============================================== SCROLL TABS : END ============================================== -->
                <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp" style="margin-top: 5vh">
                    <h3 class="section-title">Featured products</h3>

                    <div class="
                            owl-carousel
                            home-owl-carousel
                            custom-carousel
                            owl-theme
                            outer-top-xs
                        " data-item="5">
                        @foreach ($products_featured as $item)

                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="{{ route('single-product', $item->product_slug_en) }}"><img
                                                    src="{{ asset($item->product_thumbnail) }}" alt="" /></a>
                                        </div>
                                        <!-- /.image -->

                                        <div class="tag hot">
                                            <span>hot</span>
                                        </div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name">
                                            <a
                                                href="{{ route('single-product', $item->product_slug_en) }}">{{ $item->product_name_en }}</a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        @php $amt =
                                        $product->product_actual_price
                                        -
                                        $product->product_discount_price;
                                        $dscnt =
                                        ($amt/$product->product_actual_price)*100;
                                        @endphp
                                        <div class="product-price">
                                            <span class="price"> ৳{{ $item->product_discount_price}} </span>
                                            @if($item->product_actual_price>$item->product_discount_price)
                                            <span
                                                class="price-before-discount ">৳{{ $item->product_actual_price}}</span>
                                            @endif
                                        </div>
                                        <!-- /.product-price -->
                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="
                                                        add-cart-button
                                                        btn-group
                                                    ">
                                                    <button class="
                                                            btn btn-primary
                                                            icon
                                                        " data-toggle="dropdown" type="button">
                                                        <i class="
                                                                fa
                                                                fa-shopping-cart
                                                            "></i>
                                                    </button>
                                                    <button class="
                                                            btn btn-primary
                                                            cart-btn
                                                        " type="button">
                                                        Add to cart
                                                    </button>
                                                </li>
                                                <li class="lnk wishlist">
                                                    <a class="add-to-cart" href="detail.html" title="Wishlist">
                                                        <i class="
                                                                icon
                                                                fa fa-heart
                                                            "></i>
                                                    </a>
                                                </li>
                                                <li class="lnk">
                                                    <a class="add-to-cart" href="detail.html" title="Compare">
                                                        <i class="fa fa-signal" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.action -->
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->
                            </div>
                            <!-- /.products -->
                        </div>
                        @endforeach
                        <!-- /.item -->
                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

                <!-- ============================================== BEST SELLER ============================================== -->

                <div class="best-deal wow fadeInUp outer-bottom-xs" style="margin-top: 5vh">
                    <h3 class="section-title">Best seller</h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="
                                owl-carousel
                                best-seller
                                custom-carousel
                                owl-theme
                                outer-top-xs
                            ">
                            <div class="item">
                                <div class="products best-product">
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src="assets/images/products/p20.jpg" alt="" />
                                                            </a>
                                                        </div>
                                                        <!-- /.image -->
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name">
                                                            <a href="#">Floral Print
                                                                Buttoned</a>
                                                        </h3>
                                                        <div class="
                                                                rating
                                                                rateit-small
                                                            "></div>
                                                        <div class="
                                                                product-price
                                                            ">
                                                            <span class="price">
                                                                $450.99
                                                            </span>
                                                        </div>
                                                        <!-- /.product-price -->
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->
                                    </div>
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src="assets/images/products/p21.jpg" alt="" />
                                                            </a>
                                                        </div>
                                                        <!-- /.image -->
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name">
                                                            <a href="#">Floral Print
                                                                Buttoned</a>
                                                        </h3>
                                                        <div class="
                                                                rating
                                                                rateit-small
                                                            "></div>
                                                        <div class="
                                                                product-price
                                                            ">
                                                            <span class="price">
                                                                $450.99
                                                            </span>
                                                        </div>
                                                        <!-- /.product-price -->
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="products best-product">
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src="assets/images/products/p22.jpg" alt="" />
                                                            </a>
                                                        </div>
                                                        <!-- /.image -->
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name">
                                                            <a href="#">Floral Print
                                                                Buttoned</a>
                                                        </h3>
                                                        <div class="
                                                                rating
                                                                rateit-small
                                                            "></div>
                                                        <div class="
                                                                product-price
                                                            ">
                                                            <span class="price">
                                                                $450.99
                                                            </span>
                                                        </div>
                                                        <!-- /.product-price -->
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->
                                    </div>
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src="assets/images/products/p23.jpg" alt="" />
                                                            </a>
                                                        </div>
                                                        <!-- /.image -->
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name">
                                                            <a href="#">Floral Print
                                                                Buttoned</a>
                                                        </h3>
                                                        <div class="
                                                                rating
                                                                rateit-small
                                                            "></div>
                                                        <div class="
                                                                product-price
                                                            ">
                                                            <span class="price">
                                                                $450.99
                                                            </span>
                                                        </div>
                                                        <!-- /.product-price -->
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="products best-product">
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src="assets/images/products/p24.jpg" alt="" />
                                                            </a>
                                                        </div>
                                                        <!-- /.image -->
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name">
                                                            <a href="#">Floral Print
                                                                Buttoned</a>
                                                        </h3>
                                                        <div class="
                                                                rating
                                                                rateit-small
                                                            "></div>
                                                        <div class="
                                                                product-price
                                                            ">
                                                            <span class="price">
                                                                $450.99
                                                            </span>
                                                        </div>
                                                        <!-- /.product-price -->
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->
                                    </div>
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src="assets/images/products/p25.jpg" alt="" />
                                                            </a>
                                                        </div>
                                                        <!-- /.image -->
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name">
                                                            <a href="#">Floral Print
                                                                Buttoned</a>
                                                        </h3>
                                                        <div class="
                                                                rating
                                                                rateit-small
                                                            "></div>
                                                        <div class="
                                                                product-price
                                                            ">
                                                            <span class="price">
                                                                $450.99
                                                            </span>
                                                        </div>
                                                        <!-- /.product-price -->
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="products best-product">
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src="assets/images/products/p26.jpg" alt="" />
                                                            </a>
                                                        </div>
                                                        <!-- /.image -->
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name">
                                                            <a href="#">Floral Print
                                                                Buttoned</a>
                                                        </h3>
                                                        <div class="
                                                                rating
                                                                rateit-small
                                                            "></div>
                                                        <div class="
                                                                product-price
                                                            ">
                                                            <span class="price">
                                                                $450.99
                                                            </span>
                                                        </div>
                                                        <!-- /.product-price -->
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->
                                    </div>
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src="assets/images/products/p27.jpg" alt="" />
                                                            </a>
                                                        </div>
                                                        <!-- /.image -->
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col2 col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name">
                                                            <a href="#">Floral Print
                                                                Buttoned</a>
                                                        </h3>
                                                        <div class="
                                                                rating
                                                                rateit-small
                                                            "></div>
                                                        <div class="
                                                                product-price
                                                            ">
                                                            <span class="price">
                                                                $450.99
                                                            </span>
                                                        </div>
                                                        <!-- /.product-price -->
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.product-micro-row -->
                                        </div>
                                        <!-- /.product-micro -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== BEST SELLER : END ============================================== -->

                <!-- ============================================== BLOG SLIDER ============================================== -->
                <section class="section latest-blog outer-bottom-vs wow fadeInUp">
                    <h3 class="section-title">latest form blog</h3>
                    <div class="blog-slider-container outer-top-xs">
                        <div class="owl-carousel blog-slider custom-carousel">
                            <div class="item">
                                <div class="blog-post">
                                    <div class="blog-post-image">
                                        <div class="image">
                                            <a href="blog.html"><img src="assets/images/blog-post/post1.jpg"
                                                    alt="" /></a>
                                        </div>
                                    </div>
                                    <!-- /.blog-post-image -->

                                    <div class="blog-post-info text-left">
                                        <h3 class="name">
                                            <a href="#">Voluptatem accusantium
                                                doloremque laudantium</a>
                                        </h3>
                                        <span class="info">By Jone Doe &nbsp;|&nbsp; 21 March
                                            2016
                                        </span>
                                        <p class="text">
                                            Sed quia non numquam eius modi
                                            tempora incidunt ut labore et dolore
                                            magnam aliquam quaerat voluptatem.
                                        </p>
                                        <a href="#" class="lnk btn btn-primary">Read more</a>
                                    </div>
                                    <!-- /.blog-post-info -->
                                </div>
                                <!-- /.blog-post -->
                            </div>
                            <!-- /.item -->

                            <div class="item">
                                <div class="blog-post">
                                    <div class="blog-post-image">
                                        <div class="image">
                                            <a href="blog.html"><img src="assets/images/blog-post/post2.jpg"
                                                    alt="" /></a>
                                        </div>
                                    </div>
                                    <!-- /.blog-post-image -->

                                    <div class="blog-post-info text-left">
                                        <h3 class="name">
                                            <a href="#">Dolorem eum fugiat quo voluptas
                                                nulla pariatur</a>
                                        </h3>
                                        <span class="info">By Saraha Smith &nbsp;|&nbsp; 21
                                            March 2016
                                        </span>
                                        <p class="text">
                                            Sed quia non numquam eius modi
                                            tempora incidunt ut labore et dolore
                                            magnam aliquam quaerat voluptatem.
                                        </p>
                                        <a href="#" class="lnk btn btn-primary">Read more</a>
                                    </div>
                                    <!-- /.blog-post-info -->
                                </div>
                                <!-- /.blog-post -->
                            </div>
                            <!-- /.item -->

                            <!-- /.item -->

                            <div class="item">
                                <div class="blog-post">
                                    <div class="blog-post-image">
                                        <div class="image">
                                            <a href="blog.html"><img src="assets/images/blog-post/post1.jpg"
                                                    alt="" /></a>
                                        </div>
                                    </div>
                                    <!-- /.blog-post-image -->

                                    <div class="blog-post-info text-left">
                                        <h3 class="name">
                                            <a href="#">Dolorem eum fugiat quo voluptas
                                                nulla pariatur</a>
                                        </h3>
                                        <span class="info">By Saraha Smith &nbsp;|&nbsp; 21
                                            March 2016
                                        </span>
                                        <p class="text">
                                            Sed ut perspiciatis unde omnis iste
                                            natus error sit voluptatem
                                            accusantium
                                        </p>
                                        <a href="#" class="lnk btn btn-primary">Read more</a>
                                    </div>
                                    <!-- /.blog-post-info -->
                                </div>
                                <!-- /.blog-post -->
                            </div>
                            <!-- /.item -->

                            <div class="item">
                                <div class="blog-post">
                                    <div class="blog-post-image">
                                        <div class="image">
                                            <a href="blog.html"><img src="assets/images/blog-post/post2.jpg"
                                                    alt="" /></a>
                                        </div>
                                    </div>
                                    <!-- /.blog-post-image -->

                                    <div class="blog-post-info text-left">
                                        <h3 class="name">
                                            <a href="#">Dolorem eum fugiat quo voluptas
                                                nulla pariatur</a>
                                        </h3>
                                        <span class="info">By Saraha Smith &nbsp;|&nbsp; 21
                                            March 2016
                                        </span>
                                        <p class="text">
                                            Sed ut perspiciatis unde omnis iste
                                            natus error sit voluptatem
                                            accusantium
                                        </p>
                                        <a href="#" class="lnk btn btn-primary">Read more</a>
                                    </div>
                                    <!-- /.blog-post-info -->
                                </div>
                                <!-- /.blog-post -->
                            </div>
                            <!-- /.item -->

                            <div class="item">
                                <div class="blog-post">
                                    <div class="blog-post-image">
                                        <div class="image">
                                            <a href="blog.html"><img src="assets/images/blog-post/post1.jpg"
                                                    alt="" /></a>
                                        </div>
                                    </div>
                                    <!-- /.blog-post-image -->

                                    <div class="blog-post-info text-left">
                                        <h3 class="name">
                                            <a href="#">Dolorem eum fugiat quo voluptas
                                                nulla pariatur</a>
                                        </h3>
                                        <span class="info">By Saraha Smith &nbsp;|&nbsp; 21
                                            March 2016
                                        </span>
                                        <p class="text">
                                            Sed ut perspiciatis unde omnis iste
                                            natus error sit voluptatem
                                            accusantium
                                        </p>
                                        <a href="#" class="lnk btn btn-primary">Read more</a>
                                    </div>
                                    <!-- /.blog-post-info -->
                                </div>
                                <!-- /.blog-post -->
                            </div>
                            <!-- /.item -->
                        </div>
                        <!-- /.owl-carousel -->
                    </div>
                    <!-- /.blog-slider-container -->
                </section>
                <!-- /.section -->
                <!-- ============================================== BLOG SLIDER : END ============================================== -->
            </div>
            <!-- /.homebanner-holder -->
            <!-- ============================================== CONTENT : END ============================================== -->
        </div>
        <!-- /.row -->
        <!-- ============================================== SECONDARY CAROUSEL ============================================== -->
        @include('user.layouts.partners')
        <!-- /.logo-slider -->
        <!-- ============================================== SECONDARY CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->
</div>
<!-- /#top-banner-and-menu -->

@endsection
