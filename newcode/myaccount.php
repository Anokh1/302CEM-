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
		
		<link rel='stylesheet' href='css/general.css'>
		<link rel='stylesheet' href='css/general2.css'>
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
					<?php
					
					if(isset($_SESSION['userID'])){
						$userID = $_SESSION['userID'];
					}
					
					$dbc = mysqli_connect('localhost','root','');
					@mysqli_select_db($dbc,'agilelaptop');
					
					if($dbc){
						$result=mysqli_query($dbc,"SELECT username,password,firstname,lastname,email,phone,loyaltypoint
													FROM users
													WHERE userID=$userID");
						$row=mysqli_fetch_row($result);
						
						print"<h3>Account details</h3>
						<hr/><br/>
						<table class='displaytable'>
							<tr>
								<td>Username</td>
								<td>: ".$row[0]."</td>
							</tr>
							<tr>
								<td>Password</td>
								<td>: ********</td>
							</tr>
							<tr>
								<td>First name</td>
								<td>: ".$row[2]."</td>
							</tr>
							<tr>
								<td>Last name</td>
								<td>: ".$row[3]."</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>: ".$row[4]."</td>
							</tr>
							<tr>
								<td>Phone number</td>
								<td>: ".$row[5]."</td>
							</tr>
							<tr>
								<td>Loyalty point</td>
								<td>: ".$row[6]."</td>
							</tr>
						</table>
						";
						
					}
					mysqli_close($dbc);
					?>
				</div>
				
			</div>
		</div>
		
		<?php
			//alert success
			include'include/footer.php';
		?>
		
		<script src='js/sidemenu.js'></script>
		
		
	</body>
</html>