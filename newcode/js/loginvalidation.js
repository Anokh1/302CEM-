function loginCheck(){
	var username = document.forms["loginForm"]["username"].value;
	var password = document.forms["loginForm"]["password"].value;
	
	var errormessage="";
	var error=false;
	
	if (username == ""){	
		errormessage+="Please enter your username\n";
		error=true;
		
	}
	if (password == ""){
		errormessage+="Please enter your password\n";
		error=true;
	}
	
	if(error==true){
		alert(errormessage);
		return false;
	}
	
	
}