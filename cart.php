<?php
	error_reporting(0);
	session_start();
	session_regenerate_id(true);	
	
	if (!isset($_SESSION['user'])) {
		header("Location: login.php");
	}
			
?>
<!DOCTYPE html>
<html>
<head>

	<title>Cart</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="favicon.ico"/>
	<!-- CSS -->
	<link href="css/admin-login.css" rel="stylesheet">

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<div id="container">
<?php include("components/header.php"); ?>
<body>
	<section id="main_content">
		<section class="content_section">
			<div class="row">		
				<div class="col-md-9 col-lg-10">
					<section class="content_section">
						<h1>Shopping Cart</h1>								
					</section>
					<div id="shopping_cart">Loading...</div>
				</div>
				<div class="col-md-3 col-lg-2">
					<div style="background: white; padding: 12px 10px; border-radius:5px; text-align: left;">
						<div class="row">
							<div class="col-12">
								<a href="/books">
									<button type="button" class="btn btn-secondary">Continue Shopping</button>
								</a>									
							</div>
							<div class="col-12">
								<button onClick="emptyCart()" class="btn"><i class="bi bi-cart-x-fill"></i> Clear Cart</button>
							</div>
						</div>
					</div>	
				</div>
			</div>							
		</section>
	</section>
</body>

<?php include("components/footer.php"); ?>
</div>
</html>