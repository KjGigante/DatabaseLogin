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
	alert('line 15');
	var letters = /^[A-Za-z]*$/;
	var lettersSpace = /^[A-Za-z\s]*$/;
    var numbers = /^[-+]?[0-9]+$/;
    var letterNumber = /^[0-9a-zA-Z]+$/;
    var mailformat = /^[a-z0-9.]+[@ue.edu.ph]*$/;
    var unameformat = /^[a-zA-Z-_]*$/;
    var mnlen = 1;
    var mxlen = 2;

    if (lNameValue=="") {
    	alert('Test');
    }
    alert('Test 2');
    return false;
}
