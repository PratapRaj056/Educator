<?php
require_once('user.php');
class SQLConnection{
	var $host;
	var $username;
	var $password;
	var $dbname;
	var $conn;
	var $user;

	function __construct(){
		session_start();
		$this->host = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->dbname = "educator";
	}

	function __destruct(){
		$this->conn = null;
		$this->user = null;
	}

	function connectSQL(){
		try{
			//echo "<h4>Connecting SQL...</h4>";
			$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->username, $this->password);
		    // set the PDO error mode to exception
		    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    //echo "<h4>SQL Connected successfully.</h4><hr>";
		    $this->user = new User($this->conn);
    	}catch(PDOException $e){
    		$this->conn = null;
    		echo "<h4>Connection failed: " . $e->getMessage()."</h4><hr>";
    	}
	}

	function disconnectSQL(){
		try {
			//echo "<h4>Disconnecting SQL...</h4>";
			$this->conn = null;
			//echo "<h4>SQL Disconnected successfully.<hr>";
		} catch (Exception $e) {
			echo "<h4>Error Ocurred: ". $e->getMessage()."</h4><hr>";
		}
	}
}
?>
