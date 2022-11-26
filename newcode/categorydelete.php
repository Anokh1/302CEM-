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
		<a href='catalog.php'><button class='returnbutton'>&larr; Return to website</button></a>
		
		<br/>
		
		<div class='container-fluid p-0'>
			<div class='row justify-content-md-center mr-0'>
				<div class='pagecontent col-lg-11 col-md-11 col-sm-11 col-xs-11 '>
					<div class='row mr-0'>
						
						<?php
							include('include/adminsidenav.php');
						?>
						
						
						<div class='articledetail col-lg-7 col-md-7 col-sm-7 col-xs-7'>
							<?php
		
							if(isset($_POST['submitted'])&&isset($_POST['categoryID'])){
								$categoryID=$_POST['categoryID'];
								$dbc = mysqli_connect('localhost','root','');
								mysqli_select_db($dbc,'agilelaptop');
								if($dbc){
									$change="UPDATE product SET categoryID=1 WHERE categoryID=$categoryID";
									if(@mysqli_query($dbc,$change)){
											
											
									}

									$result="DELETE FROM category WHERE categoryID=$categoryID";
									
										if(@mysqli_query($dbc,$result)){
											print"<a href='categorylist.php'><button>&larr; Back</button></a>";
											print"<p>Existing product with the deleted category has been changed to \"Other\". Successfully deleted</p>";
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
								$categoryID=$_GET['categoryID'];
								$dbc = mysqli_connect('localhost','root','');
								mysqli_select_db($dbc,'agilelaptop');
								if($dbc){
									$result=mysqli_query($dbc,"SELECT categoryName FROM category WHERE categoryID=$categoryID");
									$row=mysqli_fetch_row($result);
									print"
									<a href='categorylist.php'><button>&larr; Back</button></a>
									<h3>Delete Category</h3>
									<hr/>
									<p>Do you wish to delete this Category?</p>";
									print"
									<table>
										<tr>
											<th>Category Name</th>
											<td>".$row[0]."</td>
										</tr>
									</table>";
								}
								
								print"
								<form method='post' action='categorydelete.php'>
									<input type='hidden' name='categoryID' value='$categoryID'/>
									<input type='hidden' name='submitted' value='true'/>
									<button type='submit' class='submitbtn'>Delete</button>
								</form>
								";
									
							}
							
							
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>