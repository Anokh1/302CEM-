document.getElementById('username').addEventListener('input', function() {
	var password = document.forms["unameform"]["username"].value;
	if (username != ""){
		document.getElementById("username").style.border = "none";
		document.getElementById("uname_error").innerHTML = "<br/>";
	}
});

function usernameCheck(){
	var username = document.forms["unameform"]["username"].value;
	var uname_check=username.match(/^[a-zA-Z0-9]*$/);
	
	if(!uname_check){
		document.getElementById("username").style.border = "2px solid red";
		document.getElementById("uname_error").innerHTML = "Please use alphabet and numbers only";
	}
	else{
		document.getElementById("username").style.border = "none";
		document.getElementById("uname_error").innerHTML = "<br/>";
	}
}

function checkUName(){
	var username = document.forms["unameform"]["username"].value;
	if (username == "") {
		alert('Username: The field cannot be empty!');
		return false;
	}
}

function checkPass(){
	var oldpass = document.forms["passform"]["oldpass"].value;
	var password = document.forms["passform"]["password"].value;
	var cfmpass = document.forms["passform"]["cfmpass"].value;
	if (oldpass== ""||pass==""||cfmpass=="") {
		alert('Password: Please make sure to fill up all the field');
		return false;
	}
}


document.getElementById('password').addEventListener('input', function() {
	var password = document.forms["passform"]["password"].value;
	var cfmpass = document.forms["passform"]["cfmpass"].value;
	
	if (password != ""){
		document.getElementById("password").style.border = "none";
		document.getElementById("pass_error").innerHTML = "<br/>";
	}
	
	if(cfmpass==password){
		document.getElementById("cfmpass").style.border = "none";
		document.getElementById("cfmpass_error").innerHTML = "<br/>";
	}
	else if(password!=""&&cfmpass!=""){
		document.getElementById("cfmpass").style.border = "2px solid red";
		document.getElementById("cfmpass_error").innerHTML = "Password does not match";
	}
});



