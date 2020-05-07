<?php session_start();
if(!isset( $_SESSION['UserName']) ){header("location:index.php");}
include("config/validate.php");
include("config/db.php");

class profile {

	public $db;
	public $old_password;
	public $new_password;
	public $new_confirm_password;
	public $error;
	public $userName;
	public $success;
	
	
	public function retrive (){
		
		if(isset($_POST['change']))
		{
			
			$password_old = $_POST['password_old'];
			
			$password_new = $_POST['password_new'];
			
			$password_confirm = $_POST['password_confirm'];
			
			$username = $_SESSION['UserName'];
				
			if (empty($password_confirm) || empty($password_new) || empty($password_old) ){
				
				$this->error = "  * All Fields are mandatory ";
				
			}// end if empty 
			
			else {
				
				if ($password_new != $password_confirm) { $this->error = " * Password do not Match try again";} else{
				
				$validate = new validate();
				
				$this->old_password = $validate->test_input($password_old);
				$this->new_password = $validate->test_input($password_new);
				$this->new_confirm_password = $validate->test_input($password_confirm);
				$this->userName = $validate->test_input($username);
				
			$sql = " SELECT * FROM User WHERE  Password =  '$this->old_password'";
	
	         $result = mysqli_query($this->db,$sql);
			 
			 if(mysqli_num_rows($result) > 0)
			 
	               {
					   
					   
					   
					   	$sql = " SELECT * FROM User WHERE  Password =  '$this->new_confirm_password'";
	
	         $result = mysqli_query($this->db,$sql);
			 
			 if(mysqli_num_rows($result) > 0){ $this->error = " Password Already exist try Another "; } else 
					   
					   
					   {
					   $this->success = " password found ";
					   $sql = "   UPDATE user SET Password = '$this->new_confirm_password' WHERE UserName = '$this->userName' ";
					
					if(mysqli_query($this->db, $sql) > 0)
					
					
					{  $this->success = " Password Successfully chaned";
					session_destroy();
					
					 }
						
		
					   }
					   
					   
					   
					   }  else {$this->error = "  Password not found ";}
				
				
				
				}
				} // if not empty 
			
			
			
			}//if set
		

		}//function

	
	}//end class

$profile = new profile();
$profile->db = $conn;
$profile->retrive();

?>

   
    <?php
 include("header.php");
?>    <!-------------->
  
    <!-------------->
    
    <div class="container cont ">
    
    
    
    
     <!-------------->
     <div class="row">
     
     
   
     
     <div class="col-lg-12">
     
     
     <div class="col-lg-4">
     
     
      <h4 style="color:red;">
     <?php   
	
 echo $profile->error;
	 
	 

	 
	 ?>
     </h4>
     
        <h4 style="color:#090;">
     <?php   
	

	 
	 echo $profile->success;

	 
	 ?>
     </h4>
     <form action=" " method="post" role="form">
     
     
     
     
     

       
    <div class=" form-group ">
    
 <label for="Name"> Old Password  :</label>
  <input  type="password" class="form-control" required name="password_old" placeholder="old password"/>
    
    
  </div>
  
  
  <div class=" form-group ">
    
 <label for="Name"> New Password   :</label>
  <input  type="password" class="form-control" required name="password_new" placeholder="New  password"/>
    
    
  </div>
  
  
  
  <div class=" form-group ">
    
 <label for="Name"> Confirm New Password  :</label>
  <input  type="password" class="form-control" required name="password_confirm" placeholder="Confirm New password"/>
    
    
  </div>
       
       
       <div class=" form-group ">
    
 <button type="submit"`  class="btn  btn-primary btn-lg" name="change" >  Changes Password </button>
    
    
  </div>
       
       
       
     
         </form>
     </div>
     
     
     </div>
     
 
     
     
     
     </div>
     <!-------------->
    
    
    
   
    
    
    <div class="row text-center panel-footer">
    
    
    POWERED BY SMART SOL LTD  &copy; - 2017  ALL RIGHT RESERVED 
    
    </div>
    
    
    <!-------------->
    
    </div>
    
    
    <!--------------- >
    
    
    
    
    
    
     
    
    
    
      <!-------------->
    
    
    
    <!-------------->
    
    
    </body>
    </html>