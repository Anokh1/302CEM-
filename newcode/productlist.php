<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Agile Laptop</title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<script src="js/pagination.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.4/pagination.css"/>
		
		<link rel='stylesheet' href='css/general.css'>
		<link rel='stylesheet' href='css/admincontrolpanel.css'>
	</head>
	
	<body>
		<a href='catalog.php'><button class='returnbutton'>&larr; Return to website</button></a>
		
		<br/>
		
		<div class='container-fluid p-0'>
			<div class='row justify-content-md-center mr-0'>
				<div class='pagecontent col-lg-11 col-md-11 col-sm-11 col-xs-11 '>
					<div class='row mr-0'>
						
						<?php
							include('include/adminsidenav.php');
						?>
						
						
						<div class='articledetail col-lg-7 col-md-7 col-sm-7 col-xs-7'>
							<?php
								print"<a href='productadd.php'><button>Add</button></a>";
								
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
												url: 'phpscript/retrieveproductlist.php',
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
												dataHtml = '<table><tr><th>No.</th><th>Product Image</th><th>Product Name</th><th>Category</th><th>Price</th><th>Quantity</th><th>Edit</th><th>Delete</th></tr>';
												var count;
												
												currentpage=pagination.pageNumber;
												
												if(pagination.pageNumber==1){
													count=1;
												}
												else{
													count=20*(pagination.pageNumber-1)+1;
												}
												
												$.each(data, function (index, item) {
													dataHtml += '<tr>';
													dataHtml += '<td>'+count+'</td>';
													dataHtml += '<td><img src=\'image/upload/' + item.productImage + '\' height=\'100\' width=\'100\'/></td>';
													dataHtml += '<td>' + item.productName + '</td>';
													dataHtml += '<td>' + item.barcodeNumber + '</td>';
													dataHtml += '<td>' + item.productPrice + '</td>';
													if(item.productQuantity==0){
														dataHtml += '<td>Out of Stock</td>';
													}
													else{
														dataHtml += '<td>' + item.productQuantity + '</td>';
													}
													dataHtml += '<td><a href=\'productedit.php?barcodeNumber='+item.barcodeNumber+'\'>Edit</a></td>';
													dataHtml += '<td><a href=\'productdelete.php?barcodeNumber='+item.barcodeNumber+'\'>Delete</a></td>';
													
													dataHtml += '</tr>';
													count++;
												});

												dataHtml+='</table>';

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
			</div>
		</div>
	</body>
</html>