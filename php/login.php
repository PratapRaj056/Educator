<?php

if(isset($_REQUEST["email"])){
	$q = $_REQUEST["email"];
	$available = "";
	// Array with names
	$email[] = "pratapraj056@gmail.com";
	$email[] = "sugam0030@gmail.com";
	$email[] = "myselfsugam@gmail.com";
	$email[] = "akshat.akshat6@gmail.com";
	$email[] = "sgrkmr@gmail.com";
	$email[] = "sgrgpt12@gmail.com";
	$email[] = "prateekchhajed.52@gmail.com";
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

if(isset($_REQUEST["email"], $_REQUEST["password"])){
	if(isset($_REQUEST["remember"])){

	}

}

if(isset($_REQUEST["REQUEST_METHOD"])){
	if($_REQUEST["REQUEST_METHOD"] == "POST"){
		echo "string1";
	}
	echo "string2";
}

if(isset($_POST['btn-login']))
{
 $uname = $_POST['txt_uname_email'];
 $umail = $_POST['txt_uname_email'];
 $upass = $_POST['txt_password'];
  
 if($user->login($uname,$umail,$upass))
 {
  $user->redirect('home.php');
 }
 else
 {
  $error = "Wrong Details !";
 } 
}
echo "reached here finally";

?>