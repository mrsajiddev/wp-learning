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
        $("#bs-cart-message").text(response.data.message).fadeIn();
        if (response.success) {
          $("#bs-cart-count").text(response.data.count);
          setTimeout(function () {
            window.location.href = bs_cart.cart_url;
          }, 1000);
        }
        setTimeout(function () {
          $("#bs-cart-message").fadeOut();
        }, 3000);
      },
    });
  });
     // Quantity Increase (+)
  $(document).on("click", ".qty-plus", function () {
    var button = $(this);
    var cart_item_id = button.closest(".cart-item").data("cart-item-id");
    $.ajax({
      url: bs_cart.ajax_url,
      type: "POST",
      data: {
        action: "bs_update_cart_quantity",
        cart_item_id: cart_item_id,
        operation: "increase",
      },
  success: function (response) {
    if (response.success) {

        // Update quantity input
        button
            .siblings('input')
            .val(response.data.quantity);

        // Update row total
        button
            .closest('.cart-item')
            .find('.cart-item-total')
            .text(response.data.row_total);
            // Update header item count
            $('.cart-header-count').text(response.data.total_items);
            // Update order summary item count
            $('.cart-total-items').text(response.data.total_items);
            // Update subtotal
            $('.cart-subtotal').text(response.data.subtotal);                
            // Update grand total
            $('.cart-grand-total').text(response.data.grand_total);
             // Update tobar
            $('#bs-cart-count').text(response.data.total_items);

    }

}
    });
  });
      // Quantity Decrease (-)
$(document).on('click', '.qty-minus', function () {
    var button = $(this);
    var cart_item_id = button
        .closest('.cart-item')
        .data('cart-item-id');
    $.ajax({
        url: bs_cart.ajax_url,
        type: 'POST',
        data: {
            action: 'bs_update_cart_quantity',
            cart_item_id: cart_item_id,
            operation: 'decrease'
        },
success: function (response) {
    if (response.success) {
        if (response.data.removed) {
           button.closest('.cart-item').remove();
           $('.cart-header-count').text(response.data.total_items);
           $('.cart-total-items').text(response.data.total_items);
           $('.cart-subtotal').text(response.data.subtotal);
           $('.cart-grand-total').text(response.data.grand_total);
           $('#bs-cart-count').text(response.data.total_items);          
           return;
}
        button
            .siblings('input')
            .val(response.data.quantity);

        button
            .closest('.cart-item')
            .find('.cart-item-total')
            .text(response.data.row_total);
            $('.cart-header-count').text(response.data.total_items);
            $('.cart-total-items').text(response.data.total_items);
            $('.cart-subtotal').text(response.data.subtotal);
            $('.cart-grand-total').text(response.data.grand_total);
            $('#bs-cart-count').text(response.data.total_items);           
    }

},

error: function (xhr) {

    console.log('ERROR:', xhr.responseText);

}

    });
});
// Remove Cart Item
$(document).on('click', '.remove-btn', function () {
    var button = $(this);
    var cart_item_id = button
        .closest('.cart-item')
        .data('cart-item-id');
    $.ajax({
        url: bs_cart.ajax_url,
        type: 'POST',
        data: {
            action: 'bs_remove_cart_item',
            cart_item_id: cart_item_id
        },
      success: function (response) {
         if (response.success) {
           // Remove the cart row
           button.closest('.cart-item').remove();
           // Update header item count
           $('.cart-header-count').text(response.data.total_items);
           // Update order summary item count
           $('.cart-total-items').text(response.data.total_items);
           // Update subtotal
           $('.cart-subtotal').text(response.data.subtotal);
           // Update grand total
           $('.cart-grand-total').text(response.data.grand_total);
            // Update topbar cart
           $('#bs-cart-count').text(response.data.total_items);
    }

}
    });
});
});
