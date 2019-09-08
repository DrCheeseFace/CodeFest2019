<?php




$errors = array(); 


$db = mysqli_connect('localhost', 'root', '', 'logginsite');

  if (!$db)
 {
    die("Connection failed: " . mysqli_connect_error());
  }
echo "Succesfully Connected";

if (isset($_POST['login_user'])) {
  $email =  $_POST['email'];
  $password = $_POST['password'];
}
  if (empty($_POST['email'])) {
  	echo "Email is required";
  }
  if (empty($_POST['password'])) {
  	echo "Password is required";
  }
	session_start();

	if(isset($_POST["email"], $_POST["password"])) 
    {     

        $email = $_POST["email"]; 
        $password = $_POST["password"]; 

        $result1 = mysqli_query($db,"SELECT Email, Password FROM users WHERE Email = '".$email."' AND  Password = '".$password."'");
		$username = mysqli_query($db,"SELECT Username FROM users WHERE Email = '".$email."' AND  Password = '".$password."'");
		$_SESSION['Username'] = $username;
        if(mysqli_num_rows($result1) > 0 )
        { 
            $_SESSION["logged_in"] = true; 
            $_SESSION["email"] = $email; 
			header('Location: index.html');
			$username = mysqli_query($db,"SELECT Username FROM users WHERE Email = '".$email."' AND  Password = '".$password."'");
			$_SESSION["Username"] = $username;
        }
        else
        {
            echo 'The email or password are incorrect!';
			$_SESSION["logged_in"] = false;
        }
	}
	

?>