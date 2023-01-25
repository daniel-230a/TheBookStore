<?php
	session_start();
	include_once "db.php";

	//Get books from DB
	$book_data = $db->query("SELECT * FROM book");

	if(isset($_POST['category_id'])) {
		
		$book_data = $db->prepare("SELECT * FROM book WHERE category_id= :category_id");
		$book_data->bindParam(':category_id', $_POST['category_id']);
		$book_data->execute();

	} 
	
	if(isset($_POST['sub_category_id'])) {

		$book_data = $db->prepare("SELECT * FROM book WHERE sub_category_id= :sub_category_id");
		$book_data->bindParam(':sub_category_id', $_POST['sub_category_id']);
		$book_data->execute();
		
	}

	if($book_data->rowCount()) {
		while($book = $book_data->fetch(PDO::FETCH_OBJ)) {
		echo '
			<div class="col" style="margin-top:5px">
				<div class="card" data-id="'.$book->book_id.'">
					<img class="img-responsive" src="'.$book->image.'">
					<div class="card-body">
						<h5 class="card-title">'.$book->name.'</h5>
						<p class="card-text">Price: <b>£'.$book->price.'</b></p>';

						if(isset($_SESSION['user_id'])){
							echo '<button onClick="updateCart('.$book->book_id.', 1)" class="btn btn_add_cart"><i class="bi bi-cart-fill"></i> Add to cart</button>';
						}

		echo		'</div>
				</div>	
			</div>';
		}
	} else {
		echo "no books";
	}	

?>
