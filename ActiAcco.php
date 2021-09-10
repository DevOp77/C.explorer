<?php
 
 //activate membership registration
 if (!isset($_GET['activationcode']))
 	{
   		header("location:index.php");
 	}

 $activationcode  = trim(stripslashes(htmlspecialchars($_GET['activationcode'])));
 
  require_once("classes/Config.php");
	 // Activate and add a new member 
 $member = new Member();
 $result = $member->activateMembershipAccount($activationcode);

 $status = $result["status"];
 $nextPage = $result["nextPage"];

	 // Executes if Member Activation did failed ; 
 if ($status=="failed")
 	{
 		//echo "<br>Inside failed block";
 		header("location:".$nextPage);
 	}
	 // Executes if Activation needs further authentication ; 
 else if ($status=="expired")
 {
 	//echo "<br>Inside expired block.";
 	session_start();
 	$_SESSION['505msg'] = "Dear User, <br/><br/>An email has been sent to your email to activate your account.<br/><br/>Thank you.";
 	header("location:".$nextPage); 

 }
 // Works if activation is successful ; 

 else if ($status=="success")
 {
 	$_SESSION['memberLogin'] = 'mtabernacle2018';
	 // Redirects the current page ; 
 	header("location:".$nextPage);

 }







?>