var loginbutton = document.getElementById("logininput");
loginbutton.onclick = onClickLogin;

var emailinput = document.getElementById("emailinput");
emailinput.onkeyup = onKeyUpEmail;

var passwordinput = document.getElementById("passwordinput");
passwordinput.onkeyup = onKeyUpPassword;

var remembercheckbox = document.getElementById("rememberinput");
remembercheckbox.onchange = onChangeRemember;



function onClickLogin(){
	var email = emailinput.value;
	var password = passwordinput.value;
    if(email.length == 0){
        alert("Email Null");
        return false;
	}
    if(password.length == 0){
        alert("Password Null");
        return false;
    }
    if(email.length != 0 && password.length != 0){
        //document.getElementById("hint").innerHTML = "password";
        document.getElementById("loginform").submit(); 

    }
	
}

function onKeyUpEmail(){
	var email = emailinput.value;

    var emailinputdiv = document.getElementById("emailinputdiv");
    var emailinputlabel = document.getElementById("emailinputlabel");
    var emailinputspan = document.getElementById("emailinputspan");
    var emailinputglyphicon = document.getElementById("emailinputglyphicon");

	if (email.length == 0) { 
        loginbutton.setAttribute("class", "btn btn-outline btn-lg btn-success btn-block");
        emailinputdiv.setAttribute("class", "form-group has-success");
        emailinputlabel.innerHTML = "Enter Username or Email";
        emailinputspan.innerHTML = "";
        emailinputglyphicon.setAttribute("class", "glyphicon form-control-feedback");
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                emailinputspan.innerHTML = this.responseText;
                if(this.responseText == "not valid"){
                	//emailinput.style.backgroundColor = "red";
                    loginbutton.setAttribute("class", "btn btn-outline btn-lg btn-danger btn-block");
                    emailinputdiv.setAttribute("class", "form-group has-error has-feedback");	
                    emailinputlabel.innerHTML = "Invalid Username or Email";
                    emailinputglyphicon.setAttribute("class", "glyphicon glyphicon-remove form-control-feedback");
                }else{
                	//emailinput.style.backgroundColor = "lightgreen";
                    loginbutton.setAttribute("class", "btn btn-outline btn-lg btn-success btn-block");
                    emailinputdiv.setAttribute("class", "form-group has-success has-feedback");
                    emailinputlabel.innerHTML = "Enter Username or Email";
                    emailinputglyphicon.setAttribute("class", "glyphicon glyphicon-ok form-control-feedback");
                }
            }
        
        };
        xmlhttp.open("GET", "../php/login.php?email=" + email, true);
        xmlhttp.send();
    }
}

function onKeyUpPassword(){
	var password = passwordinput.value;
	document.getElementById("hint").innerHTML = password;
}

function onChangeRemember(){
	if(remembercheckbox.checked){
		var checkbox = remembercheckbox.value;
		document.getElementById("hint").innerHTML = checkbox;	
	}else{
		document.getElementById("hint").innerHTML = "Do Not Remember Me";	
	}
	
}


/*$(document).ready(function(){
    $("#login").click(function(){
        $("#p").val("safaf");
    });
});*/


