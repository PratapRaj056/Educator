<?php
require_once('dbconfig.php');
class User extends SQLConnection{
	function __construct(){
		SQLConnection::__construct();
	}

	function login($username, $password){
		$this->connectSQL();
		try{
            $stmt = $this->conn->prepare("SELECT * FROM table_admin WHERE username='$username' OR email='$username' LIMIT 1");
            $stmt->execute();
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0){
            	if($password === $userRow['password']){
            		$_SESSION['user_session'] = $userRow['id'];
            		return true;
            	}else{
            		return false;
            	}

            	/*if(password_verify($upass, $userRow['user_pass'])){
                	$_SESSION['user_session'] = $userRow['user_id'];
                	return true;
             	}else{
                	return false;
             	}*/
          	}else{
          		return false;
          	}

          	/*$stmt = $this->conn->prepare($this->sqlQuery); 
		  	$stmt->execute();
			// set the resulting array to associative return 1 if successful
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			//echo json_encode($stmt->fetchAll());
			return $stmt->fetchAll();*/
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
	}

	public function isLoggedIn(){
      if(isset($_SESSION['user_session'])){
        return true;
      }else{
      	return false;
      }
   	}

   	public function redirect($url){
    	header("Location: pages/$url");
   	}

   	public function logout(){
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   	}

   	/*public function register($fname,$lname,$uname,$umail,$upass)
    {
       try
       {
           $new_password = password_hash($upass, PASSWORD_DEFAULT);
   
           $stmt = $this->db->prepare("INSERT INTO users(user_name,user_email,user_pass) 
                                                       VALUES(:uname, :umail, :upass)");
              
           $stmt->bindparam(":uname", $uname);
           $stmt->bindparam(":umail", $umail);
           $stmt->bindparam(":upass", $new_password);            
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }*/
}
?>