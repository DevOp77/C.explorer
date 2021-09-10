<?php
// display all errors if any
error_reporting(E_ALL);
ini_set('display_errors', 1);
// include the following files from locations
   require_once("includes/login_module.php");
   $pageTitle = "Manage Project";
   require_once("classes/Config.php");
   require_once("header.php");


?>
 <body style="background:white;">

        <br/>
        <br/>
        <br/>

        <div class="container">
            <div class="col-xs-12 text-right" style="color:#076ec1; font-size:20px;">
                  <?php
                     //   Session identifiers is a unique number which is used to identify every user in a session based environment
                  
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
                           // If the user is a member or has no role at all 
                           else if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
                           {
                              $userRole = 'Student';
                           }
                           // Display the user role to the user 
                           echo "<strong>Welcome ".$_SESSION['myFirstname']."</strong><br>";
                           echo $userRole;
                    ?>
                </div>

            <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:black;"><strong>Manage Project Fields</h3></strong>
                </div>


            </div>


            <hr>
            <div class="row">
                <?php
                    // Get all Projects and Iterate through all of them 
                    $project = new Project();
                    
                    $allProjects = $project->getAllProject();
                    
                    // Iterate and save the current date in a date format 
                    foreach($allProjects as $row)
                    {
                        // creating variables and apassing as arrays
                      $id = $row['id'];
                      $name = $row['name'];
                      $code = $row['code'];
                      $datecreated = new DateTime($row['datecreated']);
                      $datecreated = $datecreated->format('l jS F, Y');

                      $editUrl="<a href='EditP.php?id=".$id."'>Edit</a>";
                      $deleteUrl = "<a href='DelP.php?id=".$id."'>Delete</a>";


                ?>
                      <div class="row" style="color:#076ec1;font-size:16px;">
                          <div class="col-xs-12">
                              <?php
                                echo "<strong></i> ".$name."</strong><br/><small><i class='fa fa-edit'></i> ".$editUrl." &nbsp; &nbsp;| &nbsp;&nbsp; <i class='fa fa-trash-o'></i> ".$deleteUrl."</small>";
                              ?>
                          </div>
                      </div>
                      <hr>

                <?php

                    }
                ?>

            </div>




    </div><!-- end of container //-->




 </br></br></br></br></br></br></br></br></br></br></br>
 </body>
  <!-- include the footer from location -->
<?php
   require_once("footer.php");

?>
