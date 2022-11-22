<?php

if(!isset($_SESSION)){
	session_start();
}

if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	
	$dbc = mysqli_connect('localhost','root','');
	@mysqli_select_db($dbc,'agilelaptop');
	if($dbc){
		$result=mysqli_query($dbc,"SELECT username,accountType FROM users WHERE username='$username'");
		while($row=mysqli_fetch_array($result)){
			if($row['accountType']=="Admin"){
				print"<a href='admincontrolpanel.php'>Admin Control</a>";
			}
		}
	}
	mysqli_close($dbc);
	
}

if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	print"<li class='logreglink' style='font-weight:bolder'>Welcome, $username</li>";
	print"<li class='divline'>|</li>";
	print"<li class='logreglink'><a href='#' >My Account</a></li>";
	print"<li class='divline'>|</li>";
	print"<li class='logreglink'><a href='catalog.php?logout=true' >Logout</a></li>";
	
	if(isset($_GET['logout'])){
		unset($_SESSION);
		session_destroy();
		header('Location: catalog.php'); 
		exit();
	}
}
else{
	print"<li class='logreglink'><a href='register.php'>Register</a></li>";
	print"<li class='divline'>|</li>";
	print"<li class='logreglink'><a href='login.php' >Login</a></li>";
}

?>