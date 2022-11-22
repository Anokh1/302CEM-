<?php

if(isset($_GET['searchCategory'])){
	$query=$_GET['searchCategory'];
	
	$categoryDataArray=array();
								
	$dbc = mysqli_connect('localhost','root','');
	@mysqli_select_db($dbc,'agilelaptop');

	$result=mysqli_query($dbc,"SELECT * FROM category WHERE categoryName LIKE '%$query%' ORDER BY categoryID");
	while($row=mysqli_fetch_array($result)){
		$categoryDataArray[] = $row;
	}
	mysqli_close($dbc);


	echo json_encode($categoryDataArray);
}
else{
	$categoryDataArray=array();
									
	$dbc = mysqli_connect('localhost','root','');
	@mysqli_select_db($dbc,'agilelaptop');

	$result=mysqli_query($dbc,"SELECT * FROM category ORDER BY categoryID");
	while($row=mysqli_fetch_array($result)){
		$categoryDataArray[] = $row;
	}
	mysqli_close($dbc);


	echo json_encode($categoryDataArray);
}
?>