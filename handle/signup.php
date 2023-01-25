<?php
  session_start();
  include_once "db.php";

  $name = ucwords(strtolower($_POST['name']));
  $email = $_POST['email'];
  $phone_num = $_POST['phone_num'];
  $password = $_POST['password'];
  $re_password = $_POST['re_password'];
  $password_hash = password_hash($password,  PASSWORD_BCRYPT);

  $phone_num_exist = $db->query("SELECT * FROM account WHERE phone_num='$phone_num'");
  $email_exist = $db->query("SELECT * FROM account WHERE email='$email'");

  if (empty($name) || empty($email) || empty($phone_num) || empty($password)) {

    echo "All fields are mandatory!";

  } else if (!is_numeric($phone_num) || strlen($phone_num) < 9) {

    echo "your phone number has to be a miximum of 9 digits and contain only numbers";

  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    echo "The email you have entered is invalid";

  }else if ($phone_num_exist->rowCount() != 0) {

    echo "This phone number is already linked to another account";

  } else if ($email_exist->rowCount() != 0) {

    echo "This email is already linked to another account";

  } else if ($re_password != $password) {

      echo "Your password doesn't match. Try again";

  } else {

      $register_user = $db->prepare("INSERT INTO account(name, email, phone_num, password) VALUES (:name, :email, :phone_num, :password)");
      $register_user->bindParam(':name', $name);
      $register_user->bindParam(':email', $email);
      $register_user->bindParam(':phone_num', $phone_num);
      $register_user->bindParam(':password', $password_hash); 
      


      if ($register_user->execute()) {
        $_SESSION["user_id"] = $db->lastInsertId();
        $_SESSION["user"] = $name;
        echo "success";
      } else { 

        echo "Account could not be created";

      }

    
  }
?>