function passProgress(){
	var password = document.forms["passform"]["password"].value;
	var percent=0;
	var part=[0,0,0,0,0];
	var msg="";
	
	if(password.length>7){
		part[0]=20;
		document.getElementById("plength").innerHTML="&#10004;";
		document.getElementById("plength").style.color = "green";
	}
	else{
		part[0]=0;
		document.getElementById("plength").innerHTML="&#10006;";
		document.getElementById("plength").style.color = "red";
	}
	
	if(password.match(/[a-z]/)){
		part[1]=20;
		document.getElementById("psmalla").innerHTML="&#10004;";
		document.getElementById("psmalla").style.color = "green";
	}
	else{
		part[1]=0;
		document.getElementById("psmalla").innerHTML="&#10006;";
		document.getElementById("psmalla").style.color = "red";
	}
	
	if(password.match(/[A-Z]/)){
		part[2]=20;
		document.getElementById("pbiga").innerHTML="&#10004;";
		document.getElementById("pbiga").style.color = "green";
	}
	else{
		part[2]=0;
		document.getElementById("pbiga").innerHTML="&#10006;";
		document.getElementById("pbiga").style.color = "red";
	}
	
	if(password.match(/[0-9]/)){
		part[3]=20;
		document.getElementById("pnum").innerHTML="&#10004;";
		document.getElementById("pnum").style.color = "green";
	}
	else{
		part[3]=0;
		document.getElementById("pnum").innerHTML="&#10006;";
		document.getElementById("pnum").style.color = "red";
	}
	
	if(password.match(/[@#$!%&]/)){
		part[4]=20;
		document.getElementById("psym").innerHTML="&#10004;";
		document.getElementById("psym").style.color = "green";
	}
	else{
		part[4]=0;
		document.getElementById("psym").innerHTML="&#10006;";
		document.getElementById("psym").style.color = "red";
	}
	
	for (var i = 0; i < 5; i++) {
	  percent += part[i];
	}
	
	document.getElementById("progresspercent").style.width = percent+"%";
	
	if(percent<60){
		document.getElementById("passStrength").innerHTML="Weak";
	}
	else if(percent<100){
		document.getElementById("passStrength").innerHTML="Medium";
	}
	else{
		document.getElementById("passStrength").innerHTML="Strong";
	}
	
	
}

function passCheck(){
	var password = document.forms["passform"]["password"].value;
	
	if(password.length==0){
		document.getElementById("password").style.border = "none";
		document.getElementById("pass_error").innerHTML = "<br/>";
	}
	else if(password.length<8){
		document.getElementById("password").style.border = "2px solid red";
		document.getElementById("pass_error").innerHTML = "Password must be longer than 8 characters";
	}
	else{
		document.getElementById("password").style.border = "none";
		document.getElementById("pass_error").innerHTML = "<br/>";
	}
	
}

document.getElementById('cfmpass').addEventListener('input', function() {
	var password = document.forms["passform"]["password"].value;
	var cfmpass = document.forms["passform"]["cfmpass"].value;
	
	
	if (cfmpass != ""){
		document.getElementById("cfmpass").style.border = "none";
		document.getElementById("cfmpass_error").innerHTML = "<br/>";
	}
	if(cfmpass!=""&&cfmpass!=password){
		document.getElementById("cfmpass").style.border = "2px solid red";
		document.getElementById("cfmpass_error").innerHTML = "Password does not match";
	}
	if(password!=""&&cfmpass!=password){
		document.getElementById("cfmpass").style.border = "2px solid red";
		document.getElementById("cfmpass_error").innerHTML = "Password does not match";
	}
});

function cfmpassCheck(){
	var password = document.forms["passform"]["password"].value;
	var cfmpass = document.forms["passform"]["cfmpass"].value;
	
	if (cfmpass.length==0&&password.length==0){
		document.getElementById("cfmpass").style.border = "none";
		document.getElementById("cfmpass_error").innerHTML = "<br/>";
	}
	else if(cfmpass!=password){
		document.getElementById("cfmpass").style.border = "2px solid red";
		document.getElementById("cfmpass_error").innerHTML = "Password does not match";
	}
	else{
		document.getElementById("cfmpass").style.border = "none";
		document.getElementById("cfmpass_error").innerHTML = "<br/>";
	}
}

document.getElementById('fname').addEventListener('input', function() {
	if (fname != ""){
		document.getElementById("fname").style.border = "none";
		document.getElementById("fname_error").innerHTML = "<br/>";
	}
});

function fnameCheck(){
	var fname = document.forms["flform"]["fname"].value;
	var fname_check=fname.match(/^([a-zA-Z]+\s)*[a-zA-Z]+$/);
	
	if(fname==""){
		document.getElementById("lname").style.border = "none";
		document.getElementById("lname_error").innerHTML = "<br/>";
	}
	else if(!fname_check){
		document.getElementById("fname").style.border = "2px solid red";
		document.getElementById("fname_error").innerHTML = "Please use alphabet only";
	}
	else{
		document.getElementById("fname").style.border = "none";
		document.getElementById("fname_error").innerHTML = "<br/>";
	}
}


document.getElementById('lname').addEventListener('input', function() {
	if (lname != ""){
		document.getElementById("lname").style.border = "none";
		document.getElementById("lname_error").innerHTML = "<br/>";
	}
});

function lnameCheck(){
	var lname = document.forms["flform"]["lname"].value;
	var lname_check=lname.match(/^([a-zA-Z]+\s)*[a-zA-Z]+$/);
	if(lname==""){
		document.getElementById("lname").style.border = "none";
		document.getElementById("lname_error").innerHTML = "<br/>";
	}
	else if(!lname_check){
		document.getElementById("lname").style.border = "2px solid red";
		document.getElementById("lname_error").innerHTML = "Please use alphabet only";
	}
	else{
		document.getElementById("lname").style.border = "none";
		document.getElementById("lname_error").innerHTML = "<br/>";
	}
}

function checkflname(){
	var fname = document.forms["flform"]["fname"].value;
	var lname = document.forms["flform"]["lname"].value;
	
	if (fname== ""||lname=="") {
		alert('Name: Please make sure to fill up all the field');
		return false;
	}
}

document.getElementById('email').addEventListener('input', function() {
	if (email == ""){
		document.getElementById("email").style.border = "none";
		document.getElementById("email_error").innerHTML = "<br/>";
	}
	if (email != ""){
		document.getElementById("email").style.border = "none";
		document.getElementById("email_error").innerHTML = "<br/>";
	}

});

function checkemail(){
	var email = document.forms["emailform"]["email"].value;
	
	if (email== "") {
		alert('Email: The field cannot be empty!');
		return false;
	}
}

function emailCheck(){
	var email = document.forms["emailform"]["email"].value;
	var email_check=email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/);
	
	if (email == ""){
		document.getElementById("email").style.border = "none";
		document.getElementById("email_error").innerHTML = "<br/>";
	}
	else if(!email_check){
		document.getElementById("email").style.border = "2px solid red";
		document.getElementById("email_error").innerHTML = "Invalid email";
	}
	else{
		document.getElementById("email").style.border = "none";
		document.getElementById("email_error").innerHTML = "<br/>";
	}
}

document.getElementById('phone').addEventListener('input', function() {
	if (phone!= ""){
		document.getElementById("phone").style.border = "none";
		document.getElementById("phone_error").innerHTML = "<br/>";
	}
	if (phone== ""){
		document.getElementById("phone").style.border = "none";
		document.getElementById("phone_error").innerHTML = "<br/>";
	}
});

function phoneCheck(){
	var phone = document.forms["phoneform"]["phone"].value;
	var phone_check=phone.match(/[0-9]{3}-[0-9]{7}/);
	
	if (phone == ""){
		document.getElementById("email").style.border = "none";
		document.getElementById("email_error").innerHTML = "<br/>";
	}
	else if(!phone_check){
		document.getElementById("phone").style.border = "2px solid red";
		document.getElementById("phone_error").innerHTML = "Invalid phone number";
	}
	else{
		document.getElementById("phone").style.border = "none";
		document.getElementById("phone_error").innerHTML = "<br/>";
	}
}

function checkphone(){
	var phone = document.forms["phoneform"]["phone"].value;
	
	if (phone== "") {
		alert('Email: The field cannot be empty!');
		return false;
	}
}