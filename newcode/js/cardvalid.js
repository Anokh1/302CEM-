function checkpaymet(){
	var cardnum = document.forms["paymetform"]["cardnum"].value;
	var cardtype = document.forms["paymetform"]["cardtype"].value;
	var card_check;
	var errormsg="";
	
	if (cardnum== ""||cardtype== "") {
		alert('Please filll up all the empty field');
		return false;
	}
	else{
		
		if(cardtype=="Visa"){
			card_check=cardnum.match(/^(?:4[0-9]{12}(?:[0-9]{3})?)$/);
			errormsg="Invalid Visa card number!";
		}
		else if(cardtype=="MasterCard"){
			card_check=cardnum.match(/^(?:5[1-5][0-9]{14})$/);
			errormsg="Invalid MasterCard card number!";
		}
		else if(cardtype=="American Express"){
			card_check=cardnum.match(/^(?:3[47][0-9]{13})$/);
			errormsg="Invalid American Express card number!";
		}
		
		if(!card_check){
			alert(errormsg);
			return false;
		}
		
	}
}