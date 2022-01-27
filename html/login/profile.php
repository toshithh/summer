<?php

include 'login_check1318.php';

include "server_conn.php";
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_login);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$stmt = $con->prepare('SELECT password, firstname, email, status FROM users WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($enspassword, $fname, $email, $status);
$stmt->fetch();
$stmt->close();
include "dec_pass.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="/widescreen/style/widescreen/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<script>
			var show = "<?=$password?>";
		</script>
	</head>
	<body>
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['username']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" value="<?=$password?>" id="passwo"><br><input type="checkbox" value="Show password" id="showpass"></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
					<tr>
						<td>Name:</td>
						<td><?=$fname?></td>
					</tr>
					<tr>
						<td>Status:</td>
						<td><?=$status?></td>
				</table>
				<script>

				</script>
			</div>
		</div>
	<!== Commands ==>
	<div id="commtable">

		<?php
		include "server_conn.php";
		$db_usern = $_SESSION["username"];
		$mysqli = new mysqli($db_host, $_SESSION['username'], $_SESSION['password'], $_SESSION['username']);
		$query = $mysqli->query('SELECT * FROM commands');
		$query = 'SELECT * FROM commands';
		echo "<b> <center>Database Output</center> </b> <br> <br>";

		if ($result = $mysqli->query($query)) {
			echo "<table><tr><th id='com'>command</th><th id='com'>reply</th><th id='com'>type</th><th id='com'>reply1</th><th id='com'>reply2</th><th id='com'>affirmative</th><th id='com'>negative</th><th id='com'>function</th></tr>";
    	while ($row = $result->fetch_assoc()) {
    		$command = $row["command"];
			$reply = $row["reply"];
			$type = $row["type"];
			$reply1 = $row["reply1"];
			$reply2 = $row["reply2"];
			$affirmative = $row["affirmative"];
			$negative = $row["negative"];
			$function = $row["function"];

    	    echo "<tr><td id='com'>".$command."</td><td id='com'>".$reply."</td><td id='com'>".$type."</td><td id='com'>".$reply1."</td><td id='com'>".$reply2."</td><td id='com'>".$affirmative."</td><td id='com'>".$negative."</td><td id='com'>".$function.'</td></tr>';
		}
		echo "<table><br><br>";

		/*freeresultset*/
		$result->free();
		}
		?>
	</div>
	</body>
</html>