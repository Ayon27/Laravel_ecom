function clearText(id) {
    $("#" + id).text("");
}

function increaseProdCount(max_quantity) {
    var count = $("#productQty").val();

    if (count < max_quantity) {
        ++count;
        $("#productQty").val(count);
    }
}

function decreaseProdCount() {
    var count = $("#productQty").val();

    if (count > 1) {
        --count;
        $("#productQty").val(count);
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
                miniCart(0);
            } else {
                toast.fire({
                    icon: "error",
                    title: "Failed. Something went wrong",
                });
            }
        },
    });
}

function miniCart(userID) {
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

                                    <a href="#"><i class="fa fa-trash"></i></a> </div>
                                </div>

                            </div>
                            </div>
                            <div class="row text-center">
                            <button type="button" class="btn">-</button>
                                        <span id="productCountCart" style="margin-left:1vh; margin-right: 1vh"> ${value.qty}</span>
                                        <button type="button" class="btn">+</button>
                                         </div>
                           <div class="clearfix"></div>
                            <hr></hr>`;
            });

            $("#headerCart").html(cart);
        },
    });
}
