function showPassword() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function test(){
    alert ('line2');

}
function register(){
    var x = document.getElementById("login");
    var y = document.getElementById("registration");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
        y.style.display = "block";
    }
}

function validateAll(){
    if (dataValidation){
        document.form.submit();
    }
}

function setErrorFor(input, message){
    var formControl = input.parentElement;
    var small = formControl.querySelector('small');
    formControl.className = 'form-control error';
    small.innerText = message;
}

function setSuccessFor(input){
    var formControl = input.parentElement;
    formControl.className = 'form-control success';
}

function dataValidation(){
    var lastNameValue = document.getElementById("lastName").value;
    var firstNameValue = document.getElementById("firstName").value;
    var midNameValue = document.getElementById("midName").value;
    var studNumValue = document.getElementById("studNum").value;
    var yearLevelValue = document.getElementById("yearLevel").value;
    var mobNumValue = document.getElementById("mobNum").value;
    var bdayValue = document.getElementById("bday").value;
    var emailValue  = document.getElementById("emailInput").value;
    var usernameValue = document.getElementById("usernameInput").value;
    var passValue  = document.getElementById("passInput").value;
    var rptPassValue  = document.getElementById("rptPass").value;
    var termsConValue = document.getElementById("termsCon");
    
    var letters = /^[A-Za-z]+$/;
    var numbers = /^[0-9]+$/;
    var mobile = /[+]63/g;
    var emailReg = /[@]ue.edu.ph/gi;
    var usernameReg = /([A-Z-_])/gi;
    var alphaNum = /^(?:[0-9]+[a-z]|[a-z]+[0-9])[a-z0-9]*$/i;
    
    //Last Name
    if (lastNameValue == ""){
        setErrorFor(lastName, 'Last Name cannot be blank');
        return false;
    } else {
        setSuccessFor(lastName);
    }
    if (letters.test(lastNameValue)){
        setSuccessFor(lastName);
    } else {
        setErrorFor(lastName, 'Alphabets Only');
        return false;
    }
    
    //First Name
    if (firstNameValue == ""){
        setErrorFor(firstName, 'First Name cannot be blank');
        return false;
    } else {
        setSuccessFor(firstName);
    }
    if (letters.test(firstNameValue)){
        setSuccessFor(firstName);
    } else {
        setErrorFor(firstName, 'Alphabets Only');
        return false;
    }
    
    //Middle Initial
    if (letters.test(midNameValue) || midNameValue==""){
        setSuccessFor(midName);
    } else {
        setErrorFor(midName, 'Alphabets Only');
        return false;
    }
    
    //Student Number
    if (studNumValue.length != 11){
        setErrorFor(studNum, 'Please enter your full student number');
        return false;
    }
    if (numbers.test(studNumValue)){
        setSuccessFor(studNum);
    } else {
        setErrorFor(studNum, 'Numeric Characters Only');
        return false;
    }
    
    //Birth Date
    if (bdayValue == ""){
        setErrorFor(bday, 'Birth date cannot be blank');
        return false;
    } else {
        setSuccessFor(bday);
        var newBdayValue = bdayValue.replace(/-/, "");   //Converting Birth Date into number
    }
    if (newBdayValue > "20021010"){
        setErrorFor(bday, 'User must be legal age');
        return false;
    } else {
        setSuccessFor(bday);
    }
    
    //Mobile Number
    if (mobile.test(mobNumValue)){
        if (mobNumValue.length != 13){
            setErrorFor(mobNum, 'Please enter full mobile number');
            return false;
        }
        setSuccessFor(mobNum);
    } else {
        setErrorFor(mobNum, 'Mobile number must start with +63');
        return false;
    }
    
    //Email
    if (emailValue == ""){
        setErrorFor(emailInput, 'Email cannot be blank');
        return false;
    }
    if (emailReg.test(emailValue)){
        //var newEmailValue = emailValue.replace(/@ue.edu.ph/, "");   //Check if null value for email
        if (emailValue.length < 15){
            setErrorFor(emailInput, 'Please enter full UE Email Address');
            return false;
        }
        setSuccessFor(emailInput);
    } else {
        setErrorFor(emailInput, 'Please provide valid UE Email Address');
        return false;
    }
    
    //Username
    if (usernameValue == ""){
        setErrorFor(usernameInput, 'Username cannot be blank');
        return false;
    } else {
        if (usernameReg.test(usernameValue)){
            if (usernameValue.length > 7 && usernameValue.length <16){
                setSuccessFor(usernameInput);
            } else {
                setErrorFor(usernameInput, 'Minimum: 8 Maximum: 15');
                return false;
            }
        } else {
            setErrorFor(usernameInput, 'Only accept alphabets, dash, and underscore');
            return false;
        }
    }
    
    //Password
    if (passValue == ""){
        
        setErrorFor(passInput, 'Password cannot be blank');
        return false;
    } else {
        if (alphaNum.test(passValue)){
            if(passValue.length >7 && passValue.length <21){
                setSuccessFor(passInput);
            } else {
                setErrorFor(passInput, 'Minimum: 8 Maximum: 20');
                return false;
            }
        } else {
            setErrorFor(passInput, 'Only accept alphanumeric combination');
            return false;
        }
    }
    
    //Repeat Password
    if (passValue == rptPassValue){
        setSuccessFor(rptPass);
    } else {
        setErrorFor(rptPass, 'Password mismatch');
        return false;
    }
    
    //Terms and Conditions
    if (termsConValue.checked){
        setSuccessFor(termsCon);
    } else {
        setErrorFor(termsCon, 'Please agree on the terms and conditions to continue');
        return false;
    }
}