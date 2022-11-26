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
		<script src="js/pagination.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.css"/>
		
		
		<link rel='stylesheet' href='css/general.css'/>
		<link rel='stylesheet' href='css/general2.css'/>
		<link rel='stylesheet' href='css/catalog.css'/>

	</head>
	
	<body>
		<?php
			include'include/dbmanager.php';
			include'include/header.php';
			
		?>
		<div class='container-fluid pr-0'>
			<div class='row mr-0'>
				<div class='catalog col-lg-12 col-md-12 col-sm-12 col-xs-12'>
				
				
				
				
				
					<?php
					if(isset($_POST['submitted'])){
						
						$cardnum=$_POST['cardnum'];
						$cardtype=$_POST['cardtype'];
						
						$problem=false;
						$errormsg="";
						
						switch($cardtype){
							case "Visa":
								if(!preg_match ("/^(?:4[0-9]{12}(?:[0-9]{3})?)$/",$cardnum)){
									$errormsg="Invalid Visa card number!";
									$problem=true;
								}
								break;
							case "MasterCard":
								if(!preg_match ("/^(?:5[1-5][0-9]{14})$/",$cardnum)){
									$errormsg="Invalid MasterCard card number!";
									$problem=true;
								}
								break;
							case "American Express":
								if(!preg_match ("/^(?:3[47][0-9]{13})$/",$cardnum)){
									$errormsg="Invalid American Express card number!";
									$problem=true;
								}
								break;
						}
						
						if($problem){
							print"<div class='alert alert-danger'><strong>Error!</strong><br/>";
								if(!empty($errormsg)){
									print"$errormsg<br/>";
								}
							print"</div>";
							print"<a href='confirmation.php'><button class='submitbtn'>&larr; Back</button></a>";
						}
						else{
							
							
							
							$dbc = mysqli_connect('localhost','root','');
							if(mysqli_select_db($dbc,'agilelaptop')){
								//handle stock
								foreach ($_SESSION["cart_item"] as $item){
									$tempPID=$item["barcodeNumber"];
									
									if($dbc){
										$result=mysqli_query($dbc,"SELECT productQuantity FROM product WHERE barcodeNumber='$tempPID'");
										$row=mysqli_fetch_row($result);
										
										$tempPID=$item["barcodeNumber"];
										$newValue=$row[0]-$item["quantity"];
										
										
										$result="UPDATE product SET productQuantity=$newValue WHERE barcodeNumber='$tempPID'";
										
										if(@mysqli_query($dbc,$result)){
											
										}
										
									}
									else{
										print"query failed";
										mysqli_close($dbc);
									}
								}
								
								$jsoncontent=json_encode($_SESSION["cart_item"]);
								$total_price=0;
								foreach ($_SESSION["cart_item"] as $item){
									$total_price+=$item["productPrice"]*$item["quantity"];
								}
								date_default_timezone_set('Asia/Kuala_Lumpur');
								$currdate=date("Y-m-d");
								$currtime=date("H:i:s");
								
								$userID=$_SESSION['userID'];
								
								$query="INSERT INTO transaction (transactionContent,transactionPrice,transactionDate,transactionTime,userID)
										VALUES('$jsoncontent',$total_price,'$currdate','$currtime',$userID)";
								
								if(@mysqli_query($dbc,$query)or trigger_error("Query Failed! SQL: $query - Error: ".mysqli_error($dbc), E_USER_ERROR)){
									unset($_SESSION["cart_item"]);
									print"<p>Successfully purchased!</p>";
									print"<a href='catalog.php'><button>Home</button></a>";
									unset($_SESSION['booking']);
									mysqli_close($dbc);
								}
								else{
									echo"ERROR! Table not found!";
									mysqli_close($dbc);
								}
							}
						
						}
						
						
					}
					else{
						?>
						<h3>Checkout</h3>
						<?php
						if(isset($_SESSION["cart_item"])){
							$total_quantity = 0;
							$subtotal_price = 0.0;
							$total_price = 0.0;
							$deliveryprice=0.0;
							$loyaltypoint=0;
						?>
						<table class="tbl-cart" cellpadding="10" cellspacing="1">
						<tbody>
						<tr>
						<th style="text-align:left;" width="15%">Product Image</th>
						<th style="text-align:left;">Name</th>
						<th style="text-align:right;" width="5%">Quantity</th>
						<th style="text-align:right;" width="10%">Unit Price</th>
						<th style="text-align:right;" width="10%">Price</th>
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
								</tr>
								<?php
								$total_quantity += $item["quantity"];
								$subtotal_price += ($item["productPrice"]*$item["quantity"]);
						}
						?>
						
						<?php
						$deliveryprice=$subtotal_price*5.0/100.0;
						$total_price=$subtotal_price+$deliveryprice;
						$loyaltypoint=($total_price*2.0/100.0)%100;
						?>
						
						<tr>
						<td align="right" colspan="2"></td>
						<td align="right"><?php echo $total_quantity; ?></td>
						<td align="right" colspan="2"><strong><?php echo "RM ".number_format($subtotal_price, 2); ?></strong></td>
						</tr>
						<tr>
						<td align="right" colspan="2">Delivery fee</td>
						<td align="right">5%</td>
						<td align="right" colspan="2"><strong><?php echo "RM ".number_format($deliveryprice, 2); ?></strong></td>
						</tr>
						<tr>
						<td align="right" colspan="2">Total</td>
						<td align="right">5%</td>
						<td align="right" colspan="2"><strong><?php echo "RM ".number_format($total_price, 2); ?></strong></td>
						</tr>
						<tr>
						<td align="right" colspan="2">Loyalty point</td>
						<td align="right">2%</td>
						<td align="right" colspan="2"><strong><?php echo number_format($loyaltypoint, 0)." point(s)"; ?></strong></td>
						</tr>
						</tbody>
						</table>
						<?php 
						} 
						?>
						<h3>Choose a payment method</h3>
						<?php
						$userID=$_SESSION['userID'];
						
						print"
						
						<h3>Payment</h3>
						<form method='post' action='checkout.php' name='paymetform' onsubmit='return checkpaymet()'>
						
							<label>Select payment method:</label>
							<br/>
							<input name='selmet' type='radio' value='new' onclick='showHideOption3()' checked/> Use new payment method&nbsp;&nbsp;";
						
						$dbc = mysqli_connect('localhost','root','');
						mysqli_select_db($dbc,'agilelaptop');
						$result=mysqli_query($dbc,"SELECT cardNum,cardType FROM users WHERE userID=$userID");
						$row=mysqli_fetch_row($result);
						$cardNum=$row[0];
						$cardType=$row[1];
						if($row[0]!=NULL){
							print"<input name='selmet' type='radio' value='existing' onclick='showHideOption3()'/> Use existing payment method";
						}
						else{
							print"<input name='selmet' type='radio' value='existing' onclick='showHideOption3()' disabled/>Use existing payment method";
						}

						print"<input type='hidden' name='userID' value='$userID'>";
						print"
							<br/>
							<div id='paymethod'>
								<label>Credit Card Number</label><br/>
								<input type='text' name='cardnum'/>
								</br></br>
								<label>Card Type</label><br/>
								<select name='cardtype'>
									<option value='Visa'>Visa</option>
									<option value='MasterCard'>MasterCard</option>
									<option value='American Express'>American Express</option>
								</select>
								<br/><br/>
								<input type='hidden' name='submitted' value='true'>
								<button type='submit' class='submitbtn'>Confirm</button>
							</div>
							<br/>
							
							</form>
							<a href='shoppingcart.php'><button class='backbtn'>Cancel</button></a>
						</div>
						
						
						";
						mysqli_close($dbc);
					}
					
					?>
				</div>
			</div>
		</div>
		
		
		<?php include'include/footer.php';?>
		
		<script src='js/sidemenu.js'></script>
		<script src='javascript/cardvalid.js'></script>
		<script>
			function showHideOption3(){
				var pay = document.forms["paymetform"]["selmet"].value;
				var data = <?php echo json_encode("$cardNum", JSON_HEX_TAG); ?>;
				var data2 = <?php echo json_encode("$cardType", JSON_HEX_TAG); ?>;
				var option="";
				
				if(data2=="Visa"){
					option="<input type='text' value='Visa' readonly/>";
				}
				if(data2=="MasterCard"){
					option="<input type='text' value='MasterCard' readonly/>";
				}
				if(data2=="American Express"){
					option="<input type='text' value='American Express' readonly/>";
				}
				
				if(pay=="new"){
					document.getElementById("paymethod").innerHTML = "<label>Credit Card Number</label><br/>"+
																		"<input type='text' name='cardnum'/>"+
																		"</br></br>"+
																		"<label>Card Type</label><br/>"+
																		"<select name='cardtype'>"+
																			"<option value='Visa'>Visa</option>"+
																			"<option value='MasterCard'>MasterCard</option>"+
																			"<option value='American Express'>American Express</option>"+
																		"</select>"+
																		"<br/><br/>"+
																		"<input type='hidden' name='submitted' value='true'>"+
																		"<button type='submit' class='submitbtn'>Confirm</button>";
				}
				else if (pay=="existing"){
					document.getElementById("paymethod").innerHTML = "<label>Credit Card Number</label><br/>"+
																		"<input type='text' name='cardnum' value='"+data+"' readonly/>"+
																		"</br></br>"+
																		"<label>Card Type</label><br/>"+
																		option+
																		"<br/><br/>"+
																		"<input type='hidden' name='submitted' value='true'>"+
																		"<input type='hidden' name='cardtype' value='"+data2+"'>"+
																		"<button type='submit' class='submitbtn'>Confirm</button>";
				}
			}
		
		</script>
		
		
	</body>
</html>