<?php
class User {
  var $conn;
	function __construct($conn){
    $this->conn = $conn;
	}

	function login($username, $password){
		try{
            $stmt = $this->conn->prepare("SELECT * FROM table_admin WHERE username='$username' OR email='$username' LIMIT 1");
            $stmt->execute();
            //fetch single row fitsy
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0){
            	if($password === $userRow['password']){
            		$this->setLoggedIn($userRow['id'], $userRow['username']);
            		return "True";
            	}else{
            		return "Invalid Password";
            	}

            	/*if(password_verify($upass, $userRow['user_pass'])){
                	$_SESSION['user_session'] = $userRow['user_id'];
                	return true;
             	}else{
                	return false;
             	}*/
          	}else{
          		return "Invalid Username or Email";
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

  function registerUser($name, $email, $username, $password){
    try{
      $insertQuery = "INSERT INTO table_admin (name, username, email, password) VALUES ('$name','$username','$email','$password')";
			$this->conn->exec($insertQuery);
			$this->last_id = $this->conn->lastInsertId();

			echo "Query Successfull!</br>
			Inserted ID: ".$this->last_id."<hr>";
		}catch(PDOException $e){
			echo $insertQuery."</br>".$e->getMessage()."<hr>";
		}
  }

	function getUserNameEmail(){
		try{
            $stmt = $this->conn->prepare("SELECT username, email FROM table_admin");
            $stmt->execute();

            //fetch all rows
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $userRows = $stmt->fetchAll();
            if($stmt->rowCount() > 0){
            	foreach($userRows as $userRow){
            		$a[] = $userRow['username'];
            		$a[] = $userRow['email'];
            	}
            	return $a;
          	}else{
          		return "No Users!";
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

  function getUserName(){
		try{
            $stmt = $this->conn->prepare("SELECT username FROM table_admin");
            $stmt->execute();
            //fetch all rows
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $userRows = $stmt->fetchAll();
            if($stmt->rowCount() > 0){
            	foreach($userRows as $userRow){
            		$a[] = $userRow['username'];
            	}
            	return $a;
          	}else{
          		return "No Users!";
          	}
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
	}

  function getEmail(){
		try{
            $stmt = $this->conn->prepare("SELECT email FROM table_admin");
            $stmt->execute();
            //fetch all rows
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $userRows = $stmt->fetchAll();
            if($stmt->rowCount() > 0){
            	foreach($userRows as $userRow){
            		$a[] = $userRow['email'];
            	}
            	return $a;
          	}else{
          		return "No Users!";
          	}
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
	}

	public function isLoggedIn(){
    //echo "Reached isLoggedIn<br>";
      if(isset($_SESSION['id'])){
        //echo "User Status: True<br>";
        return true;
      }else{
        //echo "User Status: False<br>";
      	return false;
      }
   	}

    public function setLoggedIn($id, $username){
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
    }

   	public function redirect($url){
    	header("Location: $url");
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
