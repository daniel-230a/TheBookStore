<!DOCTYPE html>
<html>
<head>

	<title>Books</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="favicon.ico"/>

	<!-- CSS -->
	<link href="css/books.css" rel="stylesheet">
	
	<!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/books.js" type="text/javascript"></script>

</head>

<div id="container">
<?php include('components/admin-controls.php'); ?>
<?php include("components/header.php"); ?>
<body>
	<section id="main_content">
		
			<section class="content_section">
				<h1 style="opacity: 1;">Books</h1>
			</section>
			
			<section class="content_section">	
				<div class="row">
					<div class="col-md-3 col-lg-2">
						<div style="background: white; padding: 12px 10px; border-radius:5px; text-align: left;">
							<div class="row">
								<div class="col-12">
									<span>Category:</span>
									<div class="dropdown">
										<button type="button" onClick="showCategory()" class="btn dropdown-toggle dropdown-toggle-split" id="categoryDropDown" data-bs-toggle="dropdown" aria-expanded="false">
											<span class="sr-only">Select</span>
										</button>
										<ul class="dropdown-menu" aria-labelledby="categoryDropDown">
											<span style="padding:5px;">No categories available</span>
										</ul>
									</div>
								</div>
								<div class="col-12">
									<span>Topic:</span>
									<div class="dropdown">
										<button class="btn dropdown-toggle dropdown-toggle-split" type="button" id="subCategoryDropDown"  data-bs-toggle="dropdown" aria-expanded="false">
											<span class="sr-only">Select</span>
										</button>
										<ul class="dropdown-menu" aria-labelledby="subCategoryDropDown">
											<span style="padding:5px;">Select a Category</span>
										</ul>
									</div>
								</div>
							</div>
						</div>	
					</div>	
					<div class="col-md-9 col-lg-10">	
						<div class="row row-cols-2 row-cols-md-3 row-cols-lg-6" id="books_view" style="margin: 10px 0 "></div>	
					</div>		
				</div>
			</section>
			

	</section>



</body>

<?php include("components/footer.php"); ?>
</div>

</html>
