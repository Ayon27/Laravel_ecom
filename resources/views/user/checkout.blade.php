@extends('user.master')
@section('page_title')
{{ "Checkout" }}
@endsection
@section('user.conent')


<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <div class="panel-group checkout-steps" id="accordion">
                            <!-- checkout-step-01  -->
                            <div class="panel panel-default checkout-step-01">

                                <!-- panel-heading -->
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">
                                        <a data-toggle="" class="" data-parent="#accordion">
                                            <span>1</span>Customer Information
                                        </a>
                                    </h4>
                                </div>
                                <!-- panel-heading -->

                                <div id="collapseOne" class="panel-collapse collapse in">

                                    <!-- panel-body  -->
                                    <div class="panel-body">
                                        <div class="row">
                                            <!-- already-registered-login -->
                                            <div class="col-md-12 col-sm-12 already-registered-login">
                                                <form class="" role="form">

                                                    <div class="form-group" style="margin-bottom: 3vh">
                                                        <label class="info-title" for="exampleInputEmail1">
                                                            <strong>Name: </strong>
                                                        </label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1" placeholder=""
                                                            value="{{ $user->name }}">
                                                    </div>

                                                    <div class="form-group" style="margin-bottom: 3vh">
                                                        <label class="info-title" for="exampleInputEmail1">
                                                            <strong>Phone: </strong>
                                                        </label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1" placeholder=""
                                                            value="{{ $user->phone }}">
                                                    </div>

                                                    <div class="form-group" style="margin-bottom: 3vh">
                                                        <label class="info-title" for="exampleInputEmail1">
                                                            <strong>Email: </strong>
                                                        </label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1" placeholder=""
                                                            value="{{ $user->email }}">
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 3vh">
                                                        <label class="info-title" for="exampleInputEmail1">
                                                            <strong>Select Division: </strong>
                                                        </label>
                                                        <select name="division" class="form-control" id="divSelect"
                                                            onchange="loadDist(this.value)">
                                                            <option disabled selected>Select Division
                                                            </option>
                                                            @foreach ($division as $item)
                                                            <option value="{{ $item->id }}">{{ $item->division }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group" style="margin-bottom: 3vh">
                                                        <label class="info-title" for="exampleInputEmail1">
                                                            <strong>Select District: </strong>
                                                        </label>
                                                        <select name="district_select" class="form-control"
                                                            id="exampleFormControlSelect1">.
                                                            <option value="" selected disabled>Select District
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group" style="margin-bottom: 3vh">
                                                        <label class="info-title" for="exampleInputEmail1">
                                                            <strong>Address: </strong>
                                                        </label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1" placeholder="" value="">
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 3vh">
                                                        <label class="info-title" for="exampleInputEmail1">
                                                            <strong>Order Notes: </strong>
                                                        </label>
                                                        <textarea style="resize: vertical;"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1" placeholder="" value=""> </textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- already-registered-login -->

                                        </div>
                                    </div>
                                    <!-- panel-body  -->

                                </div><!-- row -->
                            </div>
                            <!-- checkout-step-01  -->

                        </div><!-- /.checkout-steps -->
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="panel-group checkout-steps" id="accordion">
                                <!-- checkout-step-01  -->
                                <div class="panel panel-default checkout-step-01">

                                    <!-- panel-heading -->
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">
                                            <a data-toggle="" class="" data-parent="#accordion">
                                                <span>2</span>Order Overview
                                            </a>
                                        </h4>
                                    </div>
                                    <!-- panel-heading -->

                                    <div id="collapseOne" class="panel-collapse collapse in">

                                        <!-- panel-body  -->
                                        <div class="panel-body">
                                            <div class="row">
                                                <!-- already-registered-login -->
                                                <div class="col-md-12 col-sm-12 already-registered-login"
                                                    style="overflow: auto">
                                                    <table class="table" style="text-align: left">
                                                        <thead class="thead" style="text-align: center">
                                                            <tr>
                                                                <th scope="col">Product Name</th>
                                                                <th scope="col">Unit Price</th>
                                                                <th scope="col">Quantity</th>
                                                                <th scope="col" style="text-align: center">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($content as $item)
                                                            <tr>
                                                                <td scope="row"><a
                                                                        href="{{ route('single-product', $item->options->slug) }}"
                                                                        style="text-decoration: none; font-size:14px">
                                                                        <img src="{{ asset($item->options->image) }}"
                                                                            alt="" style="max-width:40px; margin:1vh">
                                                                        {{ $item->name }} </a>
                                                                    <p> <strong>Size:
                                                                        </strong>{{ $item->options->size}}
                                                                        <strong>Color:
                                                                        </strong> {{ $item->options->color }}
                                                                    </p>
                                                                </td>
                                                                <td>BDT {{ $item->price }}</td>
                                                                <td>{{ $item->qty }}</td>
                                                                <td>BDT {{ $item->total }}

                                                                </td>

                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tr></tr>
                                                    </table>

                                                </div>
                                                <!-- already-registered-login -->

                                            </div>
                                        </div>
                                        <!-- panel-body  -->

                                    </div><!-- row -->
                                </div>
                                <!-- checkout-step-01  -->

                            </div><!-- /.checkout-steps -->

                            <div class="panel-group checkout-steps" id="accordion">
                                <!-- checkout-step-01  -->
                                <div class="panel panel-default checkout-step-01">

                                    <!-- panel-heading -->
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">
                                            <a data-toggle="" class="" data-parent="#accordion">
                                                <span>3</span>Total
                                            </a>
                                        </h4>
                                    </div>
                                    <!-- panel-heading -->

                                    <div id="totalDiv" class="panel-collapse collapse in">

                                        <!-- panel-body  -->
                                        <div class="panel-body">
                                            <div class="row">
                                                <!-- already-registered-login -->
                                                <div class="col-md-12 col-sm-12 already-registered-login"
                                                    style="overflow: auto">
                                                    <div class="col-md-5 col-xs-12 col-sm-12">
                                                        @if(Session::has('voucher'))
                                                        @php
                                                        $data = session()->get('voucher');
                                                        @endphp
                                                        <input type="text" name="voucherInput" readonly
                                                            class="form-control unicase-form-control text-input"
                                                            id="voucherInput" value="{{ $data['name'] }}"
                                                            placeholder="Voucher">
                                                        <p class="" style="color:tomato" id="voucherMsg">Voucher "{{
                                                            $data['name'] }}" (- {{ $data ['discount'] }}%) applied</p>
                                                        <button style="float: right" type="button"
                                                            class="btn btn-primary" onclick="removeVoucher()">Remove
                                                            Voucher</button>
                                                        @else
                                                        <input type="text" name="voucherInput"
                                                            class="form-control unicase-form-control text-input"
                                                            id="voucherInput" value="" placeholder="Voucher">
                                                        <p class="" style="color:tomato" id="voucherMsg"></p>
                                                        <button style="float: right" type="button"
                                                            class="btn btn-primary" onclick="applyVoucher()">Apply
                                                            Voucher</button>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-5 col-xs-12 col-sm-12">
                                                        <div class=" row m-t-10" style="text-align: right">
                                                            <strong style="font-size:14px;">Sub-Total:</strong>
                                                            <strong style="font-size:14px"><span class="price"
                                                                    style="color: tomato">{{ $subtotal }}
                                                                    ৳</span></strong>
                                                        </div>
                                                        <div class="row m-t-10" style="text-align: right">
                                                            <strong style="font-size:14px">Delivery Charge:</strong>
                                                            @if (Session::has('shipping'))
                                                            @php
                                                            $data = session()->get('shipping');
                                                            @endphp
                                                            <strong style="font-size:14px;color:tomato"><span
                                                                    id="deliveryCharge"
                                                                    class="price">{{ $data['charge'] }}
                                                                </span>৳</strong>
                                                            @else
                                                            <strong style="font-size:14px;color:tomato"><span
                                                                    id="deliveryCharge" class="price">0
                                                                </span>৳</strong>
                                                            @endif
                                                        </div>
                                                        <div class="row m-t-10" style="text-align: right">
                                                            <strong style="font-size:14px">Discount:</strong>
                                                            @if (Session::has('voucher'))
                                                            @php
                                                            $data = session()->get('voucher');
                                                            @endphp
                                                            <strong style="font-size:14px;color:tomato"><span
                                                                    id="voucherName" class="price">
                                                                </span>{{ $data['discountAmt'] }} ৳</strong>
                                                            @else
                                                            <strong style="font-size:14px;color:tomato"><span
                                                                    id="voucherName" class="price">
                                                                </span>0.00 ৳</strong>
                                                            @endif

                                                        </div>
                                                        <div class="row m-t-10" style="text-align: right">
                                                            <strong style="font-size:14px">Total:</strong>
                                                            @if (Session::has('total'))
                                                            @php
                                                            $data = session()->get('total');
                                                            @endphp
                                                            <strong style="font-size:14px;color:tomato"><span
                                                                    id="voucherName" class="price">
                                                                </span>{{ $data['total'] }} ৳</strong>
                                                            @else
                                                            <strong style="font-size:14px;color:tomato"><span id=""
                                                                    class="price">{{ $total }}
                                                                </span>৳</strong>
                                                            @endif


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- already-registered-login -->

                                        </div>
                                    </div>
                                    <!-- panel-body  -->

                                </div><!-- row -->
                            </div>
                            <!-- checkout-step-01  -->
                            <div class="panel-group checkout-steps" id="accordion">
                                <!-- checkout-step-01  -->
                                <div class="panel panel-default checkout-step-01">

                                    <!-- panel-heading -->
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">
                                            <a data-toggle="" class="" data-parent="#accordion">
                                                <span>4</span>Payment
                                            </a>
                                        </h4>
                                    </div>
                                    <!-- panel-heading -->

                                    <div id="totalDiv" class="panel-collapse collapse in">

                                        <!-- panel-body  -->
                                        <div class="panel-body">
                                            <div class="row">
                                                <!-- already-registered-login -->
                                                <div class="col-md-12 col-sm-12 already-registered-login"
                                                    style="overflow: auto">

                                                </div>

                                            </div>
                                            <!-- already-registered-login -->

                                        </div>
                                    </div>
                                    <!-- panel-body  -->

                                </div><!-- row -->
                            </div>
                        </div>
                    </div>
                </div>

        </div><!-- /.row -->
    </div><!-- /.checkout-box -->
    </form>
</div><!-- /.container -->
</div><!-- /.body-content -->
@endsection
