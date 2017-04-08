<?php
class SQLConnection{
	var $host;
	var $username;
	var $password;
	var $dbname;
	var $conn;

	function __construct(){
		session_start();
		$this->host = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->dbname = "educator";
	}

	function __destruct(){
		$this->conn = null;
	}

	function connectSQL(){
		try{
			$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->username, $this->password);
		    // set the PDO error mode to exception
		    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    echo "Connected successfully</br><hr>"; 
    	}catch(PDOException $e){
    		$this->conn = null;
    		echo "Connection failed: " . $e->getMessage()."</br><hr>";
    	}
	}
}
?>