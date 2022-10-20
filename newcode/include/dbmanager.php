<?php
$dbc = mysqli_connect('localhost','root','');
		
$sql = "CREATE DATABASE IF NOT EXISTS agilelaptop";
mysqli_query($dbc,$sql);

if(mysqli_select_db($dbc,'agilelaptop')){
	
	$sql1 = "CREATE TABLE IF NOT EXISTS product (barcodeNumber int(10) AUTO_INCREMENT NOT NULL,productName varchar(50),productImage varchar(50), description text,quantity int(10),productType varchar(50),productPrice double,productWarranty boolean,productWExpire date,PRIMARY KEY (barcodeNumber))";
	mysqli_query($dbc,$sql1);
	
}
else{
	echo"ERROR! DB not found!";
}
mysqli_close($dbc);
?>