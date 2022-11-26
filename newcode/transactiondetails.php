<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Light Cinema</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		
		<link rel='stylesheet' href='css/general.css'>
		<link rel='stylesheet' href='css/general2.css'>
		<link rel='stylesheet' href='css/myacc.css'>
	</head>
	
	<body>
		<?php
			include'include/dbmanager.php';
			include'include/header.php';
		?>
		

		
		
		<div class='pagecontent container-fluid p-0'>
			<div class='row mr-0'>
				<?php
					include'include/accsidenav.php';
				?>
				
				
				<div class='articledetail col-lg-8 col-md-8 col-sm-8 col-xs-8'>
					<h3>Transaction history</h3>
					<hr/>
					<?php
					$transactionID=$_GET["transactionID"];
					
					
					
					print"
						<table class='displaytable'>
							<tr>
								<th>PurchaseID</th>
								<th>Details</th>
								<th>Date</th>
								<th>Time</th>
								<th>Price</th>
							</tr>";
							$count=1;
							
							if(isset($_SESSION['userID'])){
								$userID = $_SESSION['userID'];
							}
							
							$dbc = mysqli_connect('localhost','root','');
							@mysqli_select_db($dbc,'agilelaptop');
							if($dbc){
								$result=mysqli_query($dbc,"SELECT * FROM transaction WHERE transactionID=$transactionID");
								while($row=mysqli_fetch_array($result)){
									print"<tr>";
									print"<td>PID$count</td>";
									
									print"<td><table><tr><th>Product name</th><th>Quantity</th><th>Unit price</th></tr>";
									$contentarray=json_decode($row['transactionContent'], true);
									foreach ($contentarray as $item){
										
										print"<tr>";
										print"<td>".$item['productName']."</td>";
										print"<td>".$item['quantity']."</td>";
										print"<td>".$item['productPrice']."</td>";
										print"</tr>";
									}
									print"</table></td>";
									print"<td>".$row['transactionDate']."</td>";
									print"<td>".$row['transactionTime']."</td>";
									print"<td>RM ".number_format($row['transactionPrice'],2)."</td>";
									
									print"</tr>";
									$count++;
								}
								if($count==1){
									print"<td colspan='8'>No transaction history</td>";
								}
							}
							mysqli_close($dbc);
							print"
						</table>";
					
					?>
				</div>
				
			</div>
		</div>
		
		<?php
			//alert success
			include'include/footer.php';
		?>
		
		<script src='js/sidemenu.js'></script>
		
		
	</body>
</html>