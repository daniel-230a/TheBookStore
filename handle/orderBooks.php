<?php

include_once "db.php";
include_once "cart.php";


//order books if logged in and order books are sent
if(isset($_SESSION['user_id'])){

	if(isset($_POST['order_books'])){

		order_books();

	} else {
		echo "No books to order";
	}

} else {
	echo "Failed to order books";
}
 

function order_books() {
 	global $db;

	$cart_array = getCart();
	$total_price = 0;
	$total_quantity = 0;

	if (!empty($cart_array)) {


		$new_order = create_order($_SESSION['user_id'], $total_price, $total_quantity);

		if($new_order[0]) {
			
			foreach ($cart_array as $cart_array_item){	

				$book_info = $db->prepare("SELECT * FROM book WHERE book_id= :book_id");
				$book_info->bindParam(':book_id', $cart_array_item[0]);
				$book_info->execute();
	
				if ($book_info->rowCount() > 0) {    
	
					$book = $book_info->fetch(PDO::FETCH_OBJ);
	
					$book_price = $book->price * $cart_array_item[1];

					$total_price += $book_price;

					$total_quantity += $cart_array_item[1];					

					set_order_items($new_order[1], $cart_array_item[0], $book_price, $cart_array_item[1]);
		
	
				}
				
			}
			

			if(update_order($new_order[1], $_SESSION['user_id'], $total_price, $total_quantity)) {
				echo '
				  <div class="alert alert-success" role="alert">
					<h4 class="alert-heading">Order Completed</h4>
					<p>Total Price: £'.number_format($total_price, 2).'</p>
					<hr>
					<a href="/orders">
						<button class="btn" style="padding: 1rem !important;">View Orders</button>
					</a>
				  </div>';	
				emptyCart();

			} else {
				echo '
				<div class="alert alert-danger" role="alert">
					Something went wrong while ordering books
				</div>';					
			}
			
			
		}	

	} else {
		echo "
			<h3>
				<span class='badge bg-info'>Your cart is empty</span>
			</h3>";					
	}

}

function create_order($account_id, $total_price, $total_quantity) {
	global $db;

	date_default_timezone_set('Europe/London');  
	$order_date = date("Y/m/d h:i:s");
	
	$set_order = $db->prepare("INSERT INTO orders(account_id, date, total_price, total_quantity) VALUES (:account_id, :date, :total_price, :total_quantity)");
	$set_order->bindParam(':account_id', $account_id);
	$set_order->bindParam(':date', $order_date);
	$set_order->bindParam(':total_price', $total_price);
	$set_order->bindParam(':total_quantity', $total_quantity);

	if ($set_order->execute()) {

		return array(TRUE, $db->lastInsertId());
		
	} else { 
		return FALSE;
	}

}


function update_order($order_id, $account_id, $total_price, $total_quantity) {
	global $db;

	$formated_price= number_format($total_price, 2);

	$update_order_price = $db->prepare("UPDATE orders SET total_price=:total_price, total_quantity=:total_quantity WHERE account_id=:account_id AND order_id=:order_id");
	$update_order_price->bindParam(':account_id', $account_id);
	$update_order_price->bindParam(':order_id', $order_id);
	$update_order_price->bindParam(':total_price', $formated_price);
	$update_order_price->bindParam(':total_quantity', $total_quantity);

	if ($update_order_price->execute()) {

		return "price updated";
		
	} else { 
		return FALSE;
	}

}

function set_order_items($order_id, $book_id, $price, $quantity) {
	global $db;

	$set_order_details = $db->prepare("INSERT INTO order_details(order_id, book_id, price, quantity) VALUES (:order_id, :book_id, :price, :quantity)");
	$set_order_details->bindParam(':order_id', $order_id);
	$set_order_details->bindParam(':book_id', $book_id);
	$set_order_details->bindParam(':price', $price);
	$set_order_details->bindParam(':quantity', $quantity);

	//order books
	if ($set_order_details->execute()) {

		return TRUE; 
		
	} else { 

		return FALSE;
	}

}


?>
