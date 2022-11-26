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
		<link rel='stylesheet' href='css/myacc.css'>
	</head>
	
	<body>
		<?php
			include'include/dbmanager.php';
			include'include/header.php';
		?>
		
		<div class='container-fluid p-0 content'>
			<div class='row mr-0'>
				<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0'>
					<img src='image/banner.jpg' width='100%' height='300' alt='Banner'/>
				</div>
			</div>
		</div>
		
		<div class='container-fluid p-0'>
			<div class='row mr-0'>
				<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
					<ul class="mybreadcrumb">
						<li><a href="homepage.php">Home</a></li>
						<li><a href="myaccount.php">My Account</a></li>
						<li>Payment method</li>
					</ul>
				</div>
			</div>
		</div>
		
		<hr/>
		
		<div class='pagecontent container-fluid p-0'>
			<div class='row mr-0'>
				<?php
					include'include/accsidenav.php';
				?>
				
				
				<div class='articledetail col-lg-8 col-md-8 col-sm-8 col-xs-8'>
					<h3>Payment method</h3>
					<?php
					if(isset($_SESSION['username'])){
						$username = $_SESSION['username'];
						
						$dbc = mysqli_connect('localhost','root','');
						@mysqli_select_db($dbc,'light_cinema');
						if($dbc){
							$result=mysqli_query($dbc,"SELECT userID FROM users WHERE username='$username'");
							while($row=mysqli_fetch_array($result)){
								$userID=$row['userID'];//userID
							}
						}
					}
					
					
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
							print"<a href='paymethod.php'><button class='submitbtn'>&larr; Back</button></a>";
						}
						else{
							$dbc = mysqli_connect('localhost','root','');
							@mysqli_select_db($dbc,'light_cinema');
							$query = "UPDATE users SET cardNum='$cardnum',cardType='$cardtype' WHERE userID=$userID";
										
							//Execute the query
							if (@mysqli_query($dbc, $query)) {
								print"<p>Successfully updated!</p>";
								print"<a href='paymethod.php'><button class='submitbtn'>&larr; Back</button></a>";
							}
							
						}
						
					}
					
					else if($_GET['type']=="remove"){
						
						$dbc = mysqli_connect('localhost','root','');
						@mysqli_select_db($dbc,'light_cinema');
						
						if(!isset($_POST['confirm'])){
							$result=mysqli_query($dbc,"SELECT cardNum,cardType FROM users WHERE userID=$userID");
							$row=mysqli_fetch_row($result);
							$cardNum=$row[0];
							$cardType=$row[1];
							print"<p>Are you sure you want to remove this payment method?</p>";
							print"
							<p>Card Num<br/>$cardNum</p>
							<p>Card Type<br/>$cardType</p>";
							print"
							<form action='handlepaymet.php?type=remove' method='POST'>
								<input type='hidden' name='confirm' value='true'/>
								<input type='submit' class='submitbtn' value='Yes'/>
							</form>";
							print"<a href='paymethod.php'><button class='submitbtn'>Cancel</button></a>";
						}
						else{
						
							$query = "UPDATE users SET cardNum=NULL,cardType=NULL WHERE userID=$userID";
										
							//Execute the query
							if (@mysqli_query($dbc, $query)) {
								print"<p>Successfully removed!</p>";
								print"<a href='paymethod.php'><button class='submitbtn'>&larr; Back</button></a>";
							}
						}
					}
					
					
					else if($_GET['type']=="update"){
						print"
						<form method='post' action='paymethod.php' onsubmit='return checkpaymet()' name='paymetform'>
							<h4>Update payment method</h4>
							<label>Card Num</label><br/>
							<input type='text' name='cardnum'/>
							<br/><br/>
							<label>Card Type </label><br/>
							<select name='cardtype'>
								<option value='Visa'>Visa</option>
								<option value='MasterCard'>MasterCard</option>
								<option value='American Express'>American Express</option>
							</select>
							<br/><br/>
							<input type='hidden' name='submitted' value='true'>
							<button type='submit'>Add</button>
						</form>
						<a href='paymethod.php'><button>Back</button></a>
						";
							
						
					}
					
					
					?>
										
				
					
				</div>
				
			</div>
		</div>
		
		<?php
			//alert success
			include'include/footer.php';
		?>
		
		<script src='js/sidemenu.js'></script>
		<script src='js/cardvalid.js'></script>
		
		
	</body>
</html>