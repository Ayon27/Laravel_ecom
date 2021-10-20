<div class="top-bar animate-dropdown" style="background:#071621;">
    <div class=" container-fluid">
        <div class="header-top-inner">
            <div class="cnt-account">

                <ul class="list">
                    <li><a href="#"><i class="icon fa fa-check"></i>Checkout</a></li>
                    <li><a href="#"><i class="fa fa-industry" aria-hidden="true"></i> Wholesale</a></li>
                    <li><a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i> About</a></li>



                </ul>
            </div>
            <!-- /.cnt-account -->

            <div class="cnt-block">
                <ul class="list-styled list-inline">

                    @auth

                    <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown"
                            data-toggle="dropdown"><span class="value"><i class="icon fa fa-user"></i> My
                                Account</a>
                        </span><b class="caret"></b></a>

                        <ul class="dropdown-menu">
                            <li name="account" style="margin-top: 1vh;}"><a href="{{ route('user.profile') }}">
                                    <h5><i class="icon fa fa-user"></i> &nbsp;
                                        Manage Profile</h5>
                                </a>
                            </li>
                            <li name="account" style="margin-top: 1vh"><a href="#">
                                    <h5><i class="icon fa fa-list"></i> &nbsp;
                                        View Orders</h5>
                                </a></li>

                            <li name="account" style="margin-top: 1vh">
                                <a href="{{ route('user.logout') }}">
                                    <h5><i class="icon fa fa-sign-out"></i> &nbsp;
                                        Sign Out</h5>
                                </a>
                                </form>

                            </li>

                            </form>

                        </ul>
                    </li>
                    @else
                    <li><a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>
                            <strong style="color: white">Login</strong> </a></li> |
                    <li><a href="{{ route('register') }}"><i class="icon fa fa-lock"></i> <strong style="color: white">
                                Register</strong></a></li>
                    @endauth

                </ul>

                <!-- /.list-unstyled -->
            </div>

            <!-- /.cnt-cart -->
            <div class="clearfix"></div>
        </div>
        <!-- /.header-top-inner -->
    </div>
    <!-- /.container -->
</div>

<header class="header-style-1"
    style="background: #071621;position:sticky;top:0;width:100%;z-index:101; margin-bottom: 5vh"">

    <!-- ============================================== TOP MENU ============================================== -->

    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class=" main-header" style="">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                <!-- ============================================================= LOGO ============================================================= -->
                <div class="logo"> <a href="{{ url('/') }}"> <img src="" alt="logo"> </a>
                </div>
                <!-- /.logo -->
                <!-- ============================================================= LOGO : END ============================================================= -->
            </div>
            <!-- /.logo-holder -->

            <div class="col-xs-12 col-sm-12 col-md-5 top-search-holder">
                <!-- /.contact-row -->
                <!-- ============================================================= SEARCH AREA ============================================================= -->
                <div class="search-area">
                    <form>
                        <div class="control-group">
                            <input class="search-field" placeholder="Search" autocomplete="off" />
                            <a class="search-button" href="#"></a>
                        </div>
                    </form>
                </div>
                <!-- /.search-area -->
                <!-- ============================================================= SEARCH AREA : END ============================================================= -->
            </div>
            <!-- /.top-search-holder -->

            <div class="col-xs-12 col-sm-12 col-md-4 animate-dropdown top-cart-row">
                <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart"
                        data-toggle="dropdown">
                        <div class="items-cart-inner" id="cartTopBtn" onclick="toggleView('cartDropdownMenu')">
                            <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                            <div class="basket-item-count"><span class="count" id="cartQuantity">0</span></div>
                            <div class="total-price-basket"> <span class="lbl">cart -</span> <span class="total-price">
                                    <span class="sign"></span><span class="value" id="cartTotal">BDT 0.0</span>
                                </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu" id="cartDropdownMenu" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
                     overflow-x: hidden; overflow-y: auto; max-height: 85vh;">
                        <li>
                            <div id="headerCart">

                            </div>
                            <!-- /.cart-item -->

                            <div class="clearfix cart-total">
                                <div class="pull-right"> <span class="text">Sub Total :</span><span class='price'
                                        id="cartTotal">BDT 0.0</span> </div>
                                <div class="clearfix"></div>
                                <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                                <a href="#" class="btn btn-light btn-block m-t-10"
                                    onclick="toggleView('cartDropdownMenu')" id="closeBtn"
                                    style="margin-bottom: 10vh">Close (X)</a>
                            </div>
                            <!-- /.cart-total-->

                        </li>
                    </ul>
                    <!-- /.dropdown-menu-->
                </div>
                <!-- /.dropdown-cart -->

                <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
            </div>
            <!-- /.top-cart-row -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown" style="background: #847d7d;">
        <div class="container">
            <div class="yamm navbar navbar-default " role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                        class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                            class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw"> <a href="{{ route('home') }}">Home</a>
                                </li>

                                @php
                                $categories =
                                App\Models\Category::select('id','category_name_en',
                                'category_slug_en')->with('subcategory',
                                'subsubcategory')->orderBy('category_name_en',
                                'ASC')->get();
                                @endphp
                                @foreach ($categories as $category)
                                <li class="dropdown yamm mega-menu"> <a
                                        onclick="window.location.href='{{ route('category-all-products', $category->category_slug_en) }}'"
                                        href="{{ route('category-all-products', $category->category_slug_en) }}"
                                        target="__blank" data-hover="dropdown" class="dropdown-toggle"
                                        data-toggle="dropdown">{{ $category->category_name_en }}</a>
                                    <ul class="dropdown-menu container">
                                        <li>
                                            <div class="yamm-content ">
                                                <div class="row">

                                                    @foreach ($category['subcategory'] as $subcategory)

                                                    <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                        <a
                                                            href="{{ route('subcategory-all-products',
                                                            ['catSlug' => $category->category_slug_en, 'subcatSlug' => $subcategory->subcat_slug_en]) }}">
                                                            <h2 class="title">{{ $subcategory->subcat_name_en }}</h2>
                                                        </a>

                                                        @foreach ($category['subsubcategory'] as $subsubcategory)
                                                        @if ($subsubcategory->subcategory_id == $subcategory->id)
                                                        <ul class="links">
                                                            <a
                                                                href="{{ route('subsubcategory-all-products',
                                                            ['catSlug' => $category->category_slug_en,
                                                             'subcatSlug' => $subcategory->subcat_slug_en,
                                                            'subsubcatSlug' => $subsubcategory->subsubcat_slug_en]) }}">
                                                                <li>{{ $subsubcategory->subsubcat_name_en }} </li>
                                                            </a>
                                                        </ul>
                                                        @endif

                                                        @endforeach
                                                    </div>
                                                    @endforeach
                                                    <!-- /.yamm-content -->
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                @endforeach


                                <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown"
                                        data-toggle="dropdown">Wholesale / Bulk</a>
                                </li>
                                <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li>
                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.nav-outer -->
                    </div>
                    <!-- /.navbar-collapse -->

                </div>
                <!-- /.nav-bg-class -->
            </div>
            <!-- /.navbar-default -->
        </div>
        <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>

<script src="{{ asset('js/custom.js') }}"></script>
