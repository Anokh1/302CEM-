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
		
	</body>
</html>