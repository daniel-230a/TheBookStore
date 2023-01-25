<?php
	session_start();
  session_regenerate_id(true);
	
	
?>
<!DOCTYPE html>
<head>
  <!-- CSS -->
  <link href="../css/header.css" rel="stylesheet" >
  <link href="../css/main.css" rel="stylesheet" >
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
  <!-- JS -->
  <script src="../js/header.js" type="text/javascript"></script>
  <meta charset="utf-8">

  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> 

  <script src="/js/cart.js" type="text/javascript"></script>

  <script src= "https://unpkg.com/react@16/umd/react.production.min.js"></script>
  <script src= "https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
  <script src= "https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">The Bookstore 📚</a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbar" style="">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/"><i class="bi bi-house-fill"></i> Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/books"><i class="bi bi-book-fill"></i> Books</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/orders"><i class="bi bi-cart-check-fill"></i> Orders API</a>
            </li>
            <?php 
            
                
              if (isset($_SESSION['user'])) {
                
                echo '
                      <li class="nav-item">
                        <a class="nav-link" href="/cart">
                          <i class="bi bi-cart-fill">
                            (<b><span class="cart_num_items">0</span></b>)
                          </i> Cart
                        </a>
                      </li>';
                }

            ?>
          </ul>
            <?php
              
              if (isset($_SESSION['user'])) {
                echo '   
                      <h5>
                        <span class="badge bg-info">' 
                          . $_SESSION['user'] .
                        '</span>
                      </h5>
                      <a href="handle/logout.php">
                        <button class="btn">logout</button>
                      </a>';
              } else {
                echo '<div class="row">
                        <div class="col">
                          <a href="/account/login.php">
                            <button class="btn btn-outline-success">Login</button>
                          </a> 
                        </div>
                        <div class="col">
                          <a href="/account/signup.php">
                            <button class="btn">Sign Up</button>
                          </a>
                        </div>
                      </div>';
              }
              
            ?>
        </div>
      </div>
    </nav>
</body>