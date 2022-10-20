<?php

$productDataArray=array();
								
$dbc = mysqli_connect('localhost','root','');
@mysqli_select_db($dbc,'agilelaptop');

$result=mysqli_query($dbc,"SELECT barcodeNumber,productName,productImage FROM product");
while($row=mysqli_fetch_array($result)){
	$productDataArray[] = $row;
}
mysqli_close($dbc);

echo json_encode($productDataArray);

?>