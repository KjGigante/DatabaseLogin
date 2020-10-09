function validateAll(){
	
	if (ValidateEmail){
		if (checkCheckBox){
			document.form.submit();
		}
	}
}
function ValidateEmail(mail) 
{
 if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(myForm.emailAddr.email))
  {
    return (true)
  }else
    alert("You have entered an invalid email address!")
    return (false)
}
function checkCheckBox{
	var x = document.getElementById("termsBox").checked;
	if (x === true){
		return true
	}
	else{
		return false
	}
}
