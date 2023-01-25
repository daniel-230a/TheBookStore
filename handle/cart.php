<?php

session_start();
include_once "db.php";

if(isset($_SESSION['user_id'])){

	if(isset($_POST['book_id']) && isset($_POST['quantity'])){

		addToCart($_POST['book_id'], $_POST['quantity']);

	} else if(isset($_POST['get_cart'])){

		getCart();

	} else if(isset($_POST['display_cart'])){

		displayCart();
		
	} else if(isset($_POST['empty_cart'])){

		emptyCart();

	} 

} 

 
function displayCart() {
	global $db;

	$cart_array = getCart();
	$total_price = 0;

	if (!empty($cart_array)) {
		
		echo '
			<table class="table" style="font-size: 1.2rem; background: white;">
				<thead>
					<tr>
						<th scope="col">Book</th>
						<th scope="col">Quantity</th>
						<th scope="col">Price</th>
					</tr>
				</thead>
				<tbody>';

				foreach ($cart_array as $cart_array_item){	

					$book_info = $db->prepare("SELECT * FROM book WHERE book_id= :book_id");
					$book_info->bindParam(':book_id', $cart_array_item[0]);
					$book_info->execute();

					if ($book_info->rowCount() > 0) {    

						$book = $book_info->fetch(PDO::FETCH_OBJ);

						$book_price = $book->price * $cart_array_item[1];

						$total_price += $book_price;

						echo '<tr>
								<td><img class="img-responsive" style="width: 10rem;"src="'.$book->image.'"></td>
								<td>'.$cart_array_item[1].'</td>
								<td>£'.number_format($book_price, 2).'</td>
							  </tr>';						

					}

				}
				
		echo '<tr>
				<th scope="row">Total</td>
				<td></td>
				<td><b>£'.number_format($total_price, 2).'</b></td>
				</tr>
				</tbody></table>';	
		echo'<button onClick="orderBooks()" class="btn" style="padding: 1rem !important;">Buy Now</button>';			

	} else {
		echo "
			<h1 style='font-size: 8rem'><i class='bi bi-cart'></i></h1>
			<p>It appears you haven't added any items to your cart</p>
			<h3>
				<span class='badge bg-info'>Your cart is empty</span>
			</h3>";					
	}

}

function getCart() {
	global $db;

	$cart_items=array();

    $cart_contents = $db->prepare("SELECT * FROM cart WHERE account_id= :account_id");
	$cart_contents->bindParam(':account_id', $_SESSION['user_id']);
	$cart_contents->execute();

	$num_cart_items = 0;

	if ($cart_contents->rowCount() > 0) {    
		while ($cart_item = $cart_contents->fetch(PDO::FETCH_OBJ)) {

			$book_info = $db->prepare("SELECT * FROM book WHERE book_id= :book_id");
			$book_info->bindParam(':book_id', $cart_item->book_id);
			$book_info->execute();

			$book = $book_info->fetch(PDO::FETCH_OBJ);

			array_push($cart_items, array($cart_item->book_id, $cart_item->quantity));
			$num_cart_items += $cart_item->quantity;
		}
	}

	echo $num_cart_items;

	return $cart_items;
	
}

function addToCart($book_id, $quantity) {
    global $db;

	$update_cart = updateCart($book_id, $quantity);

	if (!$update_cart) {

		if ($quantity > 0) {
			//echo json_encode($cart_array);
			$cart_item = $db->prepare("INSERT INTO cart(book_id, quantity, account_id) VALUES (:book_id, :quantity, :account_id)");
			$cart_item->bindParam(':book_id', $book_id);
			$cart_item->bindParam(':quantity',  $quantity);
			$cart_item->bindParam(':account_id', $_SESSION['user_id']);

			//order books
			if ($cart_item->execute()) {
				//$_SESSION["cart"] = [];
				echo "successfully added to cart"; 
				
			} else { 
				echo "Failed to add to cart";
			}	
		} else { 
			echo "Failed to add to cart";
		}

	} 

}

function updateCart($book_id, $quantity) {
    global $db;

	$cart_array = getCart();

	foreach ($cart_array as $cart_array_item){	
		if($cart_array_item[0] == $book_id) {

			$new_quantity = $cart_array_item[1] + $quantity;

			if($new_quantity > 0) {

				$cart_item = $db->prepare("UPDATE cart SET quantity=:quantity WHERE account_id=:account_id AND book_id=:book_id");
				$cart_item->bindParam(':book_id', $book_id);
				$cart_item->bindParam(':quantity', $new_quantity);
				$cart_item->bindParam(':account_id', $_SESSION['user_id']);

				//order books
				if ($cart_item->execute()) {
					//$_SESSION["cart"] = [];
					echo "successfully updated quantity in cart to " . $new_quantity; 
					
				} else { 
					echo "Failed update cart";
				}
				
			} else {
				if (removeCartItem($book_id)) {
					return TRUE;
				}
			}

			return TRUE;
			
		}
	
	} 
	
	return FALSE;

}

function removeCartItem($book_id) {
    global $db;

	//echo json_encode($cart_array);
	$delete_item = $db->prepare("DELETE FROM cart WHERE account_id=:account_id AND book_id=:book_id");
	$delete_item->bindParam(':book_id', $book_id);
	$delete_item->bindParam(':account_id', $_SESSION['user_id']);

	//order books
	if ($delete_item->execute()) {

		echo "removed item from cart"; 
		
	} else { 
		echo "Failed to removed item from cart";
	}

}

function emptyCart() {
    global $db;

	//echo json_encode($cart_array);
	$delete_item = $db->prepare("DELETE FROM cart WHERE account_id=:account_id");
	$delete_item->bindParam(':account_id', $_SESSION['user_id']);

	//order books
	if ($delete_item->execute()) {
		echo '
		<div class="alert alert-success" role="alert">
			Cart cleared
		</div>';
		
	} else { 
		echo "Failed to clear cart";
	}

}

?>