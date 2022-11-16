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

		
			if(isset($_POST['submitted'])&&isset($_POST['barcodeNumber'])){
				
				$barcodeNumber=$_POST['barcodeNumber'];
				
				
				$dbc = mysqli_connect('localhost','root','');
				mysqli_select_db($dbc,'agilelaptop');
				if($dbc){
					
					
					$result="DELETE FROM product WHERE barcodeNumber=$barcodeNumber";
					
					if(@mysqli_query($dbc,$result)){
						print"<a href='productlist.php'><button>&larr; Back</button></a>";
						print"<p>Successfully deleted</p>";
						mysqli_close($dbc);
						header('Refresh:3; url=productlist.php');
					}
					
				}
				else{
					print"query failed";
					mysqli_close($dbc);
				}
				
			}
			else{
				$barcodeNumber=$_GET['barcodeNumber'];
				$dbc = mysqli_connect('localhost','root','');
				mysqli_select_db($dbc,'agilelaptop');
				if($dbc){
					$result=mysqli_query($dbc,"SELECT p.barcodeNumber,p.productImage,p.productName,p.productDescription,c.categoryName,p.productQuantity,p.productPrice FROM product p INNER JOIN category c ON p.categoryID=c.categoryID WHERE barcodeNumber=$barcodeNumber");
					$row=mysqli_fetch_row($result);
					print"
					<a href='productlist.php'><button>&larr; Back</button></a>
					<h3>Delete product</h3>
					<hr/>
					<p>Do you wish to delete this product?</p>";
					print"
					<table>
						<tr>
							<th>Image</th>
							<td><img src='image/upload/".$row[1]."' height='100' width='100'/></td>
						</tr>
						<tr>
							<th>Name</th>
							<td>".$row[2]."</td>
						</tr>
						<tr>
							<th>Description</th>
							<td>".$row[3]."</td>
						</tr>
						<tr>
							<th>Category</th>
							<td>".$row[4]."</td>
						</tr>
						<tr>
							<th>Quantity</th>
							<td>";
							if($row[5]==0){
								print"Out of Stock";	
							}
							else{
								print"".$row[5]."";
							}
							print"</td>
						</tr>
						<tr>
							<th>Price</th>
							<td>".$row[6]."</td>
						</tr>

					</table>";
					
				}
				
				print"
				<form method='post' action='productdelete.php'>
					<input type='hidden' name='barcodeNumber' value='$barcodeNumber'/>
					<input type='hidden' name='submitted' value='true'/>
					<button type='submit' class='submitbtn'>Delete</button>
				</form>
				";
					
			}
		
		
		?>
		
	</body>
</html>