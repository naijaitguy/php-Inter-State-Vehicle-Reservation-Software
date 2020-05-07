<?php

include("config/validate.php");
include("config/db.php");

class staff{
public $empty_erro;
public $UserName ;
public $Passwod ;
public $Date;
public $db;
public $lastseen;
public $user;


public function GetRecord()
{


if(isset($_POST['Submit']))
			
			{
				
$UserName = $_POST['User'];
$Password = $_POST['Password'];

			
if( empty($UserName)|| empty($Password))

{ $this->empty_erro = " *All Fields Are Required  ";

}

				else
	{  
				
				$validate = new validate();
				
	$this->UserName = $validate->test_input($UserName);					
	$SecurePassword = $validate->test_input($Password);
	$this->Passwod = $validate->test_input($Password);
	$this->Date =  date("d- M- Y") ."  Time ".date("g:i:s");
	
	
	$sql = " SELECT * FROM User WHERE UserName = '$this->UserName' AND Password = '$this->Passwod'";	

	$result = mysqli_query($this->db,$sql);
			 
	if(mysqli_num_rows($result) > 0)
			 
	    {
					
					   session_start();
					   $_SESSION['UserName'] = $this->UserName;
					   $_SESSION['Password'] = $this->Passwod;
					   
		
		  $this->user = $_SESSION['UserName'];
		  $sql = " SELECT * FROM User WHERE UserName = '$this->user'";	
	
			
			  
	         $result = mysqli_query($this->db,$sql);
			 
			 if(mysqli_num_rows($result) > 0){ 
			 
			 
			    while ($output = mysqli_fetch_array($result))
			
			         {
						 
			//     $_SESSION['total_amt'] = $total_amt;
		
			 
			 
			 $this->lastseen = $output['LastLogin'];
			 $_SESSION['Last'] = $this->lastseen;
			 
			 	   
					$sql = "   UPDATE user SET LastLogin= '$this->Date' WHERE UserName = '$this->UserName' ";
					
					if(mysqli_query($this->db, $sql)){
						
			  header("location:booking.php"); 
			}
			 
			 }
		

					   
			 
				  
				  
					}
					
			}
					
				   else 
		 //-------------Else begin--------------------------------
		 
		 {   
		 
		 $this->empty_erro = "  * User Name Or Password does not exist";
		 
		        }
				
				
				
				
				
				
				 }//#End of if empty -----------------------

			
			}//#End of if is set



}/// #end of function



}// #end of class


$staff  = new staff();
$staff->db = $conn;
$staff->GetRecord();


?>

      
 <?php
 include("header.php");
?>   


    <!-------------->
    
    <div class="container cont ">

    
     <!-------------->
     <div class="row">
     
     <div class="row">
     
     <div class="col-lg-4 ticketing">
     
     
     <form action=" <?php echo htmlspecialchars("index.php");?>" method="post" role="form" class=" form-group-lg">
     
     <div class=" form-group">
     
     <label  for="User" > User Name : </label>
     
     <input class="form-control" type="text" name="User" required> 
     
 
 <span style="color:#F00;">   <?php  echo $staff->empty_erro;  ?></span>
     
     </div>
     
     
          
     <div class=" form-group">
     
 <label  for="Password" > Password : </label>
     
 <input class="form-control" type="password" name="Password" required> 
 
 <span style="color:#F00;">   <?php  echo $staff->empty_erro;  ?></span>
     
     </div>
     
 
               
     <div class=" form-group">
     <button class=" btn btn btn-primary" type="submit" name="Submit"> Log In To Proceed</button>
     
     </div>
     
     
     
     
     </form>
     
     </div>
     
     
     </div>
     
     
     
     <div class="row"> 
     
     
     <?php /*echo $staff->Passwod;*/?>
     
     </div>
     
     
     
     <div class="row">
     
     </div>
     
     
     
     </div>
     <!-------------->
    
    
    
   
    
<?php include("footer.php"); ?>
    
    
    
    
     
    
    
    
      <!-------------->
    
    
    
    <!-------------->
    
    
    </body>
    </html>