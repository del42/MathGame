function validate()
{
    var firstnameOkay=document.getElementById("firstname").value != "";
    var lastnameOkay=document.getElementById("lastname").value != "";
    var schoolOkay=document.getElementById("school").value != "";
    var titleOkay=document.getElementById("title").value != "";
    var emailOkay = document.getElementById("email").value != "";
    var passwordOkay = document.getElementById("password").value != "";
    var confirmOkay = document.getElementById("confirmPassword").value != "";
    var cityOkay = document.getElementById("city").value != "";
    var stateOkay = document.getElementById("state").value != "";

    if ( !firstnameOkay ){
        document.getElementById("firstnameMessage").innerHTML = "Cannot be empty";
    } else {
        document.getElementById("firstnameMessage").innerHTML = "";
    }

    if ( !lastnameOkay ){
        document.getElementById("lastnameMessage").innerHTML = "Cannot be empty";
    } else {
        document.getElementById("lastnameMessage").innerHTML = "";
    }

    if( !schoolOkay ){
        document.getElementById("schoolMessage").innerHTML = "Cannot be empty";
    } else {
        document.getElementById("schoolMessage").innerHTML = "";
    }

    if( !cityOkay ){
        document.getElementById("cityMessage").innerHTML = "Cannot be empty";
    } else {
        document.getElementById("cityMessage").innerHTML = "";
    }

    if( !stateOkay ){
        document.getElementById("stateMessage").innerHTML = "Cannot be empty";
    } else {
        document.getElementById("stateMessage").innerHTML = "";
    }

    if( !titleOkay ){
        document.getElementById("titleMessage").innerHTML = "Cannot be empty";
    } else {
        document.getElementById("titleMessage").innerHTML = "";
    }

    if( !emailOkay ){
        document.getElementById("emailMessage").innerHTML = "Cannot be empty";
    }else if ( !validateEmail()){
        document.getElementById("emailMessage").innerHTML = "Invalid Email address";
    } else {
        document.getElementById("emailMessage").innerHTML = "";
    }

    if ( !passwordOkay ){
        document.getElementById("passwordMessage").innerHTML = "Cannot be empty";
    }else {
        document.getElementById("passwordMessage").innerHTML = "";
    }

    if ( !confirmOkay ){
        document.getElementById("confirmPasswordMessage").innerHTML = "Cannot be empty";
    }else if ( !validatePassword() ) {
        document.getElementById("confirmPasswordMessage").innerHTML = "Password does not match";
    } else {
        document.getElementById("confirmPasswordMessage").innerHTML = "";
    }

    if ( firstnameOkay && lastnameOkay && schoolOkay && emailOkay && titleOkay && passwordOkay && confirmOkay && cityOkay && stateOkay ){
        document.forms["registrationForm"].submit();
    }
    
}

function validateEmail(){
    var x=document.getElementById("email").value;
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length){
        return false;
    }else {
        return true;
    }
}

function validatePassword(){
    var password = document.getElementById("password").value;
    var confirm = document.getElementById("confirmPassword").value;
    if ( password != confirm ){
        return false;
    }else {
        return true;
    }
}

