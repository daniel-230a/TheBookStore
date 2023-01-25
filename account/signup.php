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

	<title>Sign Up</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="../favicon.ico"/>
	<!-- CSS -->
	<link href="../css/admin-login.css" rel="stylesheet">

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<script type="text/babel">
class SignUpForm extends React.Component {
    constructor(props) {
    super(props);
    this.state = {value: '', email: '', name: ''};

	  this.ValidateName = this.ValidateName.bind(this);
    this.verifyPhoneNum = this.verifyPhoneNum.bind(this);
	  this.ValidateEmail = this.ValidateEmail.bind(this);
    }

    verifyPhoneNum(event) {
	  this.setState({value: event.target.value});
      var textval = this.state.value;
      

		if (textval.length > 0 && (( textval.length < 8) || !/^[0-9]+$/.test(textval))) {
			$('input[name="phone_num"]').css({'border': '1px solid #cc0033', 'background-color': '#fce4e4'});
			ReactDOM.render(
				<span>your phone number has to be a miximum of 9 digits and contain only numbers</span>,
				document.getElementById('form_alert')
			);
		} else{
			$('input').css({'border': 'none', 'background-color': '#ecf0f1'});
			ReactDOM.render(
				<span></span>,
				document.getElementById('form_alert')
			);
		}
      
    }

	ValidateEmail(event){
		this.setState({email: event.target.value});
		var textval = this.state.email;

		var emailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if(textval.length > 0 && (!textval.match(emailformat))){
			$('input[name="email"]').css({'border': '1px solid #cc0033', 'background-color': '#fce4e4'});
			ReactDOM.render(
				<span>The email you have entered is invalid</span>,
				document.getElementById('form_alert')
			);
		}
		else {
			$('input').css({'border': 'none', 'background-color': '#ecf0f1'});
			ReactDOM.render(
				<span></span>,
				document.getElementById('form_alert')
			);
		}
	}

	ValidateName(event){
		this.setState({name: event.target.value});
		var textval = this.state.name;

		if(textval.length > 0 && (!/^[a-zA-Z]+$/.test(textval))){
			$('input[name="name"]').css({'border': '1px solid #cc0033', 'background-color': '#fce4e4'});
			ReactDOM.render(
				<span>Names should be only made up of letters</span>,
				document.getElementById('form_alert')
			);
		}
		else {
			$('input').css({'border': 'none', 'background-color': '#ecf0f1'});
			ReactDOM.render(
				<span></span>,
				document.getElementById('form_alert')
			);
		}
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

        <form class="submit_form" method="POST" action="../handle/signup.php" onSubmit={this.handleSubmit}>
          <div class="input_container">
            <h1>Sign Up</h1>
              <input type="text" placeholder="Name" name="name" value={this.state.name} onChange={this.ValidateName}/> 
              <input type="text" placeholder="Email" name="email" value={this.state.email} onChange={this.ValidateEmail}/>
              <input type="text" placeholder="Phone Number" name="phone_num" value={this.state.value} onChange={this.verifyPhoneNum}/>
              <input type="password" placeholder="Password" name="password"/>
              <input type="password" placeholder="Retype Password" name="re_password"/>
              <button type="submit" name="sign_up" id="submit">Sign Up</button>
            <div id="form_alert"></div>
          </div>
        </form>
      );
    }
  }

  ReactDOM.render(
    <SignUpForm />,
    document.getElementById('sign_up_form')
  );

</script>

<div id="container">
<?php include("../components/header.php"); ?>
<body>
  	<!-- Signup form -->
  <section id="main_content">
    <section class="content_section" id="sign_up_form"></section>
  </section>
</body>

<?php include("../components/footer.php"); ?>
</div>
</html>
