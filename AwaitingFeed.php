<?php

// display all errors if any
// Check for errors and display them if there is 
error_reporting(E_ALL);
ini_set('display_errors', 1);
// include the following files from locations
   require_once("includes/login_module.php");
   $pageTitle = "Papers assigned awaiting review";
   require_once("classes/Config.php");
   require_once("header.php");

// creating variables to accept input and access properties
   $status='';

   // Create a Paper instance and get the MemberAssignedPapers 
   $paper = new Paper();
   $reviews = $paper->MemberAssignedPapersInReview($_SESSION['myUserId']);
   $numInReview = $reviews->num_rows;






?>
<body style="background:#fff;">
        <br/>
        <br/>
        <br/>

        <div class="container">
            <div class="col-xs-12 text-right" style="color:#076ec1;font-size:20px;">
                  <?php
                  //   Session identifiers is a unique number which is used to identify every user in a session based environment                              
                           $userRole = '';
                           // If the identifier key is equal to 'admin' , run this 
                           if ($_SESSION['myRole']=='admin')
                           {
                              // Assign 'Administrator' to the $userRole variable 
                              $userRole = 'Administrator';
                           }
                           // If the identifier key is equal to 'teamleader', run this 
                           else if ($_SESSION['myRole']=='teamleader')
                           {
                              // Assign 'Supervisor the the $userRole variable instead ; 
                              $userRole = 'Supervisor';

                           }
                           // If the identifier key is equal to 'member', run this 
                           else if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
                           {
                              $userRole = 'Student';
                           }
                           // Welcome the user alongside the userRole  
                           echo "<strong>Welcome ".$_SESSION['myFirstname']."</strong><br>";
                           echo $userRole;
                    ?>
                </div>



              <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:#076ec1;"><strong>Assigned Papers Awaiting Review</strong></h3>
                </div>
              </div>

              <br>



              <div class="row"style="color:#000;">
                        <div class="col-xs-4">
                              <strong><big>Project Group</big></strong>
                        </div>
                        <div class="col-xs-5">
                                <strong><big>Paper</big></strong>
                        </div>
              </div>

              <br/>


              <?php
              // Loop through the reviews fetched and display them 
                    foreach($reviews as $res)
                    {

                        $paperid = $res['id'];

              ?>
                    <div class="row">
                        <div class="col-xs-4">
                              <i class='fa fa-folder-o'></i>
                              <?php echo "<a >".$res['name']."</a>";  ?>

                        </div>
                        <div class="col-xs-5">
                                <i class='fa fa-file-o'></i>
                                <?php echo "<a href='FileInfo.php?pid=".$res['id']."'>".$res['title']."</a>";
                                ?>
                        </div>
                        <div class="col-xs-3">

                                <?php
                                   echo "<strong><big>
                                            <a href='ReviewP.php?pid=".$res['id']."'>Review this Paper</a>
                                         </big></strong>";
                                ?>
                        </div>
                        <div class="col-xs-12">
                                  <h5><strong>Assigned Reviewers</strong></h5>
                                  <ol>
                                      <?php
                                          // Fetch the Paper Reviewers by the Paper Id
                                          $selReviewers = $paper->getReviewersToPaper($paperid);

                                          // Loop through the results and display each of them 
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
                    <hr>
              <?php

                    }

              ?>



    </div><!-- end of container //-->




    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
</body>
<?php
// include the footer file
   require_once("footer.php");

?>
