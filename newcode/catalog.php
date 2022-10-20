<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Laptop E-commerce</title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<script src="js/pagination.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.css"/>
		
		<link rel="stylesheet" href="css/paginationtable.css"/>
		<link rel='stylesheet' href='css/movielist.css'>
	</head>
	<body>
	<?php
		//include('include/dbmanager.php');
		$dbc = mysqli_connect('localhost','root','');
		
		$sql = "CREATE DATABASE IF NOT EXISTS agilelaptop";
		mysqli_query($dbc,$sql);

		if(mysqli_select_db($dbc,'agilelaptop')){
			
			$sql1 = "CREATE TABLE IF NOT EXISTS product (barcodeNumber int(10) AUTO_INCREMENT NOT NULL,productName varchar(50),productImage varchar(50), description text,quantity int(10),productType varchar(50),productPrice double,productWarranty boolean,productWExpire date)";
			mysqli_query($dbc,$sql1);
			
		}
		else{
			echo"ERROR! DB not found!";
		}
		mysqli_close($dbc);
	?>
	<div class='movielist col-lg-12 col-md-12 col-sm-12 col-xs-12'>
	<?php
		
		print"<div id='container'></div>
		<div id='pagination'></div>";
		print"<script>
		ajaxarray=new Array();

		const paginationoption= document.getElementById('pagination');

		var currentpage=1;

		$(function () {
			let container = $('#pagination');
			
			container.pagination({
				//dataSource: passedArray,
				dataSource: function(done) {
					$.ajax({
						type: 'GET',
						dataType:'json',
						url: 'phpscript/retrieveproductdata.php',
						success: function(response) {
							ajaxarray=response;
							done(response);
						}
					});
				 },
				pageSize: 20,
				showGoInput: true,
				showGoButton: true,
				callback: function (data, pagination) {
					var dataHtml;
					if(ajaxarray.length==0){
						paginationoption.style.display='none';
						dataHtml = 'There is no product available!';
						$('#container').html(dataHtml);
					}
					else{
						paginationoption.style.display='';
						dataHtml = '';
						var count;
						
						currentpage=pagination.pageNumber;
						
						count=1;
						
						dataHtml+='<ul>';

						$.each(data, function (index, item) {
							
								
							if(count==1||count%5==0){
								dataHtml+='<div class=\'row justify-content-md-center\'>';
							}	
							dataHtml+='<div class=\'col-lg-3 col-md-3 col-sm-3 col-xs-3\'>';
							dataHtml+='<li>';
							dataHtml+='<a href=\'catalog.php?barcodeNumber='+item.barcodeNumber+'\'><img src=\'image/upload/'+item.productImage+'\' height=\'275\' width=\'200\'></a>';
							dataHtml+='<br/>';
							dataHtml+='<a href=\'catalog.php?barcodeNumber='+item.barcodeNumber+'\'>'+item.productName+'</a>';
							dataHtml+='</li>';
							dataHtml+='</div>';
								
							if(count%4==0){
								dataHtml+='</div><br/><br/>';
							}
							
							count++;
							
						});
						
						dataHtml+='</ul>';
						$('#container').html(dataHtml);
					}
				}
				
			})
		})
		</script>";
	
	?>
	</div>
	
	</body>
	
</html>




