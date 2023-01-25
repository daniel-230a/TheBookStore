<?php
	//prevent session related errors showing
	error_reporting(0);
	session_start();
	session_regenerate_id(true);		
	
	//check if admin session is set to display event adding button
	if (isset($_SESSION['user'])) {
		echo '<a href="../cart.php" class="add_event_admin_button">
				<i class="bi bi-cart-fill"></i>
				<span class="position-absolute top-0 translate-middle badge rounded-pill bg-danger" style="font-size: 1.2rem;">
					<span class="cart_num_items">0</span>
				</span>
			  </a>';
	}		

  
  
?>


      