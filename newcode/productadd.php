<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Agile Laptop</title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

		
	</head>
	<body>
		
		<?php
		
		if(isset($_POST['submitted'])){
			$productName=$_POST['productName'];
			$productDescription=$_POST['productDescription'];
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
				$result="INSERT INTO product(productImage, productName,productDescription,productQuantity,productPrice,categoryID) VALUES('$imagefile','$productName','$productDescription',$productQuantity,$productPrice,$categoryID)";
				
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
			print"
			<a href='productlist.php'><button class='submitbtn'>&larr; Back</button></a>
			<h3>Add new product</h3>
			<hr/>
			<form method='post' action='productadd.php' enctype='multipart/form-data'>
				<label for='file'>Upload Image</label><br/>
				<input name='file' type='file'/>
				<br/><br/>
			
				<label for='productName'>Product Name</label><br/>
				<input name='productName' type='text'/>
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
				
				<label for='productQuantity'>Product quantity</label><br/>
				<input name='productQuantity' type='number' min='0.00' step='any' onblur='checkValue()' id='quantityValue'/>
				<br/><br/>
				
				<label for='productPrice'>Product price</label><br/>
				<input name='productPrice' type='number' min='0' onblur='checkPrice()' id='priceValue'/>
				<br/><br/>
				
				<input type='hidden' name='submitted' value='true'/>
				<button type='submit' class='submitbtn'>Submit</button>
			</form>
			
			
			<script>
			
			
				function checkValue(){
					if(document.getElementById('quantityValue').value<0){
						document.getElementById('quantityValue').value = 0;
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
		}
		?>
	</body>
</html>