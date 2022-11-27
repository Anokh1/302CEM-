<?php

	print"<div id='overlay' class='overlay' onclick='closeNav()'></div>";
		print"<div id='mySidenav' class='sidenav'>";
			print"<a href='javascript:void(0)' class='closebtn' onclick='closeNav()'>&times;</a>";
			print"<a href='myaccount.php'>My Account</a>";
			if(!isset($_SESSION)){
				session_start();
			}
			
			if(isset($_SESSION['accountType'])){
				$accType = $_SESSION['accountType'];
				
				if($accType=="Admin"){
					print"<a href='admincontrolpanel.php'>Admin Control</a>";
				}
			}
			
			
			
			
		print"</div>";
		print"<div class='container-fluid p-0'>";
			print"<header>";
				print"<div class='row mr-0'>";
					print"<div class='leftnav col-lg-8 col-md-8 col-sm-8 col-xs-8 p-0'>";
						print"<a href='catalog.php'><img src='image/logo.png' width='150' height='50' alt='Logo' class='hlogo'/></a>";
						print"<ul>";
							print"<li><a href='catalog.php'>Catalog</a></li>";
							
						print"</ul>";
						print"<a href='shoppingcart.php'><button class='booknowbtn smallheader'><span>View Cart</span></button></a>";
					print"</div>";
				
					print"<div class='rightnav col-lg-4 col-md-4 col-sm-4 col-xs-4'>";
						print"<img src='image/menu_icon.png' width='50' height='50' alt='sidemenuicon' class='menuicon' onclick='openNav()'/>";
						print"<ul class='smallheader'>";
							
							if(isset($_SESSION['username'])){
								$username = $_SESSION['username'];
								print"<li class='logreglink' style='font-weight:bolder'>Welcome, $username</li>";
								print"<li class='divline'>|</li>";
								print"<li class='logreglink'><a href='myaccount.php' >My Account</a></li>";
								print"<li class='divline'>|</li>";
								print"<li class='logreglink'><a href='catalog.php?logout=true' >Logout</a></li>";
								
								if(isset($_GET['logout'])){
									unset($_SESSION);
									session_destroy();
									header('Location: catalog.php'); 
									exit();
								}
							}
							else{
								print"<li class='logreglink'><a href='register.php'>Register</a></li>";
								print"<li class='divline'>|</li>";
								print"<li class='logreglink'><a href='login.php' >Login</a></li>";
							}
						print"</ul>";
					print"</div>";
				print"</div>";
			print"</header>";
		print"</div>";
	print"</div>";
?>