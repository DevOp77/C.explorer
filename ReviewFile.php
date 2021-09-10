<?php


// General error checker 

error_reporting(E_ALL);
ini_set('display_errors', 1);
    
    // Include files for this page 
   require_once("includes/login_module.php");
   $pageTitle = "Assign User to Project";
   require_once("classes/Config.php");
   require_once("header.php");

    // Initialize a status variable 
   $status='';

   // Get all the Papers Being Reviewed 
   $paper = new Paper();
   $reviews = $paper->getAllPapersInReview();
   $numInReview = $reviews->num_rows;






?>
<body style="background:#fff;">
        <br/>
        <br/>
        <br/>

        <div class="container">
            <div class="col-xs-12 text-right" style="color:#076ec1; font-size:20px;">
                  <?php
                           $userRole = '';

                           // If user is an admin 
                           if ($_SESSION['myRole']=='admin')
                           {
                              $userRole = 'Administrator';
                           }
                           // If user is a teamleader 
                           else if ($_SESSION['myRole']=='teamleader')
                           {
                              $userRole = 'Supervisor';

                           }
                           // If user is a member or has no role 
                           else if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
                           {
                              $userRole = 'Student';
                           }
                           // Welcome the user and display the role 
                           echo "<strong>Welcome ".$_SESSION['myFirstname']."</strong><br>";
                           echo $userRole;
                    ?>
                </div>



              <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:#076ec1;;"><strong>Papers in Review </strong></h3>
                </div>
              </div>

              <br>



              <div class="row" style="color:#212121;">
                        <div class="col-xs-4">
                              <strong ><big>Project Group</big></strong>
                        </div>
                        <!--<div class="col-xs-5">
                                <strong><big>Paper</big></strong>
                        </div>-->
              </div>

              <br/>


              <?php
                // Loop through the reviews and display each of them 
                    foreach($reviews as $res)
                    {

                        $paperid = $res['id'];

              ?>
                    <div class="row">
                        <div class="col-xs-4"style="color:#076ec1;">
                              <i class='fa fa-folder-o'></i>
                              <?php echo "<a href=#>".$res['name']."</a>";  ?>

                        </div>
                        <!--<div class="col-xs-5">  todas estas lineas se necesitan borrar
                                <i class='fa fa-file-o'></i>
                                <?php echo "<a href='FileInfo.php?pid=".$res['id']."'>".$res['title']."</a>";
                                ?>
                        </div>-->
                        <div class="col-xs-12" style="color:#212121;font-size:18px;">
                                  <h5><strong>Assigned Reviewers</strong></h5>
                                  <ol>
                                      <?php
                                        // Fetch all the Reviewers and display them 
                                          $selReviewers = $paper->getReviewersToPaper($paperid);
                                          // Loop through the reviewrs and record the dates 
                                          foreach($selReviewers as $row)
                                          {
                                              $dateassigned = new DateTime($row['dateassigned']);
                                              $dateassigned = $dateassigned->format('l jS F, Y');
                                              echo "<li>".$row['lastname'].' '.$row['firstname']."  - <small>assigned on ".$dateassigned." &nbsp;&nbsp;&nbsp;<strong>(Duration: ".$row['duration']." days)</strong></small></li>";

                                          }

                                    ?>
                                  </ol>

                        </div>
                    </div>
                    <br>
              <?php

                    }

              ?>











    </div><!-- end of container //-->





</body>
<?php
   require_once("footer.php");

?>
