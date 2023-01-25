//form submission ajax request
/*$( document ).on('submit','.submit_form', function(event){
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
						$("#form_alert").empty();
						$("#form_alert").html(data);
					  }
					}
	});	
	
});*/


/*
class LoginForm extends React.Component {
    constructor(props) {
    super(props);
    this.state = {value: '', value2: ''};

      this.verifyPhoneNum = this.verifyPhoneNum.bind(this);
	  this.ValidateEmail = this.ValidateEmail.bind(this);
    }

    verifyPhoneNum(event) {
	  this.setState({value: event.target.value});
      var textval = this.state.value;
      

		if (textval.length > 9 || !/^[0-9]+$/.test(textval)) {
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
		this.setState({value2: event.target.value});
		var textval = this.state.value2;

		var emailformat = /^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3})+$/;
		if(textval.match(emailformat)){
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

	ValidateEmail(event){
		this.setState({value2: event.target.value});
		var textval = this.state.value2;

		var emailformat = /^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3})+$/;
		if(textval.match(emailformat)){
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
              <input type="text" placeholder="Name" name="name"/> 
              <input type="text" placeholder="Email" name="email" value={this.state.value2} onChange={this.ValidateEmail}/>
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
    <LoginForm />,
    document.getElementById('log_in_form')
  );*/