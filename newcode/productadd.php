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
		
							if(isset($_POST['submitted'])){
								$barcodeNumber=$_POST['barcodeNumber'];
								$errormsg = "";
								$found=false;
								$problem = false;
								
								$dbc = mysqli_connect('localhost','root','');
								@mysqli_select_db($dbc,'agilelaptop');
								if($dbc){
									$result=mysqli_query($dbc,"SELECT barcodeNumber FROM product");
									while($row=mysqli_fetch_array($result)){
										if($barcodeNumber==$row['barcodeNumber']){
											$found=true;
										}
									}
									if($found==true){
										$errormsg .= "The barcodeNumber is being used!<br/>";
										$problem = true;
									}
								}
								mysqli_close($dbc);
								
								
								if(empty($_FILES['file']['name'])){
									$errormsg .= "Please include file<br/>";
									$problem=true;
								}
								
								if(!$problem){
									$manufactureDate=$_POST['manufactureDate'];
									$tradePrice=$_POST['tradePrice'];
									$warranty=$_POST['warranty'];
									
									
									$productName=$_POST['productName'];
									$productDescription=$_POST['productDescription'];							
									$productDescription=str_replace('\'','\\\'',$productDescription);
									$productDescription=str_replace('\"','\\\"',$productDescription);
									
									$categoryID=$_POST['categoryID'];
									$productQuantity=$_POST['productQuantity'];
									$productPrice=$_POST['productPrice'];
									
									
									$imagefile=$_FILES['file']['name'];
									$target_directory = 'image/upload/';
									$target_file = $target_directory.basename($_FILES['file']['name']);
									
									$image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
									
									$image_file_extensions = array("jpg","jpeg","png");
									
									
									
									$dbc = mysqli_connect('localhost','root','');
									mysqli_select_db($dbc,'agilelaptop');
									if($dbc&& in_array($image_file_type, $image_file_extensions)){
										$result="INSERT INTO product(barcodeNumber,productImage,productName,productDescription,productQuantity,productPrice,productTPrice,productManuDate,productWarranty,categoryID) VALUES('$barcodeNumber','$imagefile','$productName','$productDescription',$productQuantity,$productPrice,$tradePrice,'$manufactureDate',$warranty,$categoryID)";
										
										if(@mysqli_query($dbc,$result)){
											move_uploaded_file($_FILES['file']['tmp_name'], $target_directory.$imagefile);
											print"<a href='productlist.php'><button>&larr; Back</button></a>";
											print"<p>Successfully added</p>";
											header('Refresh:3; url=productlist.php');
										}
										
									}
									else{
										print"query failed";
										mysqli_close($dbc);
									}
								}
								else{
									print"$errormsg";
									print"<a href='productadd.php'><button>Back</button></a>";
								}
							}
							else{
								print"
								<a href='productlist.php'><button class='submitbtn'>&larr; Back</button></a>
								<h3>Add new product</h3>
								<hr/>
								<form method='post' action='productadd.php' enctype='multipart/form-data'>
									<label for='file'>Upload Image</label><br/>
									<input name='file' type='file' required/>
									<br/><br/>
									
									<label for='barcodeNumber'>Barcode number</label><br/>
									<input name='barcodeNumber' type='text' required/>
									<br/><br/>
								
									<label for='productName'>Product Name</label><br/>
									<input name='productName' type='text' required/>
									<br/><br/>
									
									<label for='productDescription'>Product description</label><br/>
									<textarea name='productDescription' rows='7' cols='50' ></textarea>
									<br/><br/>
									
									<label for='categoryID'>Product category: </label>
									<select name='categoryID'>";
										$dbc = mysqli_connect('localhost','root','');
										@mysqli_select_db($dbc,'agilelaptop');
										if($dbc){
											$result=mysqli_query($dbc,"SELECT categoryID,categoryName FROM category");
											while($row=mysqli_fetch_array($result)){
												print"<option value='".$row['categoryID']."'>".$row['categoryName']."</option>";
											}
											mysqli_close($dbc);
										}

									print"
									</select>
									<br/><br/>
									
									<label for='manufactureDate'>Manufacture Date</label><br/>
									<input name='manufactureDate' type='date' required/>
									<br/><br/>
									
									<label for='productQuantity'>Product quantity</label><br/>
									<div class='slidecontainer'>
										  <input name='productQuantity' type='range' min='1' max='20' value='0' class='slider' id='quantityRange'>
										  <p>Value: <span id='quantityvalue'></span></p>
									</div>
									<br/>
									
									<label for='productPrice'>Retail price</label><br/>
									<div class='slidecontainer'>
										  <input name='productPrice' type='range' min='1' max='100' value='50' class='slider' id='priceRange'>
										  <p>Value: <span id='pricevalue'></span></p>
									</div>
									<br/>
									
									<label for='tradePrice'>Trade price</label><br/>
									<div class='slidecontainer'>
										  <input name='tradePrice' type='range' min='1' max='100' value='50' class='slider' id='tradeRange'>
										  <p>Value: <span id='tradevalue'></span></p>
									</div>
									<br/>
									
									<label for='warranty'>Warranty</label><br/>
									<input name='warranty' type='radio' value='false' checked/>Not Available<br/>
									<input name='warranty' type='radio' value='true'/>Available
									<br/><br/>
									
									<input type='hidden' name='submitted' value='true'/>
									<button type='submit' class='submitbtn'>Submit</button>
								</form>
								
								
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
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>