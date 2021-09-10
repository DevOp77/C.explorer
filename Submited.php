<?php


// Error reporter
error_reporting(E_ALL);
ini_set('display_errors', 1);
    // Include the files needed for this page   
   require_once("includes/login_module.php");
   $pageTitle = "Assign User to Project";
   require_once("classes/Config.php");
   require_once("header.php");


   $status='';



                // Initialize a Paper instance and get all Submitted Papers by the Argument provided
                $paper = new Paper();
                $list = $paper->SubmitedPapersByMember($_SESSION['myUserId']);
                $totalPapers = $list->num_rows;


?>
<body style="background:#fff;">
        <br/>
        <br/>
        <br/>

        <div class="container"style="color:#076ec1;font-size:20px;">
            <div class="col-xs-12 text-right">
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
                           else if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
                           {
                              $userRole = 'Student';
                           }
                           // Welcome the user alongside the role 
                           echo "<strong>Welcome ".$_SESSION['myFirstname']."</strong><br>";
                           echo $userRole;
                    ?>
                </div>

            <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:#076ec1;"><strong>My Paper Submissions </strong></h3>
                </div>


            </div>

                  <!-- row 1 //-->
                  <hr>






              <div class="row" style="color:#212121;">
                  <div class="col-xs-4">
                        <strong><big>Project</big></strong>
                  </div>
                  <div class="col-xs-4">
                        <strong><big>Paper Title</big></strong>
                  </div>
                  <div class="col-xs-4">
                      <strong><big>File</big></strong>
                  </div>

              </div>
              <br/>
              <?php

                // Looping through all submitted papers retrieved and displaying them 
                  foreach($list as $row)
                  {
                      // Record the dates 
                    $datesubmitted = new DateTime($row['datesubmitted']);
                    $datesubmitted = $datesubmitted->format('l jS F, Y');

                    $assign = '';
                    if ($row['status']=='s' || $row['status']=='r')
                    {
                       $assign="<a href='AssignRev.php?pid=".$row['id']."'><strong>Assign reviewer</strong></a>";
                    }

              ?>
              <!-- DISPLAY SUBMITTED PAPERS  -->
              <div class="row" style="color:#212121;">
                  <div class="col-xs-4">
                        <?php
                            echo "<i class='fa fa-folder-o'></i> <a href='ManageP.php'>".$row['name']."</a><br/>";
                            echo "<small>Submitted on ".$datesubmitted."</small>";
                        ?>
                  </div>
                  <div class="col-xs-4">
                        <?php
                            echo "<i class='fa fa-comment-o'></i> <a href='FileInfo.php?pid=".$row['id']."'>".$row['title']."</a><br/>";
                        ?>
                  </div>
                  <div class="col-xs-4">
                      <?php
                            echo "<i class='fa fa-file-o'></i> <a target='_blank' href='uploads/".$row['file']."'>".$row['file']."</a>";
                      ?>
                  </div>

              </div>
              <hr>



              <?php
                  }
              ?>

    </div><!-- end of container //-->





</body>
<br><br><br><br><br>
<?php
   require_once("footer.php");

?>
