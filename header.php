<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>THE NAIJA IT GUYS  BOOKING PORTAL</title>
 
   <link rel="stylesheet" type="text/css" href="css/dist/css/bootstrap.min.css">
   <script src="css/dist/js/bootstrap.js"></script>
   <script src="css/dist/js/npm.js"></script>
   <script src="css/dist/js/jquery.js"></script>
   <script src="css/dist/js/jquery.cycle.all.js"></script>
   <link rel="stylesheet" type="text/css" href="css/STYLE.CSS">
   <link rel="stylesheet" type="text/css" href="css/dist/js/jquery-ui.theme.min.css">
   <script src="css/dist/js/modernizr.custom.86080.js"></script>
  
  </head>

 <body class="body">
    <!-- Fixed navbar -->
 <nav role="navigation">
      <div class="container"  style=" background-color:#03C;">
      
      <img  class="img-responsive img-rounded" src="img/myicon.png" >
        <div class="navbar-header">
  
          <a class="navbar-brand" href="index.php"> THE NAIJA IT GUYS BOOKING </a>
          
        </div>
        
          <ul class="nav navbar-nav" >
          
         
            <li><a href="profile.php"> PROFILE</a></li>
             <li><a href="report.php">REPORT </a></li>
            <li><a href="booking.php">BOOKING </a></li>
         <li><a href="logout.php">LOG OUT</a></li>
         
          </ul>
          
          <div class="user">
           <?php  if(isset( $_SESSION['UserName']) )
	  
	  {
		
			 
	            
					   
		  echo "Welcome Back"."   ". $_SESSION['UserName']."<p>";
					   
					   
		echo "	You Last Log In On ". "".$_SESSION['Last'];
		  
		  
		  }
      
         ?> 
         
         </div>
        </div><!--/.nav-collapse -->
   
    </nav>
    
    