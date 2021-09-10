<?php
	// Include all neccessary files for this page 
    require_once("includes/login_module.php");
	$pageTitle = "Member";
	require_once("classes/Config.php");
    
    
    if (!(isset($_GET['mp']) &&  $_GET['mp']!=''))
    {
		// Redirecting to the landing page 
    	header("location:index.php");
    }
    
	// Assigning Variables 

    $mp = trim($_GET['mp']);
    $mp = explode('-',$mp);
    $memberid = $mp[1];
    $code1 = $mp[0];
    $code2 = $mp[2];

	// Get member by the Id 
    $member = new Member();
    $memberInfo = (object) $member->getMemberById($memberid);

    $memberAddress = '';
	// If the member has no location listed 
    if ($memberInfo->location!='')
    {
    	$memberAddress = $memberInfo->location;
    }

	// If the member has no country listed 
    if ($memberInfo->country!='')
    {
    	if ($memberInfo->location!='')
    	{
    		$memberAddress = $memberAddress.', '.$memberInfo->country;
    	}
    	else
    	{
    		$memberAddress = $memberInfo->country;
    	}
    }

    $memberPhoto = $memberInfo->photo;
	// If the member has a photo  
    if ($memberPhoto!='')
    {	

    	$memberPhoto = 'avatars/'.$memberInfo->photo;
    }else{
		// Else use a default Avatar 
    	$memberPhoto = 'avatars/avatar200.png';
    }


    
	// Import the general header file 
    require_once("header.php");
    

	// Save the userid from session in a variable 
    $myUserId = $_SESSION['myUserId'];

    


    

   
   	
    
?>
<body style="background:black">

<br/><br/> 
<div class="container">
	<div class="row">
		<div class="col-sm-12 profileTitle-Without-Top-Border text-right" style="color:green"><?php echo $memberInfo->lastname.' '.$memberInfo->firstname; ?><!-- TRATAR DE CAMBIAR LA FUENTE-->
			
		</div>
	</div>
	<div class="row">
	   	<div class="col-sm-3" style="text-align:center;border-radius:15px;">
	   		<img src="<?php echo $memberPhoto; ?>" id="userphoto" class="img-circle" width=150px" height='150px' hspace="2px" align="center" style="margin-bottom:5px;" ><br/>
	   		
	   	</div>
	   	<div class="col-sm-9" ><!-- column 1 //-->
	   		<div class="row" style="color:green">
	   			<div class="col-md-8 col-sm-12 profileTitle" style="padding:10px;font-size:16px;">
	   					<i class='fa fa-map-marker'> <?php echo $memberAddress; ?></i>
	   			</div>
	   			<div class="col-md-4 col-sm-12 profileTitle text-right" style="padding:10px;font-size:16px;">

	   				
	   			</div>
	   		</div>
	   		
	   		<div class="row" >
	   				<div class="col-xs-12" style="color:#c3c3c3">
	   						<div> 
	   								<h3> <?php echo "<font color='green';><i class='fa fa-user-o'></i> About ".$memberInfo->lastname.' '.$memberInfo->firstname.'</font>'; ?> </h3><hr>
	   								<?php
	   									echo "<font size='+0.5'>".nl2br($memberInfo->aboutme)."</font>";
	   								 ?>
	   						</div>



	   				</div>
	   		</div>
	   		<a name="sendMessage"></a>
	   		
	   		

	   		<br/>
	   		
			   	

				



	   	</div><!-- end of column 2 //-->

	</div><!-- outer row //-->
	

	

</div><!-- end of container //-->





<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<boby>
<?php

   require_once("footer.php");

?>
 <script type="text/javascript" src="js/avatar.js"></script>
 <script type="text/javascript">
 	$("document").ready(function(){

 		//------------------------------------------------------------
	 		$("#btnMessage").bind("click",function(){
	 			 var message = $("#txtMessage").val();
	 			 var sender = $("#sender").val();
	 			 var recipient = $("#recipient").val();

	 			 var dataArray = {"sender":sender,"recipient":recipient,"message":message};

	 			 if (message!='')
	 			 {
   						$.ajax({
   							type: "POST",
   							url: "server/send_message.php",
   							data: dataArray,
   							success: function(data){
   									$("#conversations").eq(0).prepend(data);
					  				$("#conversations").children().eq(0).hide();
					  				$("#conversations").children().eq(0).slideDown("slow");
					  				$("#txtMessage").val('');
   							},
   							error: function(data){
   									alert(data);
   							}

   						});
	 			 }
	 			 
	 		});
 		//-------------------------------------------------------------

 	});

 </script>