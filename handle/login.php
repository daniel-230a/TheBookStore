<?php
	session_start();
    session_regenerate_id(true);
	include_once "db.php";
	
	$phone_num = $_POST['phone_num'];
	$password = $_POST['password'];
	
	$login = $db->prepare("SELECT * FROM account WHERE phone_num= :phone_num");
    //$login = $db->prepare("INSERT INTO tbl_admin (user_name, password) VALUES (:username, :password)");
    $login->bindParam(':phone_num', $phone_num);

    if (empty($phone_num) || empty($password)) {
        echo "All Fields Are Mandatory";
    } else {
        $login->execute();
      	if ($login->rowCount() > 0) {    
          while ($account = $login->fetch()) {
            if (password_verify($password, $account['password'])) {
                $_SESSION["user_id"] = $account['account_id'];
                $_SESSION['user'] = $account['name'];
              	echo "success";
            } else {
                echo "Invalid Credentials";
            }
          }
          
        } else {
        	echo "Invalid Credentials";
        }
    }

?>
