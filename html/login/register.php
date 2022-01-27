<?php 

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{

		$server = "localhost";
		$user = "pi";
		$pass = "toshith1";
		$database = "loginDB";
		$con = mysqli_connect($server, $user, $pass, $database);

		if(mysqli_connect_error())
		{
			echo "<p>Error occurred. Main login database</p>";
			echo "<p>Exiting...</p>";
			exit();
		}
		$errusername = $errpassword = $erremail = $errfirstname = $errlastname = $errsex = "";
		$username = $password = $email = $firstname = $lastname = $sex = "";
		$username = $_POST["username"];
		include "enc_pass.php";
		$password = $encpassword;
		$email = $_POST["email"];
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$sex = $_POST["sex"];
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$qry = "insert into users(username, password, email, firstname, lastname, sex)
				values('$username', '$password', '$email', '$firstname', '$lastname', '$sex');";
        $res = $con->query($qry);




        if($res)
		{
			echo "<p>You have successfully signed up</p>";
			echo "<p>Your Username: <b>".$username."</b></p>";
			echo "<p>Your Password: <b>".$_POST['password']."</b></p>";

			$servername = "localhost";
			$usern = "pi";
			$passw = "toshith1";

			$con = new mysqli($servername, $usern, $passw);
			if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
			}
			$sql = "CREATE DATABASE $username";
			if ($con->query($sql) === TRUE) {
  				echo "Database created successfully <br>";
			} else {
				echo "Error creating database: " . $con->error;
			}
			$con->close();

			$con = new mysqli($servername, $usern, $passw, $username);
			if ($con->connect_error) {
				die("Connection failed: " . $con->connect_error);
			}
			$sqll = "CREATE TABLE preferences (
				prof TEXT(255)NOT NULL,
				theme TEXT(255) NOT NULL,
				wallpaper TEXT(255) NOT NULL,
				voice TEXT(255) NOT NULL,
				opacity TEXT(10) NOT NULL
				);";
			if ($con->query($sqll) === TRUE) {
				echo "preferences table set <br>";
			} else {
				echo "error in setting preferences table<br>";
			}
			$queryy=mysqli_query($conn,"insert into preferences(prof, theme, wallpaper, voice, opacity)
			values('p1', 'light', 'img3.jpeg', 'male', '0.8')");

			$ssql = "CREATE TABLE $username.commands SELECT * FROM gencom.commands;";
	
			if ($con->query($ssql) === TRUE) {
				echo "commands Table for $username created successfully<br>";
			} else {
				echo "Error creating table(commands): " . $con->error;
			}
		    $con->close();

		}


		else 
		{
			echo "<p>Username/email already in use.</p>";
			exit();
		}

		$servername = "localhost";
		$usern = "pi";
		$passw = "toshith1";

		$conn = new mysqli($servername, $usern, $passw);

		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
			
		$sql1 = "CREATE USER '".$username."'@'localhost' IDENTIFIED BY '".$password."';";
		if ($conn->query($sql1) === TRUE) {
			echo "User created successfully <br>";
		} else {
			echo "Error creating user: " . $conn->error;
		}
		$sql2 = "GRANT ALL PRIVILEGES ON $username.* to '$username'@'localhost';";
		if ($conn->query($sql2) === TRUE) {
			echo "Privileges Granted <br>";
		} else {
			echo "Error Granting privileges <br>" . $conn->error;
		}
		$sql3 = "FLUSH PRIVILEGES;";
		if ($conn->query($sql3) === TRUE) {
			echo "Privileges Flushed<br>";
		} else {
			echo "Error flushing privileges " . $conn->error;
		}
		$conn->close();
		exit();
	}
	
?>