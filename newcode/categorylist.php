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
							include'include/dbmanager.php';
							include('include/adminsidenav.php');
						?>
						
						
						<div class='articledetail col-lg-7 col-md-7 col-sm-7 col-xs-7'>
							<?php
		
							if(isset($_GET['submitSearch'])){
								

								$searchCategory=$_GET['searchCategory'];

								print"<a href='categorylist.php'><button>Reset</button></a>";
								print"<a href='categoryadd.php'><button>Add</button></a>";
								
								print"<form method='get' action='categorylist.php'>";
								print"<input type='text' name='searchCategory'/>";
								print"<input type='hidden' name='submitSearch' value='true'>";
								print"<button type='submit' class='submitbtn'>Confirm</button>";
								print"</form>";
								

								print"<div id='container'></div>
								<div id='pagination'></div>";
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
												url: 'phpscript/retrievecategorydata.php?searchCategory=$searchCategory',
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
												dataHtml = 'There is no data available!';
												$('#container').html(dataHtml);
											}
											else{
												paginationoption.style.display='';
												dataHtml = '<table><tr><th>No.</th><th>Category Name</th><th>Default</th><th>Edit</th><th>Delete</th></tr>';
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
													dataHtml += '<td>' + item.categoryName + '</td>';
													if(item.isDefault==1){
														dataHtml += '<td>true</td>';
														dataHtml += '<td></td>';
														dataHtml += '<td></td>';
													}
													else{
														dataHtml += '<td>false</td>';
														dataHtml += '<td><a href=\'editcategory.php?categoryID='+item.categoryID+'\'>Edit</a></td>';
														dataHtml += '<td><a href=\'deletecategory.php?categoryID='+item.categoryID+'\'>Delete</a></td>';
													}
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
								
							}
							else{
								print"<a href='categorylist.php'><button>Reset</button></a>";
								print"<a href='categoryadd.php'><button>Add</button></a>";
								
								print"<form method='get' action='categorylist.php'>";
								print"<input type='text' name='searchCategory'/>";
								print"<input type='hidden' name='submitSearch' value='true'>";
								print"<button type='submit' class='submitbtn'>Confirm</button>";
								print"</form>";

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
												url: 'phpscript/retrievecategorydata.php',
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
												dataHtml = 'There is no data available!';
												$('#container').html(dataHtml);
											}
											else{
												paginationoption.style.display='';
												dataHtml = '<table><tr><th>No.</th><th>Category Name</th><th>Default</th><th>Edit</th><th>Delete</th></tr>';
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
													dataHtml += '<td>' + item.categoryName + '</td>';
													if(item.isDefault==1){
														dataHtml += '<td>true</td>';
														dataHtml += '<td></td>';
														dataHtml += '<td></td>';
													}
													else{
														dataHtml += '<td>false</td>';
														dataHtml += '<td><a href=\'categoryedit.php?categoryID='+item.categoryID+'\'>Edit</a></td>';
														dataHtml += '<td><a href=\'categorydelete.php?categoryID='+item.categoryID+'\'>Delete</a></td>';
													}
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
							}
								
							
								
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>