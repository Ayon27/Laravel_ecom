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
            alert(data);
        },
    });
}
