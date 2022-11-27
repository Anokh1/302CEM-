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

				
								if(isset($_POST['changeimg'])){
									$barcodeNumber=$_POST['barcodeNumber'];
									
									$imagefile=$_FILES['file']['name'];
									$target_directory = 'image/upload/';
									$target_file = $target_directory.basename($_FILES['file']['name']);
									$image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
									$image_file_extensions = array("jpg","jpeg","png");
									$duplicate = false;
									
									

									
									if(!$duplicate){
										$dbc = mysqli_connect('localhost','root','');
										mysqli_select_db($dbc,'agilelaptop');
										if($dbc){
											$result="UPDATE product SET productImage='$imagefile' WHERE barcodeNumber='$barcodeNumber'";
											
												if(@mysqli_query($dbc,$result)){
													print"<a href='productlist.php'><button>&larr; Back</button></a>";
													print"<p>Successfully changed</p>";
													if(!file_exists("image/upload/$imagefile")){
														move_uploaded_file($_FILES['file']['tmp_name'], $target_directory.$imagefile);
													}
													mysqli_close($dbc);
													header('Refresh:3; url=productlist.php');
												}
										}
										else{
											print"query failed";
											mysqli_close($dbc);
										}
									}
									
									
									
								}
								else if(isset($_POST['changequantity'])){
									
									$barcodeNumber=$_POST['barcodeNumber'];
									$productQuantity=$_POST['productQuantity'];

									$dbc = mysqli_connect('localhost','root','');
									mysqli_select_db($dbc,'agilelaptop');
									if($dbc){
										$result="UPDATE product SET productQuantity=$productQuantity WHERE barcodeNumber='$barcodeNumber'";
										
										if(@mysqli_query($dbc,$result)){
											print"<a href='productlist.php'><button>&larr; Back</button></a>";
											print"<p>Successfully changed</p>";
											mysqli_close($dbc);
											header('Refresh:3; url=productlist.php');
										}
										
									}
									else{
										print"query failed";
										mysqli_close($dbc);
									}
									
									
								}
								else if(isset($_POST['changedescription'])){
									$barcodeNumber=$_POST['barcodeNumber'];
									$productDescription=$_POST['productDescription'];

									$dbc = mysqli_connect('localhost','root','');
									mysqli_select_db($dbc,'agilelaptop');
									if($dbc){
										$result="UPDATE product SET productDescription='$productDescription' WHERE barcodeNumber='$barcodeNumber'";
										
										if(@mysqli_query($dbc,$result)){
											print"<a href='productlist.php'><button>&larr; Back</button></a>";
											print"<p>Successfully changed</p>";
											mysqli_close($dbc);
											header('Refresh:3; url=productlist.php');
										}
										
									}
									else{
										print"query failed";
										mysqli_close($dbc);
									}
								}
								
								else if(isset($_POST['changeprice'])){
									$barcodeNumber=$_POST['barcodeNumber'];
									$productPrice=$_POST['productPrice'];

									$dbc = mysqli_connect('localhost','root','');
									mysqli_select_db($dbc,'agilelaptop');
									if($dbc){
										$result="UPDATE product SET productPrice=$productPrice WHERE barcodeNumber='$barcodeNumber'";
										
										if(@mysqli_query($dbc,$result)){
											print"<a href='productlist.php'><button>&larr; Back</button></a>";
											print"<p>Successfully changed</p>";
											mysqli_close($dbc);
											header('Refresh:3; url=productlist.php');
										}

									}
									else{
										print"query failed";
										mysqli_close($dbc);
									}
								}
								
								else if(isset($_POST['changetprice'])){
									$barcodeNumber=$_POST['barcodeNumber'];
									$tradePrice=$_POST['tradePrice'];

									$dbc = mysqli_connect('localhost','root','');
									mysqli_select_db($dbc,'agilelaptop');
									if($dbc){
										$result="UPDATE product SET productTPrice=$tradePrice WHERE barcodeNumber='$barcodeNumber'";
										
										if(@mysqli_query($dbc,$result)){
											print"<a href='productlist.php'><button>&larr; Back</button></a>";
											print"<p>Successfully changed</p>";
											mysqli_close($dbc);
											header('Refresh:3; url=productlist.php');
										}

									}
									else{
										print"query failed";
										mysqli_close($dbc);
									}
								}
								
								else if(isset($_POST['changedate'])){
									$barcodeNumber=$_POST['barcodeNumber'];
									$manufactureDate=$_POST['manufactureDate'];

									$dbc = mysqli_connect('localhost','root','');
									mysqli_select_db($dbc,'agilelaptop');
									if($dbc){
										$result="UPDATE product SET productManuDate=$manufactureDate WHERE barcodeNumber='$barcodeNumber'";
										
										if(@mysqli_query($dbc,$result)){
											print"<a href='productlist.php'><button>&larr; Back</button></a>";
											print"<p>Successfully changed</p>";
											mysqli_close($dbc);
											header('Refresh:3; url=productlist.php');
										}

									}
									else{
										print"query failed";
										mysqli_close($dbc);
									}
								}
								
								else if(isset($_POST['changewarranty'])){
									$barcodeNumber=$_POST['barcodeNumber'];
									$warranty=$_POST['warranty'];

									$dbc = mysqli_connect('localhost','root','');
									mysqli_select_db($dbc,'agilelaptop');
									if($dbc){
										$result="UPDATE product SET productWarranty=$warranty WHERE barcodeNumber='$barcodeNumber'";
										
										if(@mysqli_query($dbc,$result)){
											print"<a href='productlist.php'><button>&larr; Back</button></a>";
											print"<p>Successfully changed</p>";
											mysqli_close($dbc);
											header('Refresh:3; url=productlist.php');
										}

									}
									else{
										print"query failed";
										mysqli_close($dbc);
									}
								}
								
								else if(isset($_POST['changename'])){
									$productName=$_POST['productName'];
									$barcodeNumber=$_POST['barcodeNumber'];
										
									$problem=false;
									
									
									$dbc = mysqli_connect('localhost','root','');
									@mysqli_select_db($dbc,'agilelaptop');
									if($dbc){
										$result=mysqli_query($dbc,"SELECT productName FROM product");
										while($row=mysqli_fetch_array($result)){
											if($productName==$row['productName']){
												$problem = true;
											}
										}
										mysqli_close($dbc);
									}
									
									if(!$problem){
										$dbc = mysqli_connect('localhost','root','');
										mysqli_select_db($dbc,'agilelaptop');
										if($dbc){
											$result="UPDATE product SET productName='$productName' WHERE barcodeNumber='$barcodeNumber'";
											
												if(@mysqli_query($dbc,$result)){
													print"<a href='productlist.php'><button>&larr; Back</button></a>";
													print"<p>Successfully changed</p>";
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
										print"<a href='productlist.php'><button>&larr; Back</button></a>";
										print"<p>The product name already exists!</p>";
									}
								}
								
								
								
								else if(isset($_POST['changecategory'])){
									$categoryID=$_POST['categoryID'];
									$barcodeNumber=$_POST['barcodeNumber'];
										
									$dbc = mysqli_connect('localhost','root','');
									mysqli_select_db($dbc,'agilelaptop');
									if($dbc){
										$result="UPDATE product SET categoryID='$categoryID' WHERE barcodeNumber='$barcodeNumber'";
										
										if(@mysqli_query($dbc,$result)){
											print"<a href='productlist.php'><button>&larr; Back</button></a>";
											print"<p>Successfully changed</p>";
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
									$originalvalue=0;
									$targetproductname="";
									$barcodeNumber=$_GET['barcodeNumber'];
									$dbc = mysqli_connect('localhost','root','');
									mysqli_select_db($dbc,'agilelaptop');
									if($dbc){
										$result=mysqli_query($dbc,"SELECT p.barcodeNumber,p.productImage,p.productName,p.productDescription,c.categoryName,p.productManuDate,p.productQuantity,p.productPrice,p.productTPrice,p.productWarranty FROM product p INNER JOIN category c ON p.categoryID=c.categoryID WHERE barcodeNumber='$barcodeNumber'");
										$row=mysqli_fetch_row($result);
										//$originalvalue=$row[3];
										//$targetproductname=$row[1];
										print"
										<a href='productlist.php'><button>&larr; Back</button></a>
										<h3>Edit Product</h3>
										<hr/>";
										print"
										<table>
											
											<tr>
												<th>Image</th>
												<td><img src='image/upload/".$row[1]."' height='100' width='100'/></td>
												
												<td><form method='post' action='productedit.php' enctype='multipart/form-data'>
												<input name='file' type='file'/>
												<input type='hidden' name='barcodeNumber' value='$barcodeNumber'/>
												<input type='hidden' name='changeimg' value='true'/>
												<button type='submit'>Change</button>
												</form></td>
											</tr>
											<tr>
												<th>Barcode number</th>
												<td>".$row[0]."</td>
												<td></td>
											</tr>
											<tr>
												
												<th>Name</th>
												<td>".$row[2]."</td>
												<td><form method='post' action='productedit.php'>
												<input name='productName' type='text'/>
												<input type='hidden' name='barcodeNumber' value='$barcodeNumber'/>
												<input type='hidden' name='changename' value='true'/>
												<button type='submit'>Change</button>
												</form></td>

											</tr>
											
											<tr>
												<th>Description</th>
												<td>".$row[3]."</td>
												
												<td><form method='post' action='productedit.php'>
												<input name='productDescription' type='text'/>
												<input type='hidden' name='barcodeNumber' value='$barcodeNumber'/>
												<input type='hidden' name='changedescription' value='true'/>
												<button type='submit'>Change</button>
												</form></td>
											</tr>
											
											
											<tr>
												<th>Category</th>
												<td>".$row[4]."</td>
													<td><form method='post' action='productedit.php'>
													<select name='categoryID'>";
													if($dbc){
														$result1=mysqli_query($dbc,"SELECT categoryID,categoryName FROM category");
														while($row1=mysqli_fetch_array($result1)){
															print"<option value='".$row1['categoryID']."'>".$row1['categoryName']."</option>";
														}
														
													}
													
													print"</select>
													<input type='hidden' name='barcodeNumber' value='$barcodeNumber'/>
													<input type='hidden' name='changecategory' value='true'/>
													<button type='submit'>Change</button>
													</form></td>
											</tr>
											
											<tr>
												<th>Manufacture date</th>
												<td>".$row[5]."</td>
												<td><form method='post' action='productedit.php'>
												<input name='manufactureDate' type='date' required/>
												<input type='hidden' name='changedate' value='true'/>
												<button type='submit'>Change</button>
												</form></td>
											</tr>
											<tr>
												<th>Quantity</th>
												<td>";
												if($row[6]==0){
													print"Out of Stock";	
												}
												else{
													print"".$row[6]."";
												}
												print"</td>
												<td><form action='productedit.php' method='post'>
												<div class='slidecontainer'>
													  <input name='productQuantity' type='range' min='1' max='20' value='0' class='slider' id='quantityRange'>
													  <p>Value: <span id='quantityvalue'></span></p>
												</div>
												<input type='hidden' name='barcodeNumber' value='$barcodeNumber'>
												<input type='hidden' name='changequantity' value='true'>
												<button type='submit'>Change</button>
												</form></td>
											</tr>
											<tr>
												<th>Retail price</th>
												<td>".$row[7]."</td>
												
												<td><form method='post' action='productedit.php'>
												<div class='slidecontainer'>
													  <input name='productPrice' type='range' min='1' max='100' value='50' class='slider' id='priceRange'>
													  <p>Value: <span id='pricevalue'></span></p>
												</div>
												<input type='hidden' name='barcodeNumber' value='$barcodeNumber'/>
												<input type='hidden' name='changeprice' value='true'/>
												<button type='submit'>Change</button>
												</form></td>
											</tr>
											<tr>
												<th>Trade price</th>
												<td>".$row[8]."</td>
												
												<td><form method='post' action='productedit.php'>
												<div class='slidecontainer'>
													 <input name='tradePrice' type='range' min='1' max='100' value='50' class='slider' id='tradeRange'>
													 <p>Value: <span id='tradevalue'></span></p>
												</div>
												<input type='hidden' name='barcodeNumber' value='$barcodeNumber'/>
												<input type='hidden' name='changetprice' value='true'/>
												<button type='submit'>Change</button>
												</form></td>
											</tr>
											
											<tr>
												<th>Warranty</th>
												<td>".$row[9]."</td>
												
												<td><form method='post' action='productedit.php'>
												<input name='warranty' type='radio' value='false' checked/>Not Available<br/>
												<input name='warranty' type='radio' value='true'/>Available
												<input type='hidden' name='barcodeNumber' value='$barcodeNumber'/>
												<input type='hidden' name='changewarranty' value='true'/><br/>
												<button type='submit'>Change</button>
												</form></td>
											</tr>

										</table>";
									}
									mysqli_close($dbc);
									print"<br/>";

									print"
									<script>
										var slider1 = document.getElementById('quantityRange');
										var output1 = document.getElementById('quantityvalue');
										output1.innerHTML = slider1.value;
										slider1.oninput = function() {
											output1.innerHTML = this.value;
										}
										
										var slider2 = document.getElementById('priceRange');
										var output2 = document.getElementById('pricevalue');
										output2.innerHTML = slider2.value;
										slider2.oninput = function() {
											output2.innerHTML = this.value;
										}
										
										var slider3 = document.getElementById('tradeRange');
										var output3 = document.getElementById('tradevalue');
										output3.innerHTML = slider3.value;
										slider3.oninput = function() {
											output3.innerHTML = this.value;
										}
										
										
										
									</script>
									";
								//window.alert('No negative value!');

								}
								//use js script to modify the input value when button clicked
								
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