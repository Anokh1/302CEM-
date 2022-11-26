<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Agile Laptop</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<script src="js/pagination.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.css"/>
		
		
		<link rel='stylesheet' href='css/general.css'/>
		<link rel='stylesheet' href='css/general2.css'/>
		<link rel='stylesheet' href='css/register.css'>

	</head>
	
	<body>
		<?php
			include'include/dbmanager.php';
			include'include/header.php';
			if(!isset($_SESSION['userID'])){
				print"<p>You must be logged in to view this page, <a href='login.php'>Login here</a></p>";
			}
			else{
		?>
		<?php
			if(!empty($_GET["action"])) {
				switch($_GET["action"]) {
					case "add":
						if(!empty($_GET["quantity"])) {
							
							$barcodeNumber=$_GET['barcodeNumber'];
							
												
							$dbc = mysqli_connect('localhost','root','');
							@mysqli_select_db($dbc,'agilelaptop');

							$result=mysqli_query($dbc,"SELECT * FROM product WHERE barcodeNumber='$barcodeNumber'");

							while($row=mysqli_fetch_assoc($result)){
								$productDataArray[] = $row;
							}
							
							$code="C".$productDataArray[0]["barcodeNumber"];
							$itemArray = array($code=>array('productName'=>$productDataArray[0]["productName"], 'barcodeNumber'=>$productDataArray[0]["barcodeNumber"], 'quantity'=>$_GET["quantity"], 'productPrice'=>$productDataArray[0]["productPrice"], 'productImage'=>$productDataArray[0]["productImage"]));
							
							if(!empty($_SESSION["cart_item"])) {
								if(in_array($code,array_keys($_SESSION["cart_item"]))) {
									foreach($_SESSION["cart_item"] as $k => $v) {
										if($code == $k) {
											if(empty($_SESSION["cart_item"][$k]["quantity"])) {
												$_SESSION["cart_item"][$k]["quantity"] = 0;
											}
											$_SESSION["cart_item"][$k]["quantity"] += $_GET["quantity"];
										}
									}
									
								} 
								else {

									$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
								}
							} 
							else {
								$_SESSION["cart_item"] = $itemArray;
							}
						}
						mysqli_close($dbc);
						header('Refresh:0; url=shoppingcart.php');
						break;
					case "remove":
						if(!empty($_SESSION["cart_item"])) {
							foreach($_SESSION["cart_item"] as $k => $v) {
									if("C".$_GET["barcodeNumber"] == $k)
										unset($_SESSION["cart_item"][$k]);				
									if(empty($_SESSION["cart_item"]))
										unset($_SESSION["cart_item"]);
							}
						}
						header('Refresh:0; url=shoppingcart.php');
						break;
					case "empty":
						unset($_SESSION["cart_item"]);
						header('Refresh:0; url=shoppingcart.php');
						break;	
				}
			}
		?>
		
		
		
		
		<div class='container-fluid pr-0'>
			<div class='row mr-0'>
				<div class='pagecontent col-lg-12 col-md-12 col-sm-12 col-xs-12'>
					<a id="btnEmpty" href="shoppingcart.php?action=empty">Empty Cart</a>
					<?php
					if(isset($_SESSION["cart_item"])){
						$total_quantity = 0;
						$total_price = 0;
					?>
					<table class="tbl-cart" cellpadding="10" cellspacing="1">
					<tbody>
					<tr>
					<th style="text-align:left;" width="15%">Product Image</th>
					<th style="text-align:left;">Name</th>
					<th style="text-align:right;" width="5%">Quantity</th>
					<th style="text-align:right;" width="10%">Unit Price</th>
					<th style="text-align:right;" width="10%">Price</th>
					<th style="text-align:center;" width="5%">Remove</th>
					</tr>
					<?php		
					foreach ($_SESSION["cart_item"] as $item){
						$item_price = $item["quantity"]*$item["productPrice"];
						?>
								<tr>
								<td><img src='image/upload/<?php echo $item["productImage"]; ?>' height='100' width='100'></td>
								<td><?php echo $item["productName"]; ?></td>
								<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
								<td  style="text-align:right;"><?php echo "$ ".number_format($item["productPrice"],2); ?></td>
								<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
								<td style="text-align:center;"><a href="shoppingcart.php?action=remove&barcodeNumber=<?php echo $item["barcodeNumber"]; ?>" class="btnRemoveAction">Remove</a></td>
								</tr>
								<?php
								$total_quantity += $item["quantity"];
								$total_price += ($item["productPrice"]*$item["quantity"]);
						}
						?>

					<tr>
					<td align="right" colspan="2">Total:</td>
					<td align="right"><?php echo $total_quantity; ?></td>
					<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
					</tr>
					</tbody>
					</table>
					
					<a href='checkout.php'><button>Buy</button></a>
					  <?php
					} else {
					?>
					<div class="no-records">Your Cart is Empty</div>
					<?php 
					}
					?>		

				
				</div>
			</div>
		</div>
		
		
		<?php 
			}
		include'include/footer.php';?>
		
		<script src='js/sidemenu.js'></script>
	</body>
</html>