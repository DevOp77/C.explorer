<?php
	// Import the required external files needed for this page to run 
	require_once("includes/login_module.php");
	$pageTitle = "Profile Edit Profile";
    require_once("header.php");    
    require_once("classes/Config.php");

	// Initialize variables 
  $msg =  "";
  $status = "";
  $color = "";
  $icon = "";
  if (isset($_POST['submitForm']))
  {
	  	// Assign values from the POST request to new variables for further actions 
  		$memberid = $_SESSION["myUserId"];

		// Call the SnitizeField class on these values ( trimming & reformatting)
  		$lastname = SanitizeField::clean($_POST['lastname']);
  		$firstname = SanitizeField::clean($_POST['firstname']);
  		$location = SanitizeField::clean($_POST['location']);
  		$country = SanitizeField::clean($_POST['country']);
  		$aboutme = SanitizeField::clean($_POST['aboutme']);

		  // IF the Firstname or Lastname was  provided 
  		if ($lastname!="" || $firstname!="")
  		{

			// Update a member profile using the dateArray as the argument 
  			$dataArray = array("memberid"=>$memberid,"lastname"=>$lastname,"firstname"=>$firstname,"location"=>$location,"country"=>$country,"aboutme"=>$aboutme);
  			$member = new Member();
  			$result = $member->updateprofile($dataArray);

  			$status = $result["status"];
  			$msg = $result["message"];
  		}
		  // Run this if firstname and lastname was not provided 
  		else
  		{
  			$status = "error";
  			$msg = "Lastname and Firstname are required, other fields may be optional.";
  		}
  }
?>
<br/>
<div class="container"><!-- container //-->



<form name="updateprofile" action="EditPro.php" method="post"><!-- form //-->


	<div class="row">
		<div class="col-sm-12 text-right"><button type="submit" class="btn btn-primary editProfileBtn" role="button" name="submitForm"><i class="fa fa-database"></i> Update Profile</button> <a onclick="location.href='User.php'" class="btn btn-warning editProfileBtn" role="button"><i class="fa fa-remove"></i> Cancel</a></div>
	</div>
	<div class="row">
	   	<div class="col-sm-3" style="text-align:center;border-radius:15px;">
	   		<img src="<?php echo $myPhoto; ?>" id="userphoto" class="img-circle" width=150px" hspace="2px" align="center" style="margin-bottom:5px;" ><br>
	   		<label for="file">
	   				<input type="file" name="file" id="file" style="display:none;"/>
	   				<div class="btn btn-primary" ><i class="fa fa-camera"></i> Change Photo</div>
	   		</label>
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
					// If an error occured 
	   				if ($status=="error")
	   					{
	   						$color= "color:red";
	   						$icon = "<i class='fa fa-warning' aria-hidden='true'></i>";
	   					}
						   // If everything went on as planned 
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
	   				<!-- Lastname //-->
					   	<div for="Lastname" class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
					   			<strong>Lastname</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails-control" >
					   			<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $_SESSION['myLastname']; ?>">
					   	</div>
				   	<!-- end of Lastname //-->
	   		</div>
	   		<div class="row">
	   				<!-- Firstname //-->
					   	<div for ="Firstname" class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
					   			<strong>Firstname</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails-control"  >
					   			<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $_SESSION['myFirstname']; ?>" >
					   	</div>
				   	<!-- Firstname //-->
	   		</div>
	   		<div class="row">
	   				<!-- Email //-->
					   	<div for="email" class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
					   			<strong>Email</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails-control" >
					   			<input type="text" readonly class="form-control" id="email" name="email" value="<?php echo $_SESSION['myEmail']; ?>" >
					   	</div>
				   	<!-- Email //-->
	   		</div>

	   		<div class="row">
	   				<!-- Location //-->

					   	<div class="col-sm-2 profiledetails" style="background-color:#f1f1f1;" >
					   			<strong>Location</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails-control" >
					   			<input type="text" class="form-control" id="location" name="location" value="<?php echo $_SESSION['myLocation']; ?>" >
					   	</div>
				   	<!-- Location //-->

	   		</div>
	   		<div class="row">
	   				<!-- Country //-->

					   	<div class="col-sm-2 profiledetails" style="background-color:#f1f1f1;" >
					   			<strong>Country</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails-control" >
					   			<input type="text" class="form-control" id="country" name="country" value="<?php echo $_SESSION['myCountry']; ?>" >
					   	</div>
				   	<!-- Country //-->

	   		</div>

	   		<div class="row">
	   				<!-- About me //-->

					   	<div class="col-sm-2 profiledetails"style="background-color:#f1f1f1;" >
					   			<strong>About me</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails-control" >
					   			<textarea class="form-control" rows="5" id="aboutme" name="aboutme"><?php echo $_SESSION['myAboutme'];  ?></textarea>
					   	</div>
				   	<!-- About me //-->

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