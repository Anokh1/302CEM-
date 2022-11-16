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
						$result="UPDATE product SET productImage='$imagefile' WHERE barcodeNumber=$barcodeNumber";
						
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
				$newValue=$_POST['newValue'];

				$dbc = mysqli_connect('localhost','root','');
				mysqli_select_db($dbc,'agilelaptop');
				if($dbc){
					$result="UPDATE product SET productQuantity=$newValue WHERE barcodeNumber=$barcodeNumber";
					
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
					$result="UPDATE product SET productDescription='$productDescription' WHERE barcodeNumber=$barcodeNumber";
					
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
					$result="UPDATE product SET productPrice=$productPrice WHERE barcodeNumber=$barcodeNumber";
					
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
						$result="UPDATE product SET productName='$productName' WHERE barcodeNumber=$barcodeNumber";
						
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
					$result="UPDATE product SET categoryID='$categoryID' WHERE barcodeNumber=$barcodeNumber";
					
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
					$result=mysqli_query($dbc,"SELECT p.barcodeNumber,p.productImage,p.productName,p.productDescription,c.categoryName,p.productQuantity,p.productPrice FROM product p INNER JOIN category c ON p.categoryID=c.categoryID WHERE barcodeNumber=$barcodeNumber");
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
							<th>Quantity</th>
							<td>";
							if($row[5]==0){
								print"Out of Stock";	
							}
							else{
								print"".$row[5]."";
							}
							print"</td>
							<td><form name='addQuantity' method='post'>
							<button type='button' onclick='minusBtn()'>-1</button>
							<input type='number' min='0' name='newValue' id='chgValue' value='".$row[5]."' onblur='checkvalue()'/>
							<button type='button' onclick='addBtn()'>+1</button>
							<input type='hidden' name='barcodeNumber' value='$barcodeNumber'>
							<input type='hidden' name='changequantity' value='true'>
							<button type='submit'>Change</button>
							</form></td>
						</tr>
						<tr>
							<th>Price</th>
							<td>".$row[6]."</td>
							
							<td><form method='post' action='productedit.php'>
							<input name='productPrice' type='number' min='0.00' id='priceValue' onblur='checkPrice()' value='".$row[6]."' step='any'/>
							<input type='hidden' name='barcodeNumber' value='$barcodeNumber'/>
							<input type='hidden' name='changeprice' value='true'/>
							<button type='submit'>Change</button>
							</form></td>
						</tr>

					</table>";
				}
				mysqli_close($dbc);
				print"<br/>";

				print"
				<script>
					var orivalue=$originalvalue;
					
					function addBtn(){
						var value = document.forms['addQuantity']['addValue'].value;
						value=parseInt(value)+1;
						document.getElementById('addValue').value = value;
						document.getElementById('realvalue').innerHTML=' +'+document.getElementById('addValue').value+'';
					}
					
					function minusBtn(){
						var value = document.forms['addQuantity']['addValue'].value;
						if(!(value<1)){
							value=value-1;
							document.getElementById('addValue').value = value;
							document.getElementById('realvalue').innerHTML=' +'+document.getElementById('addValue').value+'';
						}
						
					}
					
					function checkvalue(){
						if(document.getElementById('chgValue').value<0){
							document.getElementById('chgValue').value = 0;
							window.alert('No negative value!');
						}
					}
					
					function checkPrice(){
						var error='';
						var problem=false;
						if(document.getElementById('priceValue').value<0){
							document.getElementById('priceValue').value = 0;
							error+='No negative value!';
							problem=true;
						}
						document.getElementById('priceValue').value = parseFloat(document.getElementById('priceValue').value).toFixed(2);

						if(problem){
							window.alert(error);
						}
						
					}
					
				</script>
				";
			//window.alert('No negative value!');

			}
			//use js script to modify the input value when button clicked
			
		?>
		
		
		
	</body>
</html>