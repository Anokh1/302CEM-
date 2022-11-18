<?php
$dbc = mysqli_connect('localhost','root','');
		
$sql = "CREATE DATABASE IF NOT EXISTS agilelaptop";
mysqli_query($dbc,$sql);

if(mysqli_select_db($dbc,'agilelaptop')){
	
	$sql1 = "CREATE TABLE IF NOT EXISTS product (barcodeNumber int(10) AUTO_INCREMENT NOT NULL,productName varchar(50),productImage varchar(50), productDescription text,productQuantity int(10) UNSIGNED,productPrice double,categoryID int NOT NULL,PRIMARY KEY (barcodeNumber),FOREIGN KEY (categoryID) REFERENCES category(categoryID))";
	mysqli_query($dbc,$sql1);
	
	$sql2 = "CREATE TABLE IF NOT EXISTS category (categoryID int(11) AUTO_INCREMENT NOT NULL,categoryName varchar(50),isDefault boolean,PRIMARY KEY (categoryID))";
	mysqli_query($dbc,$sql2);
	
	$query1="INSERT IGNORE INTO category (categoryID,categoryName,isDefault)
			VALUES(1,'Other',true)";
				
	if(@mysqli_query($dbc,$query1)){

	}
	else{
		echo"ERROR! Table not found!";
	}
	
	$sql3 = "CREATE TABLE IF NOT EXISTS review (reviewID int(11) AUTO_INCREMENT NOT NULL,reviewRating int(2),reviewMsg text,reviewDate date,reviewTime time,userID int(11) NOT NULL,barcodeNumber int(11) NOT NULL, PRIMARY KEY (reviewID), FOREIGN KEY (barcodeNumber) REFERENCES product(barcodeNumber))";
	mysqli_query($dbc,$sql3);
	
}
else{
	print"ERROR! DB not found!";
}
mysqli_close($dbc);
?>