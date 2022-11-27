<?php
$dbc = mysqli_connect('localhost','root','');
		
$sql = "CREATE DATABASE IF NOT EXISTS agilelaptop";
mysqli_query($dbc,$sql);

if(mysqli_select_db($dbc,'agilelaptop')){
	
	$sql1 = "CREATE TABLE IF NOT EXISTS category (categoryID int(11) AUTO_INCREMENT NOT NULL,categoryName varchar(50),isDefault boolean,PRIMARY KEY (categoryID))";
	mysqli_query($dbc,$sql1);
	
	$query1="INSERT IGNORE INTO category (categoryID,categoryName,isDefault)
			VALUES(1,'Other',true)";
				
	if(@mysqli_query($dbc,$query1)){

	}
	else{
		echo"ERROR! Table not found!";
	}
	
	
	
	$sql2 = "CREATE TABLE IF NOT EXISTS product (barcodeNumber varchar(50) NOT NULL,productName varchar(50),productImage varchar(50), productDescription text,productQuantity int(10) UNSIGNED,productPrice double(10,2),productTPrice double(10,2),productManuDate date,productWarranty boolean,categoryID int NOT NULL,PRIMARY KEY (barcodeNumber),FOREIGN KEY (categoryID) REFERENCES category(categoryID))";
	mysqli_query($dbc,$sql2);
	
	$sql3 = "CREATE TABLE IF NOT EXISTS users (userID int(11) AUTO_INCREMENT NOT NULL,username varchar(50),password varchar(20), accountType varchar(30),firstname varchar(30),lastname varchar(30),phone varchar(15),email varchar(30),cardNum varchar(30),cardType varchar(20),loyaltypoint int(10),PRIMARY KEY (userID))";
	mysqli_query($dbc,$sql3);
	
	$query2="INSERT IGNORE INTO users (userID,username,password,accountType)
			VALUES(1,'customer1','p455w0rd','User')";
				
	if(@mysqli_query($dbc,$query2)){

	}
	else{
		echo"ERROR! Table not found!";
	}
	
	$query2="INSERT IGNORE INTO users (userID,username,password,accountType)
			VALUES(2,'customer2','p455w0rd','User')";
				
	if(@mysqli_query($dbc,$query2)){

	}
	else{
		echo"ERROR! Table not found!";
	}
	
	$query2="INSERT IGNORE INTO users (userID,username,password,accountType)
			VALUES(3,'admin','p455w0rd','Admin')";
				
	if(@mysqli_query($dbc,$query2)){

	}
	else{
		echo"ERROR! Table not found!";
	}
	
	$sql4 = "CREATE TABLE IF NOT EXISTS review (reviewID int(11) AUTO_INCREMENT NOT NULL,reviewRating int(2),reviewMsg text,reviewDate date,reviewTime time,userID int(11) NOT NULL,barcodeNumber varchar(50) NOT NULL, PRIMARY KEY (reviewID), FOREIGN KEY (barcodeNumber) REFERENCES product(barcodeNumber), FOREIGN KEY (userID) REFERENCES users(userID))";
	mysqli_query($dbc,$sql4);
	
	$sql5="CREATE TABLE IF NOT EXISTS transaction (transactionID int (11) AUTO_INCREMENT NOT NULL, transactionContent JSON,transactionPrice double(10,2), transactionDate date, transactionTime time,userID int(11), PRIMARY KEY (transactionID),FOREIGN KEY (userID) REFERENCES users(userID))";
	mysqli_query($dbc,$sql5);
	
	

	
	
}
else{
	print"ERROR! DB not found!";
}
mysqli_close($dbc);
?>