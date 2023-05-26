
function addToCart(product_id)
{
    var cart = {};
    cart.product_id = product_id;
    $.ajax({
        url: end_point,
        type: "POST",
        data: cart,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (!response.status) {
                openSnackBar(response.message);

            } else {
                openSnackBar('Added to cart');
                getUserCarts();
            }

        }
    });
}
