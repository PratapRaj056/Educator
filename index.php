<?php
	require_once('/php/dbconfig.php');
	$sqlconnection = new SQLConnection();
	$sqlconnection->connectSQL();
	//$sqlconnection->disconnectSQL();
	//$sqlconnection->user->setLoggedIn(1);
	//$sqlconnection->user->logout();
	if($sqlconnection->user->isLoggedIn()){
		$sqlconnection->user->redirect('php/index.php');
	}else{
		$sqlconnection->user->redirect('php/login.php');
	}
	$sqlconnection->disconnectSQL();
?>