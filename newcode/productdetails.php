<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Agile Laptop</title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

		<link rel='stylesheet' href='css/productreview.css'>
	</head>
	<body>
		<?php
			
			include('include/dbmanager.php');
			include('include/session.php');
			
			
			
			if(isset($_POST['submitreview'])){
				$barcodeNumber=$_POST['barcodeNumber'];
				$userID=$_POST['userID'];
				$rate=$_POST['rate'];
				$reviewMsg=$_POST['reviewMsg'];
				
				date_default_timezone_set('Asia/Kuala_Lumpur');
				$currdate=date("Y-m-d");
				$currtime=date("H:i:s");
				
				
				$dbc = mysqli_connect('localhost','root','');
				mysqli_select_db($dbc,'agilelaptop');
				if($dbc){
					
					
					$result="INSERT INTO review(reviewRating,reviewMsg,reviewDate,reviewTime,userID,barcodeNumber) VALUES($rate,'$reviewMsg','$currdate','$currtime',$userID,$barcodeNumber)";
					
					if(@mysqli_query($dbc,$result)){
						print"Added";
						mysqli_close($dbc);
						header('Refresh:1; url=productdetails.php?barcodeNumber='.$barcodeNumber.'');
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
					<a href='catalog.php'><button>&larr; Back</button></a>
					<h3>Product details</h3>
					<hr/>";
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
					mysqli_close($dbc);
				}
				
				
				print"<a href='#'><button>Buy</button></a>";
				print"<a href='#'><button>Add to cart</button></a>";
				
				print"<br/><br/><br/>";
				print"<h4>Review</h4>";
				
				print"<ul>";
				
				$dbc = mysqli_connect('localhost','root','');
				@mysqli_select_db($dbc,'agilelaptop');
				if($dbc){
					$result1=mysqli_query($dbc,"SELECT COUNT(*) as total FROM review WHERE barcodeNumber=$barcodeNumber");
					while($row=mysqli_fetch_array($result1)){
						$reviewcount=$row['total'];
					}
					if($reviewcount!=0){
						$result2=mysqli_query($dbc,"SELECT u.username,r.* FROM review r INNER JOIN users u ON r.userID=u.userID WHERE barcodeNumber=$barcodeNumber");
						while($row=mysqli_fetch_array($result2)){
							print"<li><p>".$row['username']." ".$row['reviewDate']." ".$row['reviewTime']."</p>";
							
							print"<div class='starcolor'>";
							for($x=0;$x<$row['reviewRating'];$x++){
								print"★";
							}
							print"</div>";
							print"<p>".$row['reviewMsg']."</p></li>";
						}

					}
					else{
						print"There are no review available";
					}
					mysqli_close($dbc);
				}
				
				
				
				print"</ul>";
				print"<hr/>";
				//if logged in show comment field, add user id input
				if(isset($_SESSION['userID'])){
					$userID=$_SESSION['userID'];
					print"
					<form method='post' action='productdetails.php'>
						<textarea name='reviewMsg' rows='7' cols='50' required></textarea>
						<br/>

						<div class='rate'>
							<input type='radio' id='star5' name='rate' value='5' />
							<label for='star5' title='text'>5 stars</label>
							<input type='radio' id='star4' name='rate' value='4' />
							<label for='star4' title='text'>4 stars</label>
							<input type='radio' id='star3' name='rate' value='3' />
							<label for='star3' title='text'>3 stars</label>
							<input type='radio' id='star2' name='rate' value='2' />
							<label for='star2' title='text'>2 stars</label>
							<input type='radio' id='star1' name='rate' value='1' />
							<label for='star1' title='text'>1 star</label>
						</div>

						<br/><br/>
						<input type='hidden' name='barcodeNumber' value='$barcodeNumber'/>
						<input type='hidden' name='userID' value='$userID'/>
						<input type='hidden' name='submitreview' value='true'/>
						<button type='submit'>Submit</button>
					</form>
				";
				}
				else{
					print"You need to be logged in to review! <a href='login.php'>login</a>";
				}
			}
			
			
		?>
		
		
	</body>
</html>