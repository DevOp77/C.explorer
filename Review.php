
<?php

// Check for error 
error_reporting(E_ALL);
ini_set('display_errors', 1);
    // Include needed files for this page 
   require_once("includes/login_module.php");
   $pageTitle = "Manage Users";
   require_once("classes/Config.php");
   require_once("header.php");




    // Initialize a new Instance of Paper 
   $paper = new Paper();
   // Initialize the variables to be used 
   $submissions = '' ;
   $reviews = '';
   $archive = '';

   // If the user is an admin or is a teamleader 
   if ($_SESSION['myRole']=='admin' || $_SESSION['myRole']=='teamleader' )
   {
       // Retrieve all the Submitted Papers 
      $submissions = @$paper->getAllSubmitedPapers();

      // Retrieve all the Reviewed Papers 
      $reviews = $paper->getAllPapersInReview();


   }
   // If the user is a member or has no role at all 
   if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
   {

    // Get the Papers Submitted by user 

      $submissions = $paper->SubmitedPapersByMember($_SESSION['myUserId']);
      
      // Get Papers Reviewed by the user 
      $reviews = $paper->MemberAssignedPapersInReview($_SESSION['myUserId']);


   }

   // Get all Reviewed Papers 
   $archive = $paper->ReviewedPapers();

   $totalSubmissions = @$submissions->num_rows;
   $totalPapersInReview = @$reviews->num_rows;
   $totalInArchive = $archive->num_rows;



?>





<body style=background:#fff;>

        <br/>
        <br/>
        <br/>

        <div class="container" >

            <div class="row" style="color:#076ec1;font-size:20px;">
                <div class="col-xs-12 text-right">
                  <?php
                           $userRole = '';
                           // if user is an admin 
                           if ($_SESSION['myRole']=='admin')
                           {
                              $userRole = 'Administrator';
                           }
                           // if user is a teamleader 
                           else if ($_SESSION['myRole']=='teamleader')
                           {
                              $userRole = 'Supervisor';

                           }
                           // If user is a member or has no role at all 
                           else if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
                           {
                              $userRole = 'Student';
                           }
                           // Welcome the user and show the user's role 
                           echo "<strong>Welcome ".$_SESSION['myFirstname']."</strong><br>";
                           echo $userRole;
                    ?>
                </div>

                <!--Browse Header-->
                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:#076ec1;"><strong>Reviews</h3><strong>
                </div>


            </div>


            <br/>
            <div class="row">
               <div class='col-xs-12'>
                    <div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                              <!--<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" style="color:green"><strong>Submissions (<?php echo $totalSubmissions; ?>)</strong></a></li>-->
                              <li role="presentation" ><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"style="color:Red;"><strong>Reviews (<?php echo $totalPapersInReview; ?>)</strong></a></li><br/>
                              <!--<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"style="color:green"><strong>Archives (<?php echo $totalInArchive; ?>)</strong></a></li>-->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                              <!--<div role="tabpanel" class="tab-pane active" id="home" style="color:green">
                              <br/>
                                  <div class='row'>
                                      <div class='col-xs-4' >
                                          <strong><big>Project Group</big></strong>
                                      </div>
                                      <div class='col-xs-4'>
                                          <strong><big>Title</big></strong>
                                      </div>
                                      <div class='col-xs-4'>
                                          <strong><big>File</big></strong>
                                      </div>
                                  </div>
                                  <hr>remover-->
                                 <!-- <?php

                                        // Loop through the Papers Submitted and Record the Dates
                                        foreach($submissions as $row)
                                        {
                                          $datesubmitted = new DateTime($row['datesubmitted']);
                                          $datesubmitted = $datesubmitted->format('l jS F, Y');
                                  ?>
                                      <div class='row' >
                                          <div class='col-xs-4'>
                                              <?php
                                                  echo "<i class='fa fa-folder-o'></i> <a href='#'>".$row['name']."</a><br/>";
                                                  echo "<small>Submitted on ".$datesubmitted."</small>"
                                              ?>
                                          </div>
                                          <div class='col-xs-4'>
                                                <?php
                                                    echo "<i class='fa fa-file-o'></i> <a href='FileInfo.php?pid=".$row['id']."'>".$row['title']."</a>";

                                                ?>
                                          </div>
                                          <div class='col-xs-4'>
                                                <?php
                                                    echo "<i class='fa fa-paperclip'></i> <a href='uploads/".$row['file']."'>".$row['title']."</a>";

                                                  ?>
                                          </div>
                                      </div>
                                      <hr>
                                  <?php

                                        }

                                  ?>-->





                              </div>
                              <div role="tabpanel" class="tab-pane" id="profile">
                              <!-- In Reviews //-->
                              <br/>
                                  <div class="row" style="color:#000">
                                      <div class="col-xs-4">
                                          <strong><big>Project Group</big></strong>
                                      </div>
                                      <div class="col-xs-5">
                                              <strong><big>Paper</big></strong>
                                      </div>
                                  </div>

                              <br/>


                                <?php
                                    // Loop through the Reviews and display all of them 
                                      foreach($reviews as $res)
                                      {

                                          $paperid = $res['id'];

                                ?>
                                      <div class="row" style="color:#000;font-size:18px;">
                                          <div class="col-xs-4">
                                                <i class='fa fa-folder-o' style="color:#000;"></i>
                                                <?php echo "<a href='projects.php'>".$res['name']."</a>";  ?>

                                          </div>
                                          <div class="col-xs-5">
                                                  <i class='fa fa-file-o'style="color:#000;"></i>
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
                                                            // Get all the Reviewers 
                                                            $selReviewers = $paper->getReviewersToPaper($paperid);
                                                            // Iterate through the reviewers and 
                                                            // append their details in a list 
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
                                <br/>


                              <!-- end of reviews //-->






                              </div>

                            </div>

                          </div>
               </div><!-- end of col //-->
            </div><!-- end of row //-->



    </div><!-- end of container //-->




    </body>
<br/><br/><br/><br/><br/>
<?php
   require_once("footer.php");

?>
