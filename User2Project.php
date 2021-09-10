<?php


// Report  any error 
error_reporting(E_ALL);
ini_set('display_errors', 1);

    // Include all neccessary files for this project 
   require_once("includes/login_module.php");
   $pageTitle = "Assign User to Project";  
   require_once("classes/Config.php");
   require_once("header.php");    
   
   // Initializing a status variable 
   $status='';


  //Function to assign user to project group
   if (isset($_POST['submitForm']))
   {
       // Assign POST data to variables 
        $projectid = $_POST['project'];
        $userid = $_POST['user'];
        

        // Notify user is inputs were ignored 
        if ($projectid=='' || $userid=='')
        {
           $status='warning';
           $msg = "All fields are required to be filled before continuing.";
        }else
        {
            // Intialized a new Project Instance 
            $project = new Project();            
            // Assign the Project to a user and save 
            $result = $project->assign_project_user($projectid,$userid);
            $status = $result["status"];
            $msg = $result["msg"];
        }
   }

    

?>
 <body style="background:white">   

   

    


        <br/>
        <br/>
        <br/>
        
        <div class="container">
            <div class="col-xs-12 text-right" style="color:#076ec1;font-size:20px;">
                  <?php
                           $userRole = '';
                           // if user is an admin 
                           if ($_SESSION['myRole']=='admin')
                           {
                              $userRole = 'Administrator';
                           }
                           // if usre is a teamleader 
                           else if ($_SESSION['myRole']=='teamleader')
                           {
                              $userRole = 'Team Leader';

                           }
                           // If user is a member or has no role 
                           else if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
                           {
                              $userRole = 'Member';
                           }

                           // Welcome the user alongside the role 
                           echo "<strong>Welcome ".$_SESSION['myFirstname']."</strong><br>";
                           echo $userRole;
                    ?>
                </div>
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:#076ec1;"><strong>Assign User to Project</strong></h3>
                </div>

                
            </div>
                  
                  <!-- row 1 //-->
                  <br>
             
            <?php
                  require_once("functions/Alert.php");

            ?>
           

             <form name="assign_user_toproject" action="User2Project.php" method="post">     
              
              

              <div class="form-group row">
                  
                  <label for="Project Short Name"  class="col-xs-12 col-sm-2 col-form-label text-right" style="color:gray">Project</label>
                  
                  <div class="form-group col-xs-12 col-sm-5">
                      <select class="form-control" name="project">
                            <option></option>

                            <?php
                                // Get all projects and display them in the select options 
                              $project = new Project();
                              $result = $project->getAllProject();
                              foreach ($result as $row)
                              {
                                $id = $row['id'];
                                $name =  $row['name'];

                          
                            ?>
                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                             

                            <?php

                              }

                            ?>   
                      </select>
                  </div>
              </div>


              <div class="form-group row">
                  
                  <label for="Project Short Name"  class="col-xs-12 col-sm-2 col-form-label text-right"style="color:gray">User</label>
                  
                  <div class="form-group col-xs-12 col-sm-5">
                      <select class="form-control" name="user">
                            <option></option>

                            <?php
                                // Get all users and display them in the select options  
                              $project = new User();
                              $result = $project->getAllUsers();
                              foreach ($result as $row)
                              {
                                $id = $row['id'];
                                $name =  $row['lastname'].' '.$row['firstname'];

                                

                            ?>
                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                             

                            <?php

                              }

                            ?>   
                      </select>
                  </div>
              </div>
                            
              <div class="row" style="margin-top:10px;">
                  
                  <div class="col-xs-2 col-sm-2">&nbsp;</div>
                  <div class="col-xs-10 col-sm-10">
                      <input class="btn btn-primary" type="submit" name="submitForm" value="Create"/>
                  </div>
              </div>
              </form>

              <?php
                // Initialize a Project Instance 
                $project = new Project();
                // Get all the Users 
                $list = $project->getAllProjectsUsers();
                $totalProjectUsers = $list->num_rows;
              ?>

              <!--<br/><br/>
              <div class="row">
                  <div class="col-xs-12">
                    <h4 class="text-left price-headline" style="color:gray;">Assigned  User to Project </h4>
                </div>

              </div>
              <br/>
              <?php
                  // Loop through all the Users and display them 
                  foreach($list as $row)
                  {

                    $role = $row['role'];
                    if ($role=='')
                    {
                      $role= "Member";
                    }
              ?>
              <div class="row" >
                  <div class="col-xs-4">
                        <?php echo "<i class='fa fa-folder-o'></i> <a href='ManageP.php'>".$row['name']."</a>"; ?>
                  </div>
                  <div class="col-xs-3">
                        <?php  
                          echo "<i class='fa fa-user-o'></i> <a href='#'>".$row['lastname'].' '.$row['firstname']."</a>";
                        ?>
                  </div>
                  <div class="col-x3-5">
                      <?php
                          echo "<i class='fa fa-tasks'></i> <a href='#'>".$role."</a>";              
                      ?>
                  </div>

              </div>
              <hr>



              <?php
                  }
              ?>-->
                          
    </div><!-- end of container //--> 

     
  

<br/><br/><br/><br/><br/><br/><br/><br/>
    
</body>
<?php
   require_once("footer.php");

?>
