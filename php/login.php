<?php
require_once('dbconfig.php');
$sqlconnection = new SQLConnection();
$sqlconnection->connectSQL();
//$sqlconnection->disconnectSQL();
//$sqlconnection->user->setLoggedIn(1);
//$sqlconnection->user->logout();
if($sqlconnection->user->isLoggedIn()){
	$sqlconnection->user->redirect('index.php');
}

if(isset($_POST["emailquery"])){
	/*echo "REQUEST_METHOD: ".$_SERVER['REQUEST_METHOD'];
	echo "<br>";
	echo "QUERY_STRING: ".$_SERVER['QUERY_STRING'];
	echo "<br>";*/
	$q = $_POST["emailquery"];
	$available = "";

	$email = $sqlconnection->user->getUserNameEmail();

	// lookup all hints from array if $q is different from ""
	if ($q !== "") {
	    $q = strtolower($q);
	    $len=strlen($q);
	    foreach($email as $name) {
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

/*echo "PHP_SELF: ".$_SERVER['PHP_SELF'];
echo "<br>";
echo "SERVER_NAME: ".$_SERVER['SERVER_NAME'];
echo "<br>";
echo "HTTP_HOST: ".$_SERVER['HTTP_HOST'];
echo "<br>";
echo "HTTP_REFERER: ".$_SERVER['HTTP_REFERER'];
echo "<br>";
echo "HTTP_USER_AGENT: ".$_SERVER['HTTP_USER_AGENT'];
echo "<br>";
echo "REQUEST_METHOD: ".$_SERVER['REQUEST_METHOD'];
echo "<br>";
echo "QUERY_STRING: ".$_SERVER['QUERY_STRING'];
echo "<br>";
echo "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR'];
echo "<br>";
echo "REMOTE_PORT: ".$_SERVER['REMOTE_PORT'];
echo "<br>";
echo "SCRIPT_NAME: ".$_SERVER['SCRIPT_NAME'];
echo "<br><hr>";*/
$emailerror = 'Enter Username or Email';
$passworderror = 'Enter Password';
if(isset($_SERVER["REQUEST_METHOD"])){
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		/*echo "REQUEST_METHOD: ".$_SERVER['REQUEST_METHOD'];
		echo "<br>";
		echo "QUERY_STRING: ".$_SERVER['QUERY_STRING'];
		echo "<br>";*/
		//echo "POST<br><hr>";
		//echo "reached here login <br>";
		if(isset($_POST['Email'], $_POST['Password'], $_POST['LoginButton'])){
			$email = $_POST['Email'];
			$password = $_POST['Password'];
			$response = $sqlconnection->user->login($email, $password);

			if($response === 'True'){
				//echo 'tr : ',$response;
				$sqlconnection->user->redirect('index.php');
			}elseif($response === 'Invalid Password'){
			   $passworderror = $response;
         //echo 'ps : ',$emailerror;
			}elseif($response === 'Invalid Username or Email'){
         $emailerror = $response;
         //echo 'em : ',$passworderror;
			}
		}
	}elseif($_SERVER["REQUEST_METHOD"] == "GET"){
		//echo "GET<br><hr>";
	}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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

    <title>Educator Admin Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                        <form role="form" id="loginform" action="" method="post" >
                            <fieldset>
                                <div id="emailinputdiv" class="form-group has-success">
                                      <label class="control-label" for="emailinput" id="emailinputlabel"><?php echo $emailerror; ?></label>
                                      <input type="text" class="form-control" id="emailinput" name="Email" placeholder="E-mail or Username" aria-describedby="emailinputstatus" autofocus required>
                                      <span class="glyphicon form-control-feedback" aria-hidden="true" id="emailinputglyphicon"></span>
                                      <span id="emailinputstatus" class="sr-only"></span>
                                      <span class="help-block" id="emailinputspan" ></span>
                                </div>
                                <div id="passwordinputdiv" class="form-group has-success">
                                      <label class="control-label" for="passwordinput" id="passwordinputlabel"><?php echo $passworderror; ?></label>
                                      <input type="password" class="form-control" id="passwordinput" name="Password" placeholder="Password" aria-describedby="passwordinputstatus" autofocus required>
                                      <span class="glyphicon form-control-feedback" aria-hidden="true" id="passwordinputglyphicon"></span>
                                      <span id="passwordinputstatus" class="sr-only"></span>
                                      <span class="help-block" id="passwordinputspan" ></span>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="Remember Me" id="rememberinput">Remember Me
                                    </label>
																		<label ><a href='register.php'>Register Here!</a> </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="LoginButton" id="logininput" value="login" class="btn btn-outline btn-lg btn-success btn-block">
                                <p id="hint"><p>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="form-group has-success">
      <label class="control-label" for="inputSuccess1">Input with success</label>
      <input type="text" class="form-control" id="inputSuccess1" aria-describedby="helpBlock2">
      <span id="helpBlock2" class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>
    </div>
    <div class="form-group has-warning">
      <label class="control-label" for="inputWarning1">Input with warning</label>
      <input type="text" class="form-control" id="inputWarning1">
    </div>
    <div class="form-group has-error">
      <label class="control-label" for="inputError1">Input with error</label>
      <input type="text" class="form-control" id="inputError1">
    </div>
    <div class="has-success">
      <div class="checkbox">
        <label>
          <input type="checkbox" id="checkboxSuccess" value="option1">
          Checkbox with success
        </label>
      </div>
    </div>
    <div class="has-warning">
      <div class="checkbox">
        <label>
          <input type="checkbox" id="checkboxWarning" value="option1">
          Checkbox with warning
        </label>
      </div>
    </div>
    <div class="has-error">
      <div class="checkbox">
        <label>
          <input type="checkbox" id="checkboxError" value="option1">
          Checkbox with error
        </label>
      </div>
    </div> -->

    <!-- <div class="form-group has-success has-feedback">
      <label class="control-label" for="inputSuccess2">Input with success</label>
      <input type="text" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status">
      <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
      <span id="inputSuccess2Status" class="sr-only">(success)</span>
    </div>
    <div class="form-group has-warning has-feedback">
      <label class="control-label" for="inputWarning2">Input with warning</label>
      <input type="text" class="form-control" id="inputWarning2" aria-describedby="inputWarning2Status">
      <span class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>
      <span id="inputWarning2Status" class="sr-only">(warning)</span>
    </div>
    <div class="form-group has-error has-feedback">
      <label class="control-label" for="inputError2">Input with error</label>
      <input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status">
      <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
      <span id="inputError2Status" class="sr-only">(error)</span>
    </div>
    <div class="form-group has-success has-feedback">
      <label class="control-label" for="inputGroupSuccess1">Input group with success</label>
      <div class="input-group">
        <span class="input-group-addon">@</span>
        <input type="text" class="form-control" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status">
      </div>
      <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
      <span id="inputGroupSuccess1Status" class="sr-only">(success)</span>
    </div> -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- educator script -->
    <script src="../javascript/login.js"></script>

</body>

</html>
