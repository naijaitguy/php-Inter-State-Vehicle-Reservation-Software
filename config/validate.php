<?php

class  validate

  {
	
private $password;
	
/*VALIDATE USERS INPUT STRING VALUE*/
public function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
/*------------------------------------------------*/
public function letters($data)
{
    
   if (!preg_match("/^[a-zA-Z ]*$/",$data)) {
     $nameErr = "Name Must Contain letter Only"; 
	 return $nameErr;
     } else {return $data; }
		
}
		/*-------------------- password hashing------------------*/
		
	public	function hashpassword($password,$username)
{
	$hash = md5($username);
	$salt = md5($password);
	$papper = 'uuhuy@#hb$%$%ovcv75ty84g4irrbgvffe';
	$clean_password = hash('sha256',$hash.$salt.$papper);
	return  $clean_password;
	
}
	
	public function validateInput_Integer($int_value)
	
     	{
	//	$int_value = mysql_escape_string($int_value);
		$int_value = filter_var($int_value,FILTER_SANITIZE_NUMBER_INT);
       $int_value = filter_var($int_value,FILTER_VALIDATE_INT);
		return $int_value;
		
		
    	}
	
	
	public function validateEmail($email)
    {
			$this->test_input($email);
			
		if(filter_var($email,FILTER_SANITIZE_EMAIL)){
			
			if(filter_var($email,FILTER_VALIDATE_EMAIL)){
				
		return $email;
				
				} else {}
			
			}
	    
		
		
	}
		
		
		public function errorMsg($error)
		{
			
			
			echo" <h4>". $error. " </h4>";
			
		}
		
			public function successmgs($error)
		{
			echo" <h2>". $error. " </h2>";
			
		}
		
		
	
	
  }

?>
