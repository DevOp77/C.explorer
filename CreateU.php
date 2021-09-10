<?php

// Notify is there is any Error ;
error_reporting(E_ALL);

ini_set('display_errors', 1);
// Import the required pages for this page 
   require_once("includes/login_module.php");
   $pageTitle = "Create User";  
   require_once("classes/Config.php");
   require_once("header.php");    
   
   
   $status='';

   if (isset($_POST['submitForm']))
   {
       // Assign the values for the POST body to new variables for further actions 
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        
    // Prompt user if any of the required information haven't been filled out 
        if ($lastname=='' || $firstname=='' || $email=='' || $password=='' || $role=='x')
        {
           $status='warning';
           $msg = "All fields are required to be filled before continuing.";
        }
        // If all needed information have been filled out, initiate an intance of User 
        else
        {
            // Create a new user and save the Initiated Instance 
            $user = new User();
            $result = $user->createuser($lastname,$firstname,$email,$password,$role);
            $status = $result["status"];
            $msg = $result["msg"];
        }
   }

    

?>
<body  style="background:white">    
        <br/>
        <br/>
        <br/>
   
        <div class="container">
            <div class="col-xs-12 text-right" style="color:#076ec1;font-size:20px;">

            <!-- defining sessions for users based on type -->
                  <?php
                           $userRole = '';
                           // If the user is an admin 
                           if ($_SESSION['myRole']=='admin')
                           {
                              $userRole = 'Administrator';
                           }
                           // If the user is a teamleader 
                           else if ($_SESSION['myRole']=='teamleader')
                           {
                              $userRole = 'Supervisor';

                           }
                           // If the user is a member or has no role 
                           else if ($_SESSION['myRole']=='member'  || $_SESSION['myRole']=='')
                           {
                              $userRole = 'Student';
                           }

                           // Welcome the user and notify the user of his/her role 
                           echo "<strong>Welcome ".$_SESSION['myFirstname']."</strong><br>";
                           
                           echo $userRole;
                    ?>
                </div>

            <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:#076ec1;"><strong>Create User</h3></strong>
                </div>

                
            </div>
                  
                  <!-- row 1 //-->
                  <br>
             <!-- including  details from another file -->
            <?php
                  require_once("functions/Alert.php");

            ?>
           
                           <!-- creating a form -->
             <form name="create_user" action="CreateU.php" method="post">     
              <div class="form-group row" style="color:gray">
            
                   <label for="Project Name" class="col-xs-12 col-sm-2 col-form-label text-right">Last Name</label>
                      
                    <div class="col-xs-12 col-sm-5">
                        
                            <input class="form-control" type="text" name="lastname"/>                     
                    </div> 

              </div>
              <div class="form-group row" style="color:gray">
                  
                  <label for="Project Short Name"  class="col-xs-12 col-sm-2 col-form-label text-right">First Name</label>
                  
                  <div class="col-xs-12 col-sm-5">
                      <input class="form-control" type="text" name="firstname"/>
                  </div>
              </div>
              <div class="form-group row" style="color:gray">
                  
                  <label for="Project Short Name"  class="col-xs-12 col-sm-2 col-form-label text-right">Username</label>
                  
                  <div class="col-xs-12 col-sm-5">
                      <input class="form-control" type="text" name="email"/>
                  </div>
              </div>
              <div class="form-group row" style="color:gray">
                  
                  <label for="Project Short Name"  class="col-xs-12 col-sm-2 col-form-label text-right">Password</label>
                  
                  <div class="col-xs-12 col-sm-5">
                      <input class="form-control" type="text" name="password"/>
                  </div>
              </div>

              <div class="form-group row" style="color:gray">
                  
                  <label for="Project Short Name"  class="col-xs-12 col-sm-2 col-form-label text-right">Role</label>
                  
                  <div class="form-group col-xs-12 col-sm-5">
                      <select class="form-control" name="role"/>
                            <option></option>
                            <option>teamleader</option>
                            <option value=''>Student</option>    
                      </div>
                  </div>
              </div>
              
              <div class="row"><br/>
              </div>
              
              <div class="form-group row" style="margin-top:10px;">
                  <div class="col-xs-12 col-sm-2"></div>

                  
                  <br/>

                  <div class="col-xs-12 col-sm-10" >
                      <input style="font-size:20px;margin-top:20px !important;" class="btn btn-primary" type="submit" name="submitForm" value="Create"/>
                  </div>
              </div>
              </form>
                          
    </div><!-- end of container //--> 

     
  

    
<br/><br/><br/>
</body>
<?php
   require_once("footer.php");

?>
