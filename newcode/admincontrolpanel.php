<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Agile Laptop</title>
		<link rel='stylesheet' href='css/general.css'>
		<link rel='stylesheet' href='css/admincontrolpanel.css'>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		
		<link rel='stylesheet' href='css/general.css'>
		<link rel='stylesheet' href='css/admincontrolpanel.css'>
	</head>
	
	<body>
		<?php
		include'include/dbmanager.php';
		
		if(!isset($_SESSION)){
			session_start();
		}
		
		if(!isset($_SESSION['userID'])){
			print"You must be logged in to view this page, <a href='login.php'>Login here</a>";
		}
		else if(isset($_SESSION['accountType'])&&$_SESSION['accountType']!="Admin"){
			print"You don't have permission to view this page, <a href='catalog.php'>Back to homepage</a>";
		}
		else{
		?>
	
		<a href='catalog.php'><button class='returnbutton'>&larr; Return to website</button></a>
		
		<div class='container-fluid p-0'>
			<div class='row justify-content-md-center mr-0'>
				<div class='pagecontent col-lg-11 col-md-11 col-sm-11 col-xs-11 '>
					<div class='row mr-0'>
						
						<?php
							include('include/adminsidenav.php');
						?>
						
						
						<div class='articledetail col-lg-7 col-md-7 col-sm-7 col-xs-7'>
							<h3>Main page</h3>
							<hr/>
							<p>Welcome!</p>
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<?php
		}
		?>
		
	</body>
</html>