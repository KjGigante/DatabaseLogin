function newFunction(){
	alert('Help');
	return false;
}
function test(){
	alert ('line2');

}
function myFunction(){
	var lNameValue = document.getElementById('lName').value;
	var fNameValue = document.getElementById('fName').value;
	var mNameValue = document.getElementById('mName').value;
	var studnoValue = document.getElementById('studno').value;
	var bdayValue = document.getElementById('bday').value;
	var phoneValue = document.getElementById('phone').value;
	var emailValue = document.getElementById('email').value;
	var userValue = document.getElementById('user').value;
	var passValue = document.getElementById('pass').value;
	var passrptValue = document.getElementById('passrpt').value;
	var letters = /^[A-Za-z]*$/;
	var lettersSpace = /^[A-Za-z\s]*$/;
    var numbers = /^[-+]?[0-9]+$/;
    var letterNumber = /^[0-9a-zA-Z]+$/;
    var mailformat = /^[a-z0-9.]+[@ue.edu.ph]*$/;
    var unameformat = /^[a-zA-Z-_]*$/;
    var mnlen = 1;
    var mxlen = 2;
    var alphaNum = /^(?:[0-9]+[a-z]|[a-z]+[0-9])[a-z0-9]*$/i;

    if (!lNameValue.match(lettersSpace)) {
    	alert('Error: Last name. Only alphabets are allowed');
    	return false;
    }
    if (!fNameValue.match(lettersSpace)) {
    	alert('Error: First name. Only alphabets are allowed');
    	return false;
    }
    if (!mNameValue.match(letters)) {
    	alert('Error: Middle inital. Only alphabets are allowed');
    	return false;
    }
    if (mNameValue.length>2){
    	alert('Error: Middle inital. Maximum of two characters');
    	return false;
    }
    if (studnoValue.length>11||studnoValue.length<11) {
    	alert('Error: Student number. Must be 11 characters');
    	alert(bdayValue);
    	return false;
    }
    if (!studnoValue.match(numbers)){
    	alert('Error: Student number. Only numbers are allowed');
    	return false;
    }
    
    
    

}
    
