function clearText(id) {
    $("#" + id).text("");
}

function increaseProdCount(max_quantity, id) {
    var count = $("#" + id).val();

    if (count < max_quantity) {
        count++;
        $("#" + id).val(count);
    }
}

function decreaseProdCount(id) {
    var count = $("#" + id).val();

    if (count > 1) {
        count--;
        $("#" + id).val(count);
    }
}

function initiateCart(productID) {
    var quantity = $("#productQty").val();
    var size = $("#sizeSelect").val();
    var color = $("#colorSelect").val();
    var cartVars = 0;
    !size ? $("#sizeErr").text("Please select a size") : ++cartVars;

    !color ? $("#colorErr").text("Please select a color") : ++cartVars;

    if (cartVars == 2) {
        addToCart(productID, quantity, size, color);
    }
}

function addToCart(productID, quantity, size, color) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            productID: productID,
            size: size,
            color: color,
            quantity: quantity,
        },
        url: "/cart/ajax/add/" + productID,
        success: function (data) {
            const toast = Swal.mixin({
                position: "center",
                showConfirmButton: false,
                timer: 1300,
            });
            if ($.isEmptyObject(data.error)) {
                toast.fire({
                    icon: "success",
                    title: "Successfully added to cart",
                });
                miniCart(0, false);
            } else {
                toast.fire({
                    icon: "error",
                    title: "Failed. Something went wrong",
                });
            }
        },
    });
}

function miniCart(userID, expand = false) {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "/minicart/ajax/load/" + userID,
        success: function (response) {
            $("span[id=cartTotal]").text("BDT " + response.total);
            $("span[id=cartQuantity]").text(response.qty);

            var cart = "";
            $.each(response.cartContent, function (key, value) {
                cart += `<div class="row">
                <div class="cart-item product-summary">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="image"> <a href="detail.html"><img src="/${value.options.image}"
                                                    alt=""></a> </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                                        <div class="price">BDT ${value.price} </div>


                                    </div>

                                    <div class="col-xs-1 action">

                                    <a href="#"  onclick="deleteCartItem('${value.rowId}')"><i class="fa fa-trash"></i></a> </div>
                                </div>

                            </div>
                            </div>
                            <div class="row text-center">
                                <div class="price">Size: ${value.options.size}  </div>
                            </div>
                                      <div class="row text-center">
                                <div class="price">Color: ${value.options.color} </div>
                            </div>
                                                        <div class="row text-center">
                                <button type="button" class="btn"
                                 onclick="updateCartQty('${value.rowId}', 0)">-</button>
                                <input type="text" disabled id="productCountCart" style="margin-left:1vh; margin-right: 1vh; max-width:5vh"
                                 value=" ${value.qty}"></input>
                                <button type="button" class="btn"
                                onclick="updateCartQty('${value.rowId}', 1)">+</button>
                                <p style="color:red" id="qtyErr"></p>

                            </div>
                           <div class="clearfix"></div>
                            <hr></hr>`;
            });

            $("#headerCart").html(cart);
            if (expand) $("#cartDropdownMenu").show();
        },
    });
}

function deleteCartItem(rowId) {
    // alert(rowId);
    $.ajax({
        type: "GET",
        url: "/minicart/ajax/deleteItem/" + rowId,
        dataType: "json",
        success: function (data) {
            miniCart(0, true);
            if (data.redir == "true") {
                window.location.href = "checkout/init";
            }
        },
    });
}

function updateCartQty(rowId, increase) {
    $.ajax({
        type: "GET",
        url: "/minicart/ajax/updateItem/" + rowId,
        dataType: "json",
        data: {
            property: increase,
        },
        success: function (data) {
            console.log(data);
            miniCart(0, true);
            if (data.msg != "successful") $("#qtyErr").text(data.msg);
            else {
                if (data.redir == "true") {
                    window.location.href = "checkout/init";
                }
            }
        },
    });
}

function toggleView(id) {
    $("#" + id).toggle("fast");
}

function loadDist(id) {
    var s = $("#deliveryCharge").empty();
    $.ajax({
        type: "GET",
        url: "/ajax/divison/" + id,
        dataType: "json",
        success: function (data) {
            var d = $('select[name="district_select"]').empty();

            $.each(data.district, function (key, value) {
                $('select[name="district_select"]').append(
                    '<option value="' +
                        value.id +
                        '">' +
                        value.district +
                        "</option>"
                );
            });
            var s1 = $("#deliveryCharge").text(data.shipping.shipping_charge);
            $("#totalDiv").load(window.location.href + " #totalDiv");
        },
    });
}

function applyVoucher() {
    var name = $("#voucherInput").val();
    if (name == "")
        $("#voucherMsg").text("Enter a voucher code if you have any");
    else {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: { name: name },
            url: "/ajax/applyVoucher",
            success: function (data) {
                if (data.status == "failed")
                    $("#voucherMsg").text(data.message);
                else $("#totalDiv").load(window.location.href + " #totalDiv");
            },
        });
    }
}

function removeVoucher() {
    var name = $("#voucherInput").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        data: { name: name },
        url: "/ajax/deleteVoucher",
        success: function (data) {
            $("#totalDiv").load(window.location.href + " #totalDiv");
        },
    });
}
