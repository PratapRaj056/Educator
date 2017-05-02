var emailinput = document.getElementById("emailinput");
emailinput.onkeyup = onKeyUpEmail;

var usernameinput = document.getElementById("usernameinput");
usernameinput.onkeyup = onKeyUpUsername;

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
                if(this.responseText != "not valid"){
                	//emailinput.style.backgroundColor = "red";
                    loginbutton.setAttribute("class", "btn btn-outline btn-lg btn-danger btn-block");
                    emailinputdiv.setAttribute("class", "form-group has-error has-feedback");
                    emailinputspan.innerHTML = "Email id is already registered";
                    emailinputglyphicon.setAttribute("class", "glyphicon glyphicon-remove form-control-feedback");
                }else{
                	//emailinput.style.backgroundColor = "lightgreen";
                    loginbutton.setAttribute("class", "btn btn-outline btn-lg btn-success btn-block");
                    emailinputdiv.setAttribute("class", "form-group has-success has-feedback");
                    emailinputspan.innerHTML = "Email is not registered!";
                    emailinputglyphicon.setAttribute("class", "glyphicon glyphicon-ok form-control-feedback");
                }
            }

        };
        /*xmlhttp.open("GET", "../php/login.php?emailquery=" + email, true);
        xmlhttp.send();*/
        xmlhttp.open("POST", "../php/register.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("emailquery=" + email);
    }
}

function onKeyUpUsername(){
	var username = usernameinput.value;

    var usernameinputdiv = document.getElementById("usernameinputdiv");
    var usernameinputlabel = document.getElementById("usernameinputlabel");
    var usernameinputspan = document.getElementById("usernameinputspan");
    var usernameinputglyphicon = document.getElementById("usernameinputglyphicon");

	if (username.length == 0) {
        loginbutton.setAttribute("class", "btn btn-outline btn-lg btn-success btn-block");
        usernameinputdiv.setAttribute("class", "form-group has-success");
      usernameinputlabel.innerHTML = "Enter Username";
        usernameinputspan.innerHTML = "";
        usernameinputglyphicon.setAttribute("class", "glyphicon form-control-feedback");
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                usernameinputspan.innerHTML = this.responseText;
                if(this.responseText != "not valid"){
                	//usernameinput.style.backgroundColor = "red";
                    loginbutton.setAttribute("class", "btn btn-outline btn-lg btn-danger btn-block");
                    usernameinputdiv.setAttribute("class", "form-group has-error has-feedback");
                    usernameinputlabel.innerHTML = "Username not available!";
                    usernameinputglyphicon.setAttribute("class", "glyphicon glyphicon-remove form-control-feedback");
                }else{
                	//usernameinput.style.backgroundColor = "lightgreen";
                    loginbutton.setAttribute("class", "btn btn-outline btn-lg btn-success btn-block");
                    usernameinputdiv.setAttribute("class", "form-group has-success has-feedback");
                    usernameinputlabel.innerHTML = "Username is available!";
                    usernameinputglyphicon.setAttribute("class", "glyphicon glyphicon-ok form-control-feedback");
                }
            }

        };
        /*xmlhttp.open("GET", "../php/login.php?usernamequery=" + username, true);
        xmlhttp.send();*/
        xmlhttp.open("POST", "../php/register.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("usernamequery=" + username);
    }
}
