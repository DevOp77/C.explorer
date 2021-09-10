<?php
	// Include all neccessary files for the user page 
	require_once("includes/login_module.php");
	$pageTitle = "Profile";
	require_once("classes/Config.php");
    require_once("header.php");
 
    
   
    
?>

<br/>
<div class="container"><br/><br/>
	<div class="row">
		<div class="col-sm-12 text-right"><button onclick="window.location.href='EditPro.php'" class="btn btn-primary editProfileBtn" role="button" border="0" ><i class="fa fa-edit"></i> Edit Profile</div>
	</div>
	
	<div class="row">
	   	<div class="col-sm-3" style="text-align:center;border-radius:15px;">
	   		<img src="<?php echo $myPhoto; ?>" id="userphoto" class="img-circle" width="150px" height="150px" hspace="2px" align="center" style="margin-bottom:5px;" ><br/>
	   		<label for="file">
	   				<input type="file" name="file" id="file" style="display:none;"/>
	   				<div class="btn btn-primary" ><i class="fa fa-camera"></i> Change Photo</div>
	   		</label>
	   	</div>
	   	<div class="col-sm-9" ><!-- column 1 //-->
	   		<div class="row">
	   			<div class="col-sm-12 profileTitle">
	   				<?php echo $_SESSION['myLastname'].' '.$_SESSION['myFirstname']."'s Profile"; ?>
	   			</div>
	   		</div>
	   		
	   		<div class="row">
	   				<!-- Lastname //-->
					   	<div class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
					   			<strong>Lastname</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails">
					   			<?php echo $_SESSION['myLastname']; ?>
					   	</div>
				   	<!-- end of Lastname //-->
	   		</div>
	   		<div class="row">
	   				<!-- Firstname //-->
					   	<div class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
					   			<strong>Firstname</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails" >
					   			<?php echo $_SESSION['myFirstname']; ?>
					   	</div>
				   	<!-- Firstname //-->
	   		</div>
	   		<div class="row">
	   				<!-- Email //-->
					   	<div class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
					   			<strong>Email</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails" >
					   			<?php echo $_SESSION['myEmail']; ?>
					   	</div>
				   	<!-- Email //-->
	   		</div>

	   		<div class="row">
	   				<!-- Location //-->

					   	<div class="col-sm-2 profiledetails"style="background-color:#f1f1f1;" >
					   			<strong>Location</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails" >
					   			<?php echo $_SESSION['myLocation']; ?>
					   	</div>
				   	<!-- Location //-->

	   		</div>
	   		<div class="row">
	   				<!-- Country //-->

					   	<div class="col-sm-2 profiledetails"style="background-color:#f1f1f1;" >
					   			<strong>Country</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails" >
					   			<?php echo $_SESSION['myCountry']; ?>
					   	</div>
				   	<!-- Country //-->

	   		</div>

	   		<div class="row">
	   				<!-- Country //-->

					   	<div class="col-sm-2 profiledetails"style="background-color:#f1f1f1;" >
					   			<strong>About me</strong>
					   	</div>
					   	<div class="col-sm-6 profiledetails" >
					   			<?php echo $_SESSION['myAboutme']; ?>
					   	</div>
				   	<!-- Country //-->

	   		</div>

	   		<br/><br/>
	   		

	   	</div><!-- end of column 2 //-->
	   	
	   	

	</div>
	<div class="row">

		
	</div>

</div>







<?php

   require_once("footer.php");

?>
 <script type="text/javascript" src="js/avatar.js"></script>