<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Agile Laptop</title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<script src="js/pagination.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.css"/>
		
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
		
		<br/>
		
		<div class='container-fluid p-0'>
			<div class='row justify-content-md-center mr-0'>
				<div class='pagecontent col-lg-11 col-md-11 col-sm-11 col-xs-11 '>
					<div class='row mr-0'>
						
						<?php
							include'include/dbmanager.php';
							include('include/adminsidenav.php');
						?>
						
						
						<div class='articledetail col-lg-7 col-md-7 col-sm-7 col-xs-7'>
							<?php

		
								if(isset($_POST['submitted'])){
									$categoryName=$_POST['categoryName'];
									$categoryID=$_POST['categoryID'];
										
									$problem=false;
									
									
									$dbc = mysqli_connect('localhost','root','');
									@mysqli_select_db($dbc,'agilelaptop');
									if($dbc){
										$result=mysqli_query($dbc,"SELECT categoryName FROM category");
										while($row=mysqli_fetch_array($result)){
											if($categoryName==$row['categoryName']){
												$problem = true;
											}
										}
										mysqli_close($dbc);
									}
									
									if(!$problem){
										$dbc = mysqli_connect('localhost','root','');
										mysqli_select_db($dbc,'agilelaptop');
										if($dbc){
											$result="UPDATE category SET categoryName='$categoryName' WHERE categoryID=$categoryID";
											
												if(@mysqli_query($dbc,$result)){
													print"<a href='categorylist.php'><button>&larr; Back</button></a>";
													print"<p>Successfully changed</p>";
													mysqli_close($dbc);
													header('Refresh:3; url=categorylist.php');
												}
										}
										else{
											print"query failed";
											mysqli_close($dbc);
										}
									}
									else{
										print"<a href='categorylist.php'><button>&larr; Back</button></a>";
										print"<p>The category already exists!</p>";
									}
									
									
								}
								else{
									$categoryID=$_GET['categoryID'];
									
									$dbc = mysqli_connect('localhost','root','');
									mysqli_select_db($dbc,'agilelaptop');
									if($dbc){
										$result=mysqli_query($dbc,"SELECT categoryName FROM category WHERE categoryID=$categoryID");
										$row=mysqli_fetch_row($result);
										print"
										<a href='categorylist.php'><button>&larr; Back</button></a>
										<h3>Edit Product</h3>
										<hr/>";
										print"
										<table>
											<tr>
												<th>Category Name</th>
												<td>".$row[0]."</td>
												<td><form method='post' action='categoryedit.php'>
												<input name='categoryName' type='text'/>
												<input type='hidden' name='categoryID' value='$categoryID'/>
												<input type='hidden' name='submitted' value='true'/>
												<button type='submit'>Change</button>
												</form></td>
											</tr>

										</table>";
									}
									mysqli_close($dbc);
								}
							
								
								
							?>
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