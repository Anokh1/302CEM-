<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Light Cinema</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		
		<link rel='stylesheet' href='css/general.css'>
		<link rel='stylesheet' href='css/myacc.css'>
	</head>
	
	<body>
		<?php
			include'include/dbmanager.php';
			include'include/header.php';
		?>
		
		
		<div class='pagecontent container-fluid p-0'>
			<div class='row mr-0'>
				<?php
					include'include/accsidenav.php';
				?>
				
				
				<div class='articledetail col-lg-8 col-md-8 col-sm-8 col-xs-8'>
					<h3>Account details</h3>
					<hr/>
					<?php
					
					if(isset($_SESSION['userID'])){
						$userID = $_SESSION['userID'];
					}
					
					
					if(isset($_POST['updateuname'])){
						$found=false;
						$problem=false;
						$username=$_POST['username'];
						if(empty($username)){
							$usernameError = "Username cannot be empty!";
							$problem = true;
						}
						
						$dbc = mysqli_connect('localhost','root','');
						@mysqli_select_db($dbc,'agilelaptop');
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
						
						if($problem){
							print"<div class='alert alert-danger'><strong>Error!</strong><br/>";
								if(!empty($usernameError)){
									print"$usernameError<br/>";
								}
							print"</div>";
							print"<a href='editaccount.php'><button>&larr; Back</button></a>";
						}
						else{
							$query = "UPDATE users SET username='$username' WHERE userID=$userID";
										
							//Execute the query
							if (@mysqli_query($dbc, $query)) {
								print"<p>Successfully editted! Loging out in a few seconds...</p>";
								session_destroy();
								header('Refresh:1; url=homepage.php');
								exit();
							}
						}
						mysqli_close($dbc);
						
					}
					else if(isset($_POST['updatepass'])){
						$found=false;
						$problem=false;
						$oldpass=$_POST['oldpass'];
						$password=$_POST['password'];
						$cfmpass=$_POST['cfmpass'];
						
						$dbc = mysqli_connect('localhost','root','');
						@mysqli_select_db($dbc,'agilelaptop');
						if($dbc){
							$result=mysqli_query($dbc,"SELECT password FROM users WHERE userID=$userID");
							while($row=mysqli_fetch_array($result)){
								if($oldpass==$row['password']){
									$found=true;
								}
							}
							if($found==false){
								$oldpassError = "Incorrect old password";
								$problem = true;
							}
							mysqli_close($dbc);
						}
		
						
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
						if($problem){
							print"<div class='alert alert-danger'><strong>Error!</strong><br/>";
								if(!empty($oldpassError)){
									print"$oldpassError<br/>";
								}
								if(!empty($passwordError)){
									print"$passwordError<br/>";
								}
								if(!empty($cfmpassError)){
									print"$cfmpassError<br/>";
								}
							print"</div>";
							print"<a href='editaccount.php'><button>&larr; Back</button></a>";
						}
						else{
							$dbc = mysqli_connect('localhost','root','');
							@mysqli_select_db($dbc,'agilelaptop');
							$query = "UPDATE users SET password='$password' WHERE userID=$userID";
										
							//Execute the query
							if (@mysqli_query($dbc, $query)) {
								print"<p>Successfully editted!</p>";
								print"<a href='myaccount.php'><button>&larr; Back</button></a>";
							}
						}
						mysqli_close($dbc);
					}
					else if(isset($_POST['updateflname'])){
						$problem=false;
						$fname=$_POST['fname'];
						$lname=$_POST['lname'];
						
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
						
						if($problem){
							print"<div class='alert alert-danger'><strong>Error!</strong><br/>";
								if(!empty($fnameError)){
									print"$fnameError<br/>";
								}
								if(!empty($lnameError)){
									print"$lnameError<br/>";
								}
							print"</div>";
							print"<a href='editaccount.php'><button>&larr; Back</button></a>";
						}
						else{
							$dbc = mysqli_connect('localhost','root','');
							@mysqli_select_db($dbc,'agilelaptop');
							$query = "UPDATE users SET firstname='$fname',lastname='$lname' WHERE userID=$userID";
										
							//Execute the query
							if (@mysqli_query($dbc, $query)) {
								print"<p>Successfully editted!</p>";
								print"<a href='myaccount.php'><button>&larr; Back</button></a>";
							}
						}
						mysqli_close($dbc);
					}
					else if(isset($_POST['updateemail'])){
						$found=false;
						$problem=false;
						$email=$_POST['email'];
						
						if(empty($email)){
							$emailError = "Email cannot be empty!";
							$problem = true;
						}
						else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
							$emailError = "Invalid Email entered!";
							$problem = true;
						}
						$dbc = mysqli_connect('localhost','root','');
						@mysqli_select_db($dbc,'agilelaptop');
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
						
						if($problem){
							print"<div class='alert alert-danger'><strong>Error!</strong><br/>";
								if(!empty($emailError)){
									print"$emailError<br/>";
								}
							print"</div>";
							print"<a href='editaccount.php'><button>&larr; Back</button></a>";
						}
						else{
							$dbc = mysqli_connect('localhost','root','');
							@mysqli_select_db($dbc,'agilelaptop');
							$query = "UPDATE users SET email='$email' WHERE userID=$userID";
										
							//Execute the query
							if (@mysqli_query($dbc, $query)) {
								print"<p>Successfully editted!</p>";
								print"<a href='myaccount.php'><button>&larr; Back</button></a>";
							}
						}
						mysqli_close($dbc);
					}
					else if(isset($_POST['updatephone'])){
						$phone=$_POST['phone'];
						$problem=false;
						if(empty($phone)){
							$phoneError = "Phone cannot be empty!";
							$problem = true;
						}
						else if (!preg_match("/[0-9]{3}-[0-9]{7}/",$phone)){
							$emailError = "Invalid phone number entered!";
							$problem = true;
						}
						if($problem){
							print"<div class='alert alert-danger'><strong>Error!</strong><br/>";
								if(!empty($phoneError)){
									print"$phoneError<br/>";
								}
							print"</div>";
							print"<a href='editaccount.php'><button>&larr; Back</button></a>";
						}
						else{
							$dbc = mysqli_connect('localhost','root','');
							@mysqli_select_db($dbc,'agilelaptop');
							$query = "UPDATE users SET phone='$phone' WHERE userID=$userID";
										
							//Execute the query
							if (@mysqli_query($dbc, $query)) {
								print"<p>Successfully editted!</p>";
								print"<a href='myaccount.php'><button>&larr; Back</button></a>";
							}
						}
						mysqli_close($dbc);
					}
					else{
						print"
						<div class='row'>
							<div class='usernamefield col-lg-12 col-md-12 col-sm-12 col-xs-12'>
								<h4>Username</h4>
								<div class='alert alert-info'><strong>Info! </strong>Changing username will have to relog</div>
							</div>
						</div>
						<div class='row'>
							<div class='usernamefield col-lg-12 col-md-12 col-sm-12 col-xs-12'>	
								<form method='post' action='editaccount.php' name='unameform' onsubmit='return checkUName()'>
									<label>New username</label><br/>
									<input type='text' name='username' id='username' onblur='usernameCheck()'/>
									<div id='uname_error'><br/></div>
									<input type='hidden' name='updateuname' value='true'/>
									<button type='submit' class='submitbtn'>Update</button>
								</form>
							</div>
						</div>
						<br/>
						<hr/>
						
						<div class='row'>
							<div class='usernamefield col-lg-12 col-md-12 col-sm-12 col-xs-12'>
								<h4>Password</h4>
							</div>
						</div>
						
						<div class='row'>
							<form method='post' action='editaccount.php' name='passform' onsubmit='return checkPass()'>
								<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
									<label>Old password</label><br/>
									<input type='password' name='oldpass'/>
								</div>
						</div>
						<div class='row'>
							<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
								<label>New password</label><br/>
								<div class='passtooltip'>
									<input type='password' class='selectpass' name='password' id='password' onblur='passCheck()' onkeyup='passProgress()'>
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
								<div class='error' id='pass_error'><br/></div>
							</div>
							<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
								<label>Confirm New Password</label><br/>
								<input type='password' name='cfmpass' id='cfmpass' onblur='cfmpassCheck()'>
								<div class='error' id='cfmpass_error'><br/></div>
							</div>
						</div>
						<div class='row'>
							<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
								<input type='hidden' name='updatepass' value='true'/>
								<button type='submit' class='submitbtn'>Update</button>
							</div>
						</div>
							</form>
						<br/>
						<hr/>
						
						<div class='row'>
							<div class='usernamefield col-lg-12 col-md-12 col-sm-12 col-xs-12'>
								<h4>Name</h4>
							</div>
						</div>
						<form method='post' action='editaccount.php' name='flform' onsubmit='return checkflname()'>
							<div class='row'>
								
									<div class='fnamefield col-lg-6 col-md-6 col-sm-6 col-xs-6'>
										<label>First name</label><br/>
										<input type='text' name='fname' class='fnamefield' id='fname' onblur='fnameCheck()'>
										<div class='error' id='fname_error'><br/></div>
									</div>
									<div class='lnamefield col-lg-6 col-md-6 col-sm-6 col-xs-6'>
										<label>Last name</label><br/>
										<input type='text' name='lname' class='lnamefield' id='lname' onblur='lnameCheck()'>
										<div class='error' id='lname_error'><br/></div>
									</div>
								
							</div>
							<div class='row'>
								<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
									<input type='hidden' name='updateflname' value='true'/>
									<button type='submit' class='submitbtn'>Update</button>
								</div>
							</div>
						</form>
						<br/>
						<hr/>
						
						<div class='row'>
							<div class='usernamefield col-lg-12 col-md-12 col-sm-12 col-xs-12'>
								<h4>Email</h4>
							</div>
						</div>
						
						<form method='post' action='editaccount.php' name='emailform' onsubmit='return checkemail()'>
							<div class='row'>
								<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
									<label>New email</label><br/>
									<input type='email' name='email' class='emailfield' id='email' onblur='emailCheck()'>
									<div class='error' id='email_error'><br/></div>
								</div>
							</div>
							<input type='hidden' name='updateemail' value='true'/>
							<button type='submit' class='submitbtn'>Update</button>
						</form>
						<br/>
						<hr/>
						
						<div class='row'>
							<div class='usernamefield col-lg-12 col-md-12 col-sm-12 col-xs-12'>
								<h4>Phone</h4>
							</div>
						</div>
						<form method='post' action='editaccount.php' name='phoneform' obsubmit='return checkphone()'>
							<div class='row'>
								<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
									<label for='phone'>Phone no.</label><br/>
									<input type='text' placeholder='Enter phone w/ -' name='phone' class='phonefield' id='phone' onblur='phoneCheck()' pattern='[0-9]{3}-[0-9]{7}'>
									<div class='error' id='phone_error'><br/></div>
								</div>
							</div>
							<input type='hidden' name='updatephone' value='true'/>
							<button type='submit' class='submitbtn'>Update</button>
						</form>
						
						
						
						";
						
					}
		
					
					//alert success
					?>
				</div>
				
			</div>
		</div>
		
		<?php

			include'include/footer.php';
		?>
		
		<script src='js/sidemenu.js'></script>
		<script src='js/validedit.js'></script>
		
	</body>
</html>