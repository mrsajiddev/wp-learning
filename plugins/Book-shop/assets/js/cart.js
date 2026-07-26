jQuery(document).ready(function ($) {
  console.log("cart.js loaded");
  $(".bs-add-to-cart").on("click", function (e) {
    e.preventDefault();
    var book_id = $(this).data("book-id");
    $.ajax({
      url: bs_cart.ajax_url,
      type: "POST",

      data: {
        action: "bs_add_to_cart",
        book_id: book_id,
      },

success: function (response) {

    $('#bs-cart-message')
        .text(response.data.message)
        .fadeIn();

    if (response.success) {

        $('#bs-cart-count').text(response.data.count);
        setTimeout(function () {
        window.location.href = bs_cart.cart_url;
    }, 1000);

    }

    setTimeout(function () {

        $('#bs-cart-message').fadeOut();

    }, 3000);

}
    });
  });
});
