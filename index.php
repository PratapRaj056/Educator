<?php
	require_once('/php/user.php');
	$user = new User();
	if($user->isLoggedIn()){
		$user->redirect('index.html');
	}else{
		$user->redirect('login.html');
	}
?>