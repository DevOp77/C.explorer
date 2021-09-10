<?php

	// Import all needed files 
	require_once("includes/login_module.php");
	$pageTitle = "Profile Edit Profile";
    require_once("header.php");    
    require_once("classes/Config.php");

	// Initialize needed variables 
  $msg =  "";
  $status = "";
  $color = "";
  $icon = "";
  if (isset($_POST['submitForm']))
  {
	  // Assign the POST data to  new variables 
  		$memberid = $_SESSION["myUserId"];

		  // Trim and format the POST data and save them in new variables 
  		$current_password = SanitizeField::clean($_POST['current_password']);
  		$new_password = SanitizeField::clean($_POST['new_password']);
  		$confirm_password = SanitizeField::clean($_POST['confirm_password']);
  		
		// Statements if all required fiels have been provided by the user 
  		if ($current_password!="" && $new_password!="" && $confirm_password!='')
  		{
  			$lenthOfNewPassword =  strlen($new_password);
  			if ($lenthOfNewPassword<6)
  			{
  				 $status = "error";
  				 $msg = "Password must not be less than six characters";
  			}
  			else
  			{
  				if ($new_password==$confirm_password)
  				{
					// Intialize a new User Instance 
  					$user = new User();
  					$result = $user->changePassword($memberid,$current_password,$new_password);
  					$status = $result["status"];
  					$msg = $result["msg"];

  				}
				 // If the Intial password does not match  the confirming one  
				  else{
  					$status = "error";
  					$msg = "The new password does not match with the confirm password.";
  				}
  			}
  			

  			
  		}
		
		// If user ignored some fields 
  		else
  		{
			
  			$status = "error";
  			$msg = "All fields are required to effect a change of password.";
  		}
  }
?>
<br/><br/><br/>
<div class="container"><!-- container //-->



<form name="updateprofile" action="Password.php" method="post"><!-- form //-->


	<div class="row">
		<div class="col-sm-12 text-right"><button type="submit" class="btn btn-primary editProfileBtn" role="button" name="submitForm"><i class="fa fa-database"></i> Update Password</button> <a onclick="location.href='User.php'" class="btn btn-warning editProfileBtn" role="button"><i class="fa fa-remove"></i> Cancel</a></div>
	</div>
	<div class="row">
	   	<div class="col-sm-3" style="text-align:center;border-radius:15px;">
	   		<img src="<?php echo $myPhoto; ?>" id="userphoto" class="img-circle" width=150px" hspace="2px" align="center" style="margin-bottom:5px;" ><br>
	   		
	   	</div>
	   	<div class="col-sm-9" ><!-- column 1 //-->
	   		<div class="row">
	   			<div class="col-sm-12 profileTitle" >
	   				<?php echo $_SESSION['myLastname'].' '.$_SESSION['myFirstname']."'s Profile"; ?>
	   			</div>
	   		</div>

	   		<?php
	   			if (isset($_POST['submitForm']))
	   			{
					// If there was an error 
	   				if ($status=="error")
	   					{
	   						$color= "color:red";
	   						$icon = "<i class='fa fa-warning' aria-hidden='true'></i>";
	   					}
						// If everything went on successfully 
	   					elseif($status=="success")
	   					{	
	   						$color= "color:green";
	   						$icon = "<i class='fa fa-check' aria-hidden='true'></i>";

	   					}
	   		?>
	   					<div class="row">
	   						<div class="col-sm-12">
	   							<?php echo "<div style='".$color."'>".$icon."&nbsp;&nbsp;".$msg."</div>"; ?>
	   						</div>
	   					</div>
	   		<?php

	   			}

	   		?>
	   		
	   		<div class="row">
	   				<!-- Current Password //-->
					   	<div for="Current Password" class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
					   			<strong>Current Password</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails-control" >
					   			<input type="text" class="form-control" id="current_password" name="current_password" >
					   	</div>
				   	<!-- Current Password //-->
	   		</div>
	   		<div class="row">
	   				<!-- New Password //-->
					   	<div for ="New_password" class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
					   			<strong>New Password</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails-control"  >
					   			<input type="password" class="form-control" id="new_password" name="new_password"  >
					   	</div>
				   	<!-- New Password //-->
	   		</div>
	   		<div class="row">
	   				<!-- Confirm Password //-->
					   	<div for="email" class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
					   			<strong>Confirm Password</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails-control" >
					   			<input type="password" class="form-control" id="confirm_password" name="confirm_password"  >
					   	</div>
				   	<!-- Confirm Password //-->
	   		</div>

	   		

	   		<br/><br/>
	   		

	   	</div><!-- end of column 2 //-->
	   	
	   	

	</div>
	




  </form><!-- end of form //-->


</div><!-- container //-->







<?php

   require_once("footer.php");

?>
<script type="text/javascript" src="js/avatar.js"></script>