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
					<h3>Catalog</h3>
					<?php
		
						print"<div id='container'></div>
						<div id='paginationbar'>
						<div id='pagination'></div></div>";
						print"<script>
						ajaxarray=new Array();

						const paginationoption= document.getElementById('pagination');

						var currentpage=1;

						$(function () {
							let container = $('#pagination');
							
							container.pagination({
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
								className: 'paginationjs-theme-blue paginationjs-big',
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
											dataHtml+='<a href=\'productdetails.php?barcodeNumber='+item.barcodeNumber+'\'><img src=\'image/upload/';
											dataHtml+=item.productImage;
											dataHtml+='\' height=\'275\' width=\'200\' onerror=\"javascript:this.src=\'image/upload/noimg.png\'\"></a>';
											dataHtml+='<br/>';
											dataHtml+='<a href=\'productdetails.php?barcodeNumber='+item.barcodeNumber+'\'>'+item.productName+'</a>';
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
			</div>
		</div>
		
		
		<?php include'include/footer.php';?>
		
		<script src='js/sidemenu.js'></script>

		
		
	</body>
</html>



