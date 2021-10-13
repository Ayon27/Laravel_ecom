@extends('user.master')

@section('page_title')
{{ $title }}
@endsection

@section('user.conent')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">


<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-3 sidebar' id="">
                <div class="sidebar-module-container">
                    <div class="sidebar-filter" id="filterButton">
                        <!-- ============================================== Size============================================== -->
                        <div class="sidebar-widget wow fadeInUp">
                            <button data-toggle="collapse" data-target="#sidebarFilter"><i class="fa fa-filter"
                                    aria-hidden="true"></i></button>
                            <strong style="margin-left: 1vh; font-size:large"></strong>
                            <!-- /.sidebar-widget-body -->
                        </div>
                        <!-- /.sidebar-widget -->

                        <!-- /.sidebar-widget -->
                        <div class="home-banner"> </div>
                    </div>
                    <!-- /.sidebar-filter -->
                </div>
                <div id="sidebarFilter">

                    <!-- ===== == TOP NAVIGATION ======= ==== -->
                    <!-- = ==== TOP NAVIGATION : END === ===== -->

                    <div class="sidebar-module-container">
                        <div class="sidebar-filter">
                            <!-- ============================================== Size============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <div class="widget-header">
                                    <h2 class="widget-title" style="margin-bottom: 1vh; font-size:large">Sub Categories
                                    </h2>
                                </div>
                                <div class="sidebar-widget-body">
                                    @foreach ($category['subcategory'] as $item)

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            value="{{ $item->subcat_slug_en }}" id="{{ $item->subcat_slug_en }}">
                                        <label class="form-check-label" for="{{ $item->subcat_slug_en }}"
                                            style="margin-left: 2%">
                                            {{ $item->subcat_name_en }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- /.sidebar-widget-body -->
                            </div>
                            <!-- /.sidebar-widget -->

                            <!-- /.sidebar-widget -->
                            <div class="home-banner"> </div>
                        </div>
                        <!-- /.sidebar-filter -->
                    </div>
                    <!-- /.sidebar-module-container -->

                    <div class="sidebar-module-container">
                        <div class="sidebar-filter">

                            <!-- ============================================== PRICE SILDER============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <div class="widget-header">
                                    <h4 class="widget-title" style="margin-bottom: 1vh; font-size:large">Price Segment
                                    </h4>
                                </div>
                                <div class="sidebar-widget-body m-t-10">
                                    <div class="form-check">
                                        <ul class="list-style-6 margin-50px-bottom text-small">
                                            <li><input class="form-check-input" type="checkbox" value="" id="price1">
                                                <label class="form-check-label" for="price1" style="margin-left: 2%">
                                                    Under 1000 </label> </li>
                                            <li><input class="form-check-input" type="checkbox" value="" id="price2">
                                                <label class="form-check-label" for="price2" style="margin-left: 2%">
                                                    1001 - 2000 </label> </li>
                                            <li><input class="form-check-input" type="checkbox" value="" id="price3">
                                                <label class="form-check-label" for="price3" style="margin-left: 2%">
                                                    2001 - 3000 </label> </li>
                                            <li><input class="form-check-input" type="checkbox" value="" id="price4">
                                                <label class="form-check-label" for="price4" style="margin-left: 2%">
                                                    3001 - 4000 </label> </li>
                                            <li><input class="form-check-input" type="checkbox" value="" id="price5">
                                                <label class="form-check-label" for="price5" style="margin-left: 2%">
                                                    4001 - 5000 </label> </li>
                                            <li><input class="form-check-input" type="checkbox" value="" id="price6">
                                                <label class="form-check-label" for="price6" style="margin-left: 2%">
                                                    Above 5000 </label> </li>
                                        </ul>

                                    </div>

                                </div>
                                <!-- /.sidebar-widget-body -->
                            </div>
                            <!-- /.sidebar-widget -->

                            <div class="home-banner"> </div>
                        </div>
                        <!-- /.sidebar-filter -->
                    </div>

                    <div class="sidebar-module-container">
                        <div class="sidebar-filter">
                            <!-- ============================================== Size============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <div class="widget-header">
                                    <h2 class="widget-title" style="margin-bottom: 1vh; font-size:large">Size</h2>
                                </div>
                                <div class="sidebar-widget-body">
                                    @foreach ($uniq_sizes as $item)

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $item }}"
                                            id="{{ $item }}">
                                        <label class="form-check-label" for="{{ $item }}" style="margin-left: 2%">
                                            {{ $item }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- /.sidebar-widget-body -->
                            </div>
                            <!-- /.sidebar-widget -->
                            <div class="home-banner"> </div>
                        </div>
                        <!-- /.sidebar-filter -->
                    </div>

                    <div class="sidebar-module-container">
                        <div class="sidebar-filter">

                            <!-- ============================================== COLOR============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <div class="widget-header">
                                    <h2 class="widget-title" style="margin-bottom: 1vh; font-size:large">Colors</h2>
                                </div>
                                <div class="sidebar-widget-body">
                                    @foreach ($uniq_colors as $item)

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $item }}"
                                            id="{{ $item }}">
                                        <label class="form-check-label" for="{{ $item }}" style="margin-left: 2%">
                                            {{ $item }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- /.sidebar-widget-body -->
                            </div>
                            <!-- /.sidebar-widget -->
                            <div class="home-banner"> </div>
                        </div>
                        <!-- /.sidebar-filter -->
                    </div>
                </div>
            </div>
            <!-- /.sidebar -->


            <div class='col-md-9' style="margin-bottom: 5vh">
                <!-- == ==== SECTION – HERO === ====== -->
                <div class="clearfix filters-container" style="padding-bottom:2vh;">

                    <div class="row">
                        <div class="col col-sm-6 col-md-2" style="float: left">
                            <h5 style="font-family: Arial, Helvetica, sans-serif; font-size:large; font-weight: bold">
                                {{ $title }}</h5>
                        </div>

                        <!-- /.col -->
                        <div class="col col-sm-12 col-md-6" style="float: right">
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                                Position <span class="caret"></span> </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a href="#">Default</a></li>
                                                <li role="presentation"><a href="#">Price:Low to High</a></li>
                                                <li role="presentation"><a href="#">Price:High to Low</a></li>
                                                <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.fld -->
                                </div>
                                <!-- /.lbl-cnt -->
                            </div>
                            <!-- /.col -->
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Show</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 20
                                                <span class="caret"></span> </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a href="#">40</a></li>
                                                <li role="presentation"><a href="#">60</a></li>
                                                <li role="presentation"><a href="#">80</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.fld -->
                                </div>
                                <!-- /.lbl-cnt -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>


                <div class="clearfix filters-container m-t-10">

                    <!-- /.row -->
                </div>


                <!--    //////////////////// START Product Grid View  ////////////// -->

                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div class="row">
                                    @foreach ($products as $item)

                                    <div class="col-sm-6 col-md-4 wow fadeInUp animated"
                                        style="visibility: visible; animation-name: fadeInUp;">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a
                                                            href="{{ route('single-product', $item->product_slug_en) }}"><img
                                                                src="{{ asset($item->product_thumbnail) }}" alt=""></a>
                                                    </div>
                                                    <!-- /.image -->
                                                    @php $amt =
                                                    $item->product_actual_price
                                                    -
                                                    $item->product_discount_price;
                                                    $dscnt =
                                                    ($amt/$item->product_actual_price)*100;
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

                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="{{ route('single-product', $item->product_slug_en) }}">{{ $item->product_name_en }}</a>
                                                    </h3>
                                                    <div class="rating rateit-small rateit">

                                                    </div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="price">
                                                            <strong>৳{{ $item->product_discount_price}}
                                                            </strong>
                                                        </span>

                                                        @if($item->product_actual_price>$item->product_discount_price)
                                                        <span
                                                            class="price-before-discount">৳{{ $item->product_actual_price}}</span>
                                                        @endif
                                                    </div>
                                                    <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button class="btn btn-primary icon"
                                                                    data-toggle="dropdown" type="button"> <i
                                                                        class="fa fa-shopping-cart"></i> </button>
                                                                <button class="btn btn-primary cart-btn"
                                                                    type="button">Add to cart</button>
                                                            </li>
                                                            <li class="lnk wishlist"> <a class="add-to-cart"
                                                                    href="detail.html" title="Wishlist"> <i
                                                                        class="icon fa fa-heart"></i> </a> </li>
                                                            <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                                    title="Compare"> <i class="fa fa-signal"></i> </a>
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
                                <!-- /.row -->
                            </div>
                            <!-- /.category-product -->

                        </div>
                        <!-- /.tab-pane -->

                        <!--            //////////////////// END Product Grid View  ////////////// -->




                        <!--            //////////////////// Product List View Start ////////////// -->



                        <div class="tab-pane " id="list-container">
                            <div class="category-product">



                                @foreach($products as $product)
                                <div class="category-product-inner wow fadeInUp">
                                    <div class="products">
                                        <div class="product-list product">
                                            <div class="row product-list-row">
                                                <div class="col col-sm-4 col-lg-4">
                                                    <div class="product-image">
                                                        <div class="image"> <img
                                                                src="{{ asset($product->product_thumbnail) }}" alt="">
                                                        </div>
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-sm-8 col-lg-8">
                                                    <div class="product-info">
                                                        <h3 class="name"><a
                                                                href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">

                                                                {{ $product->product_name_en }}</a></h3>
                                                        <div class="rating rateit-small"></div>


                                                        @if ($product->discount_price == NULL)
                                                        <div class="product-price"> <span class="price">
                                                                ${{ $product->selling_price }} </span> </div>
                                                        @else
                                                        <div class="product-price"> <span class="price">
                                                                ${{ $product->discount_price }} </span> <span
                                                                class="price-before-discount">$
                                                                {{ $product->selling_price }}</span> </div>
                                                        @endif

                                                        <!-- /.product-price -->
                                                        <div class="description m-t-10">
                                                            @if(session()->get('language') == 'hindi')
                                                            {{ $product->short_descp_hin }} @else
                                                            {{ $product->short_descp_en }} @endif</div>
                                                        <div class="cart clearfix animate-effect">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <li class="add-cart-button btn-group">
                                                                        <button class="btn btn-primary icon"
                                                                            data-toggle="dropdown" type="button"> <i
                                                                                class="fa fa-shopping-cart"></i>
                                                                        </button>
                                                                        <button class="btn btn-primary cart-btn"
                                                                            type="button">Add
                                                                            to cart</button>
                                                                    </li>
                                                                    <li class="lnk wishlist"> <a class="add-to-cart"
                                                                            href="detail.html" title="Wishlist"> <i
                                                                                class="icon fa fa-heart"></i> </a> </li>
                                                                    <li class="lnk"> <a class="add-to-cart"
                                                                            href="detail.html" title="Compare"> <i
                                                                                class="fa fa-signal"></i> </a> </li>
                                                                </ul>
                                                            </div>
                                                            <!-- /.action -->
                                                        </div>
                                                        <!-- /.cart -->

                                                    </div>
                                                    <!-- /.product-info -->
                                                </div>
                                                <!-- /.col -->
                                            </div>



                                            @php
                                            $amount = $product->product_actual_price - $product->product_discount_price;
                                            $discount = ($amount/$product->product_actual_price) * 100;
                                            @endphp

                                            <!-- /.product-list-row -->




                                        </div>
                                        <!-- /.product-list -->
                                    </div>
                                    <!-- /.products -->
                                </div>
                                <!-- /.category-product-inner -->
                                @endforeach



                                <!--            //////////////////// Product List View END ////////////// -->








                            </div>
                            <!-- /.category-product -->
                        </div>
                        <!-- /.tab-pane #list-container -->
                    </div>
                    <!-- /.tab-content -->

                    <!-- /.filters-container -->

                </div>
                <!-- /.search-result-container -->

            </div>
            <!-- /.col -->
        </div>
    </div>
    <!-- /.container -->

</div>
<!-- /.body-content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $( document ).ready(function() {
        if ($(window).width() < 992) { $('#sidebarFilter').hide();
        $('#filterButton').click(function() {
            $('#sidebarFilter').toggle();
        }) }

    });
</script>
@endsection
