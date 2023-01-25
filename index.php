<!DOCTYPE html>
<html>
<head>

<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="favicon.ico"/>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<div id="container">
<!-- include header and admin event addition option -->
<?php include('components/admin-controls.php'); ?>
<?php include("components/header.php"); ?>
<body>

	<section id="main_content">
		<section class="main_header">
		
			<!-- main section -->
			<section class="content_section">
				<h1>Welcome To <span class="navbar-brand" style="font-size: 2.5rem !important">The Bookstore</span></h1>
			</section>
			<section class="content_section">
				<h2>Get Started</h2>
				<div class="col-12">
					<a href="/books">
						<button type="button" class="btn" style="padding: 20px 30px !important; width: 50% !important">Click to Browse Books</button>
					</a>				
				</div>						
			</section>
			<?php
				if(!isset($_SESSION['user_id'])) {
					echo '<section class="content_section">
						<div class="col-12">
							<a href="/account/signup">
								<button type="button" class="btn" style="padding: 20px 30px !important; width: 50% !important">Register to order books</button>
							</a>				
						</div>						
					</section>';
				}
			?>
		</section>
	</section>
</body>
<!-- include footer -->
<?php include("components/footer.php"); ?>
</div>

</html>
