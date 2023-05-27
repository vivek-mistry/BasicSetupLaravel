
const BASE_URL = $("#base_url").val();

function addToCart(product_id)
{
    var cart = {};
    cart.product_id = product_id;
    let end_point = BASE_URL + '/cart/store';
    $.ajax({
        url: end_point,
        type: "POST",
        data: cart,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            swal(response.message)
            // swal({
            //     title: "Good job!",
            //     text: "You clicked the button!",
            //     icon: "success",
            // });

        }
    });
}

function removeFromCart(cart_id)
{

    let end_point = BASE_URL + '/cart/remove/'+cart_id;
    $.ajax({
        url: end_point,
        type: "GET",
        // data: cart,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            swal(response.message);
            $("#cart_table").load(location.href + " #cart_table");
        }
    });
}
