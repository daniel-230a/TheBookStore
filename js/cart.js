$(window).on('load', function() {

    getCart();
    displayCart();
  
});

 updateCart = (book_id, quantity) => {

    $.ajax({
      type : 'POST',
      url : '../handle/cart.php',
      data: {'book_id': book_id, 'quantity': quantity},
      success :   function(response) {

        alert(response)
        getCart();
  
      }
    });	
  
  }
  
  emptyCart = () => {
  
    $.ajax({
      type : 'POST',
      url : '../handle/cart.php',
      data: {'empty_cart': true},
      success :   function(response) {

        getCart();
        displayCart();
  
      }
    });	
  
  }
  
  getCart = () => {
  
    $.ajax({
      type : 'POST',
      url : '../handle/cart.php',
      data: {'get_cart': true},
      success :   function(response) {
        
        $(".cart_num_items").html(response);
  
      }
    });	
  
  }

  displayCart = () => {
  
    $.ajax({
      type : 'POST',
      url : '../handle/cart.php',
      data: {'display_cart': true},
      success :   function(response) {
        
        $("#shopping_cart").html(response);
  
      }
    });	
  
  }

  orderBooks = () => {
  
    $.ajax({
        type : 'POST',
        url : '../handle/cart.php',
        data: {'order_books': true},
        success :  function(response) {

          $("#shopping_cart").html(response);
    
        }
      });	

  }