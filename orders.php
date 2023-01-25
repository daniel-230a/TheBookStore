<!DOCTYPE html>
<html>
<head>

	<title>Orders</title>
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
			<h1>Orders REST API</h1>
			<p>API: "/handle/orders.php"</p>
			<p>By account_id: "?account_id=" | By order_id: "?order_id="</p>		
			<p></p>								
		</section>
		<section class="content_section">
			<div style="text-align: left;">
				<pre id="order_data">
					<?php include("handle/orders.php"); ?>
				</pre>	
			</div>	
		</section>
	</section>
</body>
<?php include("components/footer.php"); ?>
</div>
</html>