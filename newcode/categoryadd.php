<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Light Cinema</title>
		
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
		<a href='homepage.php'><button class='returnbutton'>&larr; Return to website</button></a>
		
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
							if(isset($_POST['submitted'])){
								$categoryName=$_POST['categoryName'];
								$problem=false;
								
								$dbc = mysqli_connect('localhost','root','');
								@mysqli_select_db($dbc,'agilelaptop');
								if($dbc){
									$result=mysqli_query($dbc,"SELECT categoryName FROM category");
									while($row=mysqli_fetch_array($result)){
										if($row['categoryName']==$categoryName){
											$problem = true;
											
										}
									}
									mysqli_close($dbc);
								}
								
								
								if(!$problem){
									$dbc = mysqli_connect('localhost','root','');
									mysqli_select_db($dbc,'agilelaptop');
									if($dbc){
										$result="INSERT INTO category(categoryName,isDefault) VALUES('$categoryName',false)";
										
											if(@mysqli_query($dbc,$result)){
												print"<a href='categorylist.php'><button>&larr; Back</button></a>";
												print"<p>Successfully added</p>";
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
								print"
								<a href='categorylist.php'><button class='submitbtn'>&larr; Back</button></a>
								<h3>Add new category</h3>
								<hr/>
								<form method='post' action='categoryadd.php'>
									<label for='categoryName'>Category Name</label><br/>
									<input name='categoryName' type='text'/>
									<br/><br/>
									
									
									<input type='hidden' name='submitted' value='true'/>
									<button type='submit' class='submitbtn'>Submit</button>
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