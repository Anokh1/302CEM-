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
		<link rel='stylesheet' href='css/register.css'>

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
			<div class='row mr-0'>
				<div class='pagecontent col-lg-10 col-md-10 col-sm-10 col-xs-10'>
				<h3>Register</h3>
		
					<?php
					if (isset($_POST['submitted'])){
						$username=$_POST['username'];
						$password=$_POST['password'];
						$cfmpass=$_POST['cfmpass'];
						$fname=$_POST['fname'];
						$lname=$_POST['lname'];
						$email=$_POST['email'];
						$phone=$_POST['phone'];
						
						
						$usernameError="";
						$passwordError="";
						$cfmpassError="";
						$fnameError="";
						$lnameError="";
						$emailError="";
						$phoneError="";
						
						$found=false;
						$problem=false;
						
						
						
						
						if(empty($username)){
							$usernameError = "Username cannot be empty!";
							$problem = true;
						}
						
						$dbc = mysqli_connect('localhost','root','');
						@mysqli_select_db($dbc,'light_cinema');
						if($dbc){
							$result=mysqli_query($dbc,"SELECT username FROM users");
							while($row=mysqli_fetch_array($result)){
								if($username==$row['username']){
									$found=true;
								}
							}
							if($found==true){
								$usernameError = "The username is being used!";
								$problem = true;
							}
						}
						mysqli_close($dbc);
						
						if(empty($password)) {
							$passwordError = "Password cannot be empty!";
							$problem = true;
						}
						else if(strlen($password) < 8){
							if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*?[#?!@$%^&*-]).*$/', $password)){
								$passwordError="Password cannot be shorter than 8 characters.";
								$problem = true;
							}
							else{
								$passwordError="Password cannot be shorter than 8 characters and must include at least one lowercase character, uppercase character, digit, and symbol.";
								$problem = true;
								
							}
						}
						else if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*?[#?!@$%^&*-]).*$/', $password)){
							$passwordError="Password must include at least one lowercase character, uppercase character, digit, and symbol.";
							$problem = true;
							
						}
						
						if(empty($cfmpass)){
							$cfmpassError = "Confirm Password field cannot be empty!";
							$problem = true;
						}
						else if($cfmpass!=$password){
							$cfmpassError = "Password do not match";
							$problem = true;
						}
						
						
						if(empty($fname)){
							$fnameError = "First Name cannot be empty!";
							$problem = true;
						}
						else if(!preg_match ("/^([a-zA-Z]+\s)*[a-zA-Z]+$/",$fname)) {
							$fnameError = "First Name must only contain letters!";
							$problem = true;
						}
						
						if(empty($lname)) {
							$lnameError = "Last Name cannot be empty!";
							$problem = true;
						}
						else if(!preg_match ("/^([a-zA-Z]+\s)*[a-zA-Z]+$/",$lname)) {
							$lnameError = "Last Name must only contain letters!";
							$problem = true;
						}
						
						if(empty($email)){
							$emailError = "Email cannot be empty!";
							$problem = true;
						}
						else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
							$emailError = "Invalid Email entered!";
							$problem = true;
						}
						$found=false;
						
						$dbc = mysqli_connect('localhost','root','');
						@mysqli_select_db($dbc,'light_cinema');
						if($dbc){
							$result=mysqli_query($dbc,"SELECT email FROM users");
							while($row=mysqli_fetch_array($result)){
								if($email==$row['email']){
									$found=true;
								}
							}
							if($found==true){
								$emailError = "The email is being used!";
								$problem = true;
							}
						}
						mysqli_close($dbc);
						
						if(empty($phone)){
							$phoneError = "Phone cannot be empty!";
							$problem = true;
						}
						else if (!preg_match("/[0-9]{3}-[0-9]{7}/",$phone)){
							$emailError = "Invalid phone number entered!";
							$problem = true;
						}
						//if problem redisplay using bootstrap error
						
						if($problem){
							print"<div class='alert alert-danger'><strong>Error!</strong><br/>";
							if(!empty($usernameError)){
								print"$usernameError<br/>";
							}
							if(!empty($passwordError)){
								print"$passwordError<br/>";
							}
							if(!empty($cfmpassError)){
								print"$cfmpassError<br/>";
							}
							if(!empty($fnameError)){
								print"$fnameError<br/>";
							}
							if(!empty($lnameError)){
								print"$lnameError<br/>";
							}
							if(!empty($emailError)){
								print"$emailError<br/>";
							}
							if(!empty($phoneError)){
								print"$phoneError<br/>";
							}
							print"</div>";			
						}
						//else store and display
						else{
							print"<div class='alert alert-success'><strong>Success!</strong> Registered Successfully!</div>";
							print"<a href='login.php'><button class='backbtn'>Return to home</button></a>";
							print"<a href='login.php'><button class='backbtn'>Login</button></a>";
							
							$dbc = mysqli_connect('localhost','root','');
							if(mysqli_select_db($dbc,'agilelaptop')){
								$query="INSERT INTO users (username,password,firstname,lastname,email,phone,accountType)
										VALUES('$username','$password','$fname','$lname','$email','$phone','User')";
											
								if(@mysqli_query($dbc,$query)){
									mysqli_close($dbc);
									//header("Location: login.php"); 
									exit();
								}
								else{
									echo"ERROR! Table not found!";
									mysqli_close($dbc);
								}
							}
							else{
								echo"ERROR! Database not found!";
								mysqli_close($dbc);
							}
						}
					}
					else{
						print"
						<form method='post' action='register.php' name='registerForm' onsubmit='return validateForm()'>
								<div class='alert alert-info'><strong>Info!</strong> This <p class='requiredfield'>*</p> symbol in red indicates required field.</div>
								<fieldset>
									<legend>Account details</legend>
									<div class='row'>
										<div class='usernamefield col-lg-12 col-md-12 col-sm-12 col-xs-12'>
												<label for='username'>Username <p class='requiredfield'>*</p></label><br/>
												<input type='text' placeholder='Enter username' name='username' id='username' onblur='usernameCheck()' maxlength='25' ";if(isset($_POST['username'])){print"value='".$_POST['username']."'";};print" required>
												<p class='error' id='uname_error'>&nbsp;</p>
										</div>
									</div>
									<div class='row'>
										<div class='ipassfield col-lg-6 col-md-6 col-sm-6 col-xs-6'>
											<label for='password'>Password <p class='requiredfield'>*</p></label><br/>
											<div class='passtooltip'>
												<input type='password' placeholder='Enter password' class='selectpass' name='password' id='password' onblur='passCheck()' onkeyup='passProgress()' maxlength='20' required/>
												<span class='passstr'>
													<div class='progress'>
														<div class='progress-bar' id='progresspercent'></div>									
													</div>
													<p id='passStrength'>Weak</p>
													<p><div id='plength'>&#10006;</div> Password length more than 7</p>
													<p><div id='psmalla'>&#10006;</div> Include smallcase alphabet</p>
													<p><div id='pbiga'>&#10006;</div> Include uppercase alphabet</p>
													<p><div id='pnum'>&#10006;</div> Include numbers</p>
													<p><div id='psym'>&#10006;</div> Include symbols</p>
												</span>
											</div>
											<p class='error' id='pass_error'>&nbsp;</p>
										</div>
										<div class='cpassfield col-lg-6 col-md-6 col-sm-6 col-xs-6'>
											<label for='confirmpass'>Confirm Password <p class='requiredfield'>*</p></label><br/>
											<input type='password' placeholder='Enter password again' name='cfmpass' id='cfmpass' onblur='cfmpassCheck()' maxlength='20'/>
											<p class='error' id='cfmpass_error'>&nbsp;</p>
										</div>
									</div>
								</fieldset>
								
								<br/>
								
								<fieldset>	
									<legend>Personal details</legend>
									<div class='row'>
										<div class='fnamefield col-lg-6 col-md-6 col-sm-6 col-xs-6'>
											<label for='firstname'>First name <p class='requiredfield'>*</p></label><br/>
											<input type='text' placeholder='Enter first name' name='fname' class='fnamefield' id='fname' onblur='fnameCheck()' maxlength='25' ";if(isset($_POST['username'])){print"value='".$_POST['fname']."'";};print" required/>
											<p class='error' id='fname_error'>&nbsp;</p>
										</div>
										<div class='lnamefield col-lg-6 col-md-6 col-sm-6 col-xs-6'>
											<label for='lastname'>Last name <p class='requiredfield'>*</p></label><br/>
											<input type='text' placeholder='Enter last name' name='lname' class='lnamefield' id='lname' onblur='lnameCheck()' maxlength='25' ";if(isset($_POST['username'])){print"value='".$_POST['lname']."'";};print" required/>
											<p class='error' id='lname_error'>&nbsp;</p>
										</div>
									</div>
									<div class='row'>
										<div class='emailfield col-lg-12 col-md-12 col-sm-12 col-xs-12'>
											<label for='email'>Email <p class='requiredfield'>*</p></label><br/>
											<input type='email' placeholder='Enter email' name='email' class='emailfield' id='email' onblur='emailCheck()' maxlength='30' ";if(isset($_POST['username'])){print"value='".$_POST['email']."'";};print" required/>
											<p class='error' id='email_error'>&nbsp;</p>
										</div>
									</div>
									<div class='row'>
										<div class='phonefield col-lg-12 col-md-12 col-sm-12 col-xs-12'>
											<label for='phone'>Phone no. <p class='requiredfield'>*</p></label><br/>
											<input type='text' placeholder='eg. 012-3456789' name='phone' class='phonefield' id='phone' onblur='phoneCheck()' pattern='[0-9]{3}-[0-9]{7}' maxlength='11' ";if(isset($_POST['username'])){print"value='".$_POST['phone']."'";};print" required/>
											<p class='error' id='phone_error'>&nbsp;</p>
										</div>
									</div>
								</fieldset>
								<br/>
								<input type='hidden' name='submitted' value='true'/>
								<button type='submit' class='submitbtn'>Register</button>
							</form>
							<a href='login.php'><button class='backbtn'>Back</button></a>
						
						";
					}
					
					
					
					
					?>
		
				</div>
			</div>
		</div>
		
		
		<?php 
		
			}
		include'include/footer.php';?>
		
		<script src='js/sidemenu.js'></script>
		<script src='js/formvalidation.js'></script>

		
		
	</body>
</html>