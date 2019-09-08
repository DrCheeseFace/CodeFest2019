<?php



$username = "";
$email    = "";
$errors = array(); 


$db = mysqli_connect('localhost', 'root', '', 'logginsite');

  if (!$db)
 {
    die("Connection failed: " . mysqli_connect_error());
  }




if (isset($_POST['Sign_Up'])) 
{
  
  $username = $_POST['name'];
  $password = $_POST['password'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $number = $_POST['contact'];
  $email = $_POST['email'];
}
 $ip = $_SERVER['REMOTE_ADDR'];


  if (empty($username)) 
    { echo "Username is required"; }
  if (empty($email)) 
    { echo "Email is required"; }
  if (empty($password)) 
    { echo "Password is required"; }

 

    $user_check_query = "SELECT * FROM users WHERE Username='$username' OR Email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
   
    $user = mysqli_fetch_assoc($result);

  if ($user) { 
    if ($user['Username'] === $username) {
      array_push($errors, "Username already exists");
    }
    }

    if ($user['Email'] === $email) {
      array_push($errors, "email already exists");
    }
  

    
        $Data=mysqli_query($db,"INSERT INTO users (Username, Password, Age, Gender, Contactnumber , Email) VALUES ('$username', '$password', '$age', '$gender', '$number','$email')");
       

        if ($db->query($Data) === TRUE) {
    echo "New record created successfully";
}
 else {
    echo "Error: " . $Data. "<br>" . $db->error;
}
	
	header('Location: index.html');
?>