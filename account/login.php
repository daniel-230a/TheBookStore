<?php
	error_reporting(0);
	session_start();
	session_regenerate_id(true);	
		
	if (isset($_SESSION['user'])) {
		header("Location: /");
	}
			
?>
<!DOCTYPE html>
<html>
<head>

	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="../favicon.ico"/>
	<!-- CSS -->
	<link href="../css/admin-login.css" rel="stylesheet">

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<script type="text/babel">
  class LoginForm extends React.Component {
    constructor(props) {
    super(props);
    this.state = {value: ''};

    }

    handleSubmit(event) {
      event.preventDefault();
      $.ajax({
        type : 'POST',
        url : $(".submit_form").attr("action"),
        data : $(".submit_form :input").serializeArray(),
        success :   function(data) {
                if ($.trim(data) === "success") {
                  // redirect to event addition page
                  window.location = "../cart.php";
                } else {
                  //error message and display
                  $('input').css({'border': '1px solid #cc0033', 'background-color': '#fce4e4'});
                  ReactDOM.render(
                    <span>{data}</span>,
                    document.getElementById('form_alert')
                  );
                  //$("#form_alert").html(data);
                }
              }
      });	

    }

    render() {
      return (
        <form class="submit_form" method="POST" action="../handle/login.php" onSubmit={this.handleSubmit}>
          <div class="input_container">
            <h1>Login</h1>
            <input type="text" placeholder="Phone Number" name="phone_num"/>
            <input type="password" placeholder="Password" name="password"/>
            <button type="submit" name="login" id="submit">Login</button>
            <div id="form_alert"></div>
          </div>
        </form>
      );
    }
  }


  ReactDOM.render(
    <LoginForm />,
    document.getElementById('log_in_form')
  );

</script>

<div id="container">
<?php include("../components/header.php"); ?>
<body>
	<!-- Login form -->
  <section id="main_content">
    <section class="content_section" id="log_in_form"></section>
  </section>
</body>

<?php include("../components/footer.php"); ?>
</div>
</html>
