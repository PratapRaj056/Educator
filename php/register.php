<?php
require_once('dbconfig.php');
$sqlconnection = new SQLConnection();
$sqlconnection->connectSQL();
//$sqlconnection->disconnectSQL();
//$sqlconnection->user->setLoggedIn(1);
//$sqlconnection->user->logout();
if($sqlconnection->user->isLoggedIn()){
  $sqlconnection->user->redirect('index.php');
}else{
  //username$sqlconnection->user->redirect('login.php');
}
//$sqlconnection->disconnectSQL();

if(isset($_POST["usernamequery"])){
	/*echo "REQUEST_METHOD: ".$_SERVER['REQUEST_METHOD'];
	echo "<br>";
	echo "QUERY_STRING: ".$_SERVER['QUERY_STRING'];
	echo "<br>";*/
	$q = $_POST["usernamequery"];
	$available = "";

	$usernames = $sqlconnection->user->getUserName();

	// lookup all hints from array if $q is different from ""
	if ($q !== "") {
	    $q = strtolower($q);
	    $len=strlen($q);
	    foreach($usernames as $name) {
	        if (stristr($q, substr($name, 0, $len))) {
	            if ($available === "") {
	                $available = $name;
	            } else {
	                $available .= ", $name";
	            }
	        }
	    }
	}
	// Output "no suggestion" if no available was found or output correct values
	echo $available === "" ? "not valid" : $available;
	exit();
	echo "string";
}

if(isset($_POST["emailquery"])){
	/*echo "REQUEST_METHOD: ".$_SERVER['REQUEST_METHOD'];
	echo "<br>";
	echo "QUERY_STRING: ".$_SERVER['QUERY_STRING'];
	echo "<br>";*/
	$q = $_POST["emailquery"];
	$available = "";

	$emails = $sqlconnection->user->getEmail();

	// lookup all hints from array if $q is different from ""
	if ($q !== "") {
	    $q = strtolower($q);
	    $len=strlen($q);
	    foreach($emails as $name) {
	        if (stristr($q, substr($name, 0, $len))) {
	            if ($available === "") {
	                $available = $name;
	            } else {
	                $available .= ", $name";
	            }
	        }
	    }
	}
	// Output "no suggestion" if no available was found or output correct values
	echo $available === "" ? "not valid" : $available;
	exit();
	echo "string";
}

$nameerror = 'Enter Name';
$emailerror = 'Enter Email';
$usernameerror = 'Enter Username';
$passworderror = 'Enter Password';

if(isset($_SERVER['REQUEST_METHOD'])){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['Name'], $_POST['Email'], $_POST['Username'], $_POST['Password'], $_POST['RegisterButton'])){
            $name = $_POST['Name'];
            $email = $_POST['Email'];
            $username = $_POST['Username'];
            $password = $_POST['Password'];
            $sqlconnection->user->registerUser($name, $email, $username, $password);
            $sqlconnection->user->redirect('login.php');
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Educator Admin Register</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Educator Admin Sign In</h3>
                    </div>
                    <div class="panel-body">

                        <form role="form" id="registerform" action="" method="post" >
                            <fieldset>
                                <div id="nameinputdiv" class="form-group has-success">
                                      <label class="control-label" for="nameinput" id="nameinputlabel"><?php echo $nameerror; ?></label>
                                      <input type="text" class="form-control" id="nameinput" name="Name" placeholder="Name" aria-describedby="nameinputstatus" autofocus required>
                                      <span class="glyphicon form-control-feedback" aria-hidden="true" id="nameinputglyphicon"></span>
                                      <span id="nameinputstatus" class="sr-only"></span>
                                      <span class="help-block" id="nameinputspan" ></span>
                                </div>

                                <div id="emailinputdiv" class="form-group has-success">
                                      <label class="control-label" for="emailinput" id="emailinputlabel"><?php echo $emailerror; ?></label>
                                      <input type="email" class="form-control" id="emailinput" name="Email" placeholder="Email" aria-describedby="emailinputstatus" autofocus required>
                                      <span class="glyphicon form-control-feedback" aria-hidden="true" id="emailinputglyphicon"></span>
                                      <span id="emailinputstatus" class="sr-only"></span>
                                      <span class="help-block" id="emailinputspan" ></span>
                                </div>

                                <div id="usernameinputdiv" class="form-group has-success">
                                      <label class="control-label" for="usernameinput" id="usernameinputlabel"><?php echo $usernameerror; ?></label>
                                      <input type="text" class="form-control" id="usernameinput" name="Username" placeholder="Username" aria-describedby="usernameinputstatus" autofocus required>
                                      <span class="glyphicon form-control-feedback" aria-hidden="true" id="usernameinputglyphicon"></span>
                                      <span id="usernameinputstatus" class="sr-only"></span>
                                      <span class="help-block" id="usernameinputspan" ></span>
                                </div>

                                <div id="passwordinputdiv" class="form-group has-success">
                                      <label class="control-label" for="passwordinput" id="passwordinputlabel"><?php echo $passworderror; ?></label>
                                      <input type="text" class="form-control" id="passwordinput" name="Password" placeholder="Password" aria-describedby="passwordinputstatus" autofocus required>
                                      <span class="glyphicon form-control-feedback" aria-hidden="true" id="passwordinputglyphicon"></span>
                                      <span id="passwordinputstatus" class="sr-only"></span>
                                      <span class="help-block" id="passwordinputspan" ></span>
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="RegisterButton" id="registerinput" value="Register" class="btn btn-outline btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- educator script -->
    <script src="../javascript/register.js"></script>

</body>
</html>
