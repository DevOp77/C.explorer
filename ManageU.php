<?php
// display all errors if any
error_reporting(E_ALL);
ini_set('display_errors', 1);
// include the following files from locations
   require_once("includes/login_module.php");
   $pageTitle = "Manage Users";
   require_once("classes/Config.php");
   require_once("header.php");


?>
<body style="background:#fff;">

        <br/>
        <br/>
        <br/>

        <div class="container">
            <div class="col-xs-12 text-right" style="color:#076ec1;font-size:20px;">
                  <?php
                    //   Session identifiers is a unique number which is used to identify every user in a session based environment             
                           // Initialize a variable 
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
                              $userRole = 'student';
                           }
                        //    indicate or print out welcome message with user firstname and role
                           echo "<strong>Welcome ".$_SESSION['myFirstname']."</strong><br>";
                           echo $userRole;
                    ?>
                </div>

            <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:#076ec1;"><strong>Manage Users</strong></h3>
                </div>


            </div>


            <hr>
            <div class="row" >
                <?php
                    
                    // Get all the users so far, Iterate through them and record the dates 
                    $user = new User();
                    $allUsers = $user->getAllUsers();
                    foreach($allUsers as $row)
                    {
                        // accepting variables or arrays and methods as  user data
                      $id = $row['id'];
                      $name = $row['lastname'].' '.$row['firstname'];
                      $email = $row['email'];
                      $location = $row['location'];
                      $address = $row['address'];
                      $country = $row['country'];
                      $pwd = $row['password'];
                      $role = $row['role'];
                      $datecreated = new DateTime($row['datecreated']);
                      $datecreated = $datecreated->format('l jS F, Y');

                      $editUrl="<a href='EditP.php?id=".$id."'>Edit</a>";
                      $deleteUrl = "<a href='DelP.php?id=".$id."'>Delete</a>";

                      // If no role has been specified 
                      if ($role=='')
                      {
                        $role = 'Student';
                      }

                      $memberLink = "<a href='Miembro.php?mp=aHR0cHM6Ly9haXJ2aWV3c3RvcmFnZS5ibG9iLmNvcmUud2luZG93cy5uZX-".$id."-QvYXZhdGFycy9hYzE4ZWNiNjZkN2ZiYTE4YzY3MTUxYzM3MDhiMmMzZQ'>".$name."</a>"

                ?>
                      <div class="row" style="color:black">
                          <div class="col-xs-3">
                              <?php
                                  echo "<strong><i class='fa fa-user-o'></i> ".$memberLink."</strong><br/><small><i class='fa fa-map-marker'></i> ".$location."</small>";
                              ?>
                          </div>
                          <div class="col-xs-3">
                              <?php
                                  echo "<i class='fa fa-envelope-o'></i> ".$email;
                              ?>
                          </div>
                          <div class='col-xs-2'>
                              <?php
                                  echo "<i class='fa fa-tasks'></i> ".$role;
                              ?>
                          </div>
                          <div class="col-xs-4">
                              <?php
                                  echo "<small><i class='fa fa-calendar-o'></i> ".$datecreated."</small>";
                              ?>
                          </div>

                      </div>
                      <hr>

                <?php

                    }
                ?>

            </div>




    </div><!-- end of container //-->





</body>
<?php
    // Include the footer.php
   require_once("footer.php");

?>
