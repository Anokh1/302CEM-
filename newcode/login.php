<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Agile Laptop</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<script src="js/pagination.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.css"/>
		
		
		<link rel='stylesheet' href='css/general.css'/>
		<link rel='stylesheet' href='css/general2.css'/>
		<link rel='stylesheet' href='css/login.css'>

	</head>
	
	<body>
		<?php
			include'include/dbmanager.php';
			include'include/header.php';
			
			if(isset($_SESSION['userID'])){
				print"<p>You are already logged in, <a href='catalog.php'>Go here</a></p>";
			}
			else{
		?>
		<div class='container-fluid pr-0'>
			<div class='row justify-content-md-center mr-0'>
				<div class='pagecontent col-lg-4 col-md-4 col-sm-4 col-xs-4'>
					<h3>Login</h3>
					<hr/>
					
					<?php
					if (isset($_POST['submitted'])) {
						$username=$_POST['username'];
						$password=$_POST['password'];
						
						$usernameError="";
						$passwordError="";
						$id_passwordError="";
						$found=false;
						$problem=false;
						
						$accountType="";
						$addProduct="";
						$minusProduct="";
						$management="";
						
						
						if (empty($username)||empty($password)){
							
							if(empty($username)) {
								$usernameError = "Username cannot be empty!";
								$problem = true;
							}
							if(empty($password)) {
								$passwordError = "Password cannot be empty!";
								$problem = true;
							}
						}				
						else {
							//database
							//invalid
							//valid
							
							$accountType="";
							$userID=0;
							
							$dbc = mysqli_connect('localhost','root','');
							@mysqli_select_db($dbc,'agilelaptop');
							if($dbc){
								$result=mysqli_query($dbc,"SELECT userID,username,password,accountType FROM users");
								while($row=mysqli_fetch_array($result)){
									if($username==$row['username']&&$password==$row['password']){
										$found=true;
										print"<div class='alert alert-success'><strong>Success!</strong> Login Successfully!</div>";
										print"<p style='color:white;'>Redirecting to homepage...</p>";
										print"</div>";
										print"</div>";
										print"</div>";
										include'include/footer.php';
										$accountType=$row['accountType'];
										$userID=$row['userID'];
										header('Refresh:2; url=catalog.php');
									}
								}
								if($found==false){
									$id_passwordError = "Incorrect ID or Password entered!";
									$problem = true;
								}
							}
							mysqli_close($dbc);
							
							
						}
						
						if($problem){
							print"
							<div class='alert alert-danger'><strong>Error!</strong><br/>";
							if(!empty($usernameError)){
								print"$usernameError<br/>";
							}
							if(!empty($passwordError)){
								print"$passwordError<br/>";
							}
							if(!empty($id_passwordError)){
								print"$id_passwordError<br/>";
							}
							print"</div>";
						}
						else{
							
							if (isset($_POST['username'])){
								//session_start();
								
								$_SESSION['username'] = $_POST['username'];
								
								$_SESSION['accountType']=$accountType;
								$_SESSION['userID']=$userID;
								
								
								header('Refresh:2; url=catalog.php');
								exit();
							}
						}
						
					}
					
					print"	
						<form name='loginForm' onsubmit='loginCheck()' method='post' action='login.php'>
							<label for='username'>Username</label><br/>
							<input type='text' placeholder='Enter Username...' name='username' id='username' maxlength='25'>
							<br/>
							<label for='password'>Password</label><br/>
							<input type='password' placeholder='Enter Password...' name='password' id='password' maxlength='20'>
							<br/>
							<br/>
							<input type='hidden' name='submitted' value='true'/>
							<button type='submit' class='loginbtn'>Login</button>
						</form>
						<p>Don't have an account? <a href='register.php'>Register here</a></p>
					";
					
					?>
				</div>
			</div>
		</div>
		
		
		<?php 
			}
		include'include/footer.php';?>
		
		<script src='js/sidemenu.js'></script>

		<script src='js/loginvalidation.js'></script>
		
	</body>
</html>