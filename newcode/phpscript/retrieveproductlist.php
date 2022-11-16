<?php

$productDataArray=array();
								
$dbc = mysqli_connect('localhost','root','');
@mysqli_select_db($dbc,'agilelaptop');

$result=mysqli_query($dbc,"SELECT p.barcodeNumber,p.productImage,p.productName,c.categoryName,p.productQuantity,p.productPrice FROM product p INNER JOIN category c ON p.categoryID=c.categoryID ORDER BY p.barcodeNumber");

//p.productID,p.productName,c.categoryName,p.productQuantity FROM product p INNER JOIN category c ON p.categoryID=c.categoryID ORDER BY p.productID

while($row=mysqli_fetch_array($result)){
	$productDataArray[] = $row;
}
mysqli_close($dbc);

echo json_encode($productDataArray);

?>