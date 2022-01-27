<?php
include "login_check1318.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="/widescreen/style/anim.js"></script>
		<link href="/widescreen/style/widescreen/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<style>
			.opacity{
				opacity:0.7;
			}
			</widescreen/style>
		
	</head>
	<body>

			<center><h1>Home Page</h1></center>
			<div>
			<div class="left"><a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a></div>
			<div class="right"><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></div>
			</div>
			<br>
			
			<p>HI <?=$_SESSION['username'];?></p>
			
		
<iframe class='child basic opacity' src="/widescreen/summer/widescreen/summer.php"></iframe>
<button id="animbutton" class="animbutton"></button>
<script>
	function func(){
		document.getElementById("animbutton").click();
	}
	window.setTimeout(func,500);
</script>
	</body>
</html>
