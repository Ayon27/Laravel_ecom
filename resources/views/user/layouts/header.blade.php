<header class="header-style-1" style="background: #071621">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
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
                        <li><a href="{{ route('register') }}"><i class="icon fa fa-lock"></i> <strong
                                    style="color: white"> Register</strong></a></li>
                        @endauth

                    </ul>

                    <!-- /.list-unstyled -->
                </div>

                <div class="cnt-block">
                    <ul class="list-styled list-inline">
                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown"
                                data-toggle="dropdown"><span class="value">Language</a>
                            </span><b class="caret"></b></a>

                            <ul class="dropdown-menu">
                                <li name="English" style="margin-top: 1vh;}"><a href="{{ route('lang.en') }}">
                                        <h5> &nbsp;
                                            English</h5>
                                    </a>
                                </li>

                                <li name="Bengali" style="margin-top: 1vh"><a href="{{ route('lang.bn') }}">
                                        <h5>&nbsp;
                                            বাংলা</h5>
                                    </a></li>

                            </ul>
                        </li>


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
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
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

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form>
                            <div class="control-group">
                                <input class="search-field" placeholder="Search here..." />
                                <a class="search-button" href="#"></a>
                            </div>
                        </form>
                    </div>
                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart"
                            data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                                <div class="basket-item-count"><span class="count">2</span></div>
                                <div class="total-price-basket"> <span class="lbl">cart -</span> <span
                                        class="total-price"> <span class="sign">$</span><span
                                            class="value">600.00</span> </span> </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="cart-item product-summary">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="image"> <a href="detail.html"><img src="assets/images/cart.jpg"
                                                        alt=""></a> </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <h3 class="name"><a href="index.php?page-detail">Simple Product</a></h3>
                                            <div class="price">$600.00</div>
                                        </div>
                                        <div class="col-xs-1 action"> <a href="#"><i class="fa fa-trash"></i></a> </div>
                                    </div>
                                </div>
                                <!-- /.cart-item -->
                                <div class="clearfix"></div>
                                <hr>
                                <div class="clearfix cart-total">
                                    <div class="pull-right"> <span class="text">Sub Total :</span><span
                                            class='price'>$600.00</span> </div>
                                    <div class="clearfix"></div>
                                    <a href="checkout.html"
                                        class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
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
    <div class="header-nav animate-dropdown" style="background: #847d7d">
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
                                <li class="active dropdown yamm-fw"> <a href="{{ route('home') }}" data-hover="dropdown"
                                        class="dropdown-toggle" data-toggle="dropdown">Home</a>
                                </li>

                                @php
                                $categories = App\Models\Category::select('id','category_name_en',
                                'category_name_bn')->orderBy('category_name_en', 'ASC')->get();
                                @endphp

                                @foreach ($categories as $category)
                                <li class="dropdown yamm mega-menu"> <a href="home.html" data-hover="dropdown"
                                        class="dropdown-toggle"
                                        data-toggle="dropdown">{{ $category->category_name_en }}</a>
                                    <ul class="dropdown-menu container">
                                        <li>
                                            <div class="yamm-content ">
                                                <div class="row">
                                                    @php
                                                    $subcategories =
                                                    App\Models\Subcategory::select('id','subcat_name_en',
                                                    'subcat_name_bn')->where('category_id',
                                                    $category->id)->orderBy('subcat_name_en', 'ASC')->get();
                                                    @endphp
                                                    @foreach ($subcategories as $subcategory)

                                                    <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                        <h2 class="title">{{ $subcategory->subcat_name_en }}</h2>
                                                        @php
                                                        $subsubcategories =
                                                        App\Models\SubSubCategory::select('id','subsubcat_name_en',
                                                        'subsubcat_name_bn')->where('subcategory_id',
                                                        $subcategory->id)->orderBy('subsubcat_name_en', 'ASC')->get();
                                                        @endphp
                                                        @foreach ($subsubcategories as $subsubcategory)

                                                        <ul class="links">
                                                            <li><a href="#">{{ $subsubcategory->subsubcat_name_en }}</a>
                                                            </li>
                                                        </ul>
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
