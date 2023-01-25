//ajax request to retrieve all events on webpage load
$(window).on('load', function() {
	$.ajax({
		type : 'POST',
		url : 'handle/orders.php',
		success :   function(orders) {
			
						$("#order_data").html(orders);
					  
					}
	});	
});

