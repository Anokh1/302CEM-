<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Hokari Stock Management</title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

		
	</head>
	<body>
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
	</body>	
</html>