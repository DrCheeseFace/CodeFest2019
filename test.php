<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form method="post">
  First name:<br>
  <input type="text" name="username">
  <br>
  <input type="submit" value="Submit">
</form> 

<p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>

<?php
$username = filter_input(INPUT_POST,"username");


if (!empty($username)) {
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";   #put this in later
	$dbname= "forum";

	$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
	if (mysqli_connect_error()){
		die("connect error(".mysqli_connect_errno().")". mysqli_connect_error());
	} else{
		$SELECT = "SELECT username From register where username = ? limit 1";
		$INSERT = " INSERT into register (username) values(?)";

		$stmt = $conn->prepare ($SELECT);
		$stmt->bind_param("s",$username);
		$stmt->execute();
		$stmt->bind_result($username);
		$stmt -> store_result();
		$rnum = $stmt -> num_rows;

		if($rnum==0){
			$stmt->close();

			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("s",$username);
			$stmt->execute();
			echo "new record inserted"; 

		}else{
			echo "same username as someone else";
		}

	}

} else{
	echo "All fields are required";
	die();
	

}
?>

</body>
</html>