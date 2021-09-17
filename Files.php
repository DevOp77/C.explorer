
  <?php

// Report errors if any 
error_reporting(E_ALL);
ini_set('display_errors', 1);

    // Include all the required files for this page 
   require_once("includes/login_module.php");
   $pageTitle = "Manage Users";
   require_once("classes/Config.php");
   require_once("header.php");




    // Initialize variables and instances of classes 
   $paper = new Paper();
   $submissions = '' ;
   $reviews = '';
   $archive = '';
    
    // If the user is an admin or a teamleader 

   if ($_SESSION['myRole']=='admin' || $_SESSION['myRole']=='teamleader' )
   {
      $submissions = @$paper->getAllSubmitedPapers();
      $reviews = $paper->getAllPapersInReview();


   }
   // If the user is a member or has no role at all 
   if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
   {
       // Get all the papers submitted by the user 
      $submissions = $paper->SubmitedPapersByMember($_SESSION['myUserId']);
      $reviews = $paper->MemberAssignedPapersInReview($_SESSION['myUserId']);


   }

   // Get all reviewed Papers so far 

   $archive = $paper->ReviewedPapers();

   $totalSubmissions = @$submissions->num_rows;
   $totalPapersInReview = @$reviews->num_rows;
   $totalInArchive = $archive->num_rows;



?>





<body style=background:#fff>

        <br/>
        <br/>
        <br/>

        <div class="container" >

            <div class="row" style="color:#076ec1;font-size:20px;">
                <div class="col-xs-12 text-right">
                  <?php
                           $userRole = '';
                           // If the user is an admin 
                           if ($_SESSION['myRole']=='admin')
                           {
                              $userRole = 'Administrator';
                           }
                           // if the user is a teamleader 
                           else if ($_SESSION['myRole']=='teamleader')
                           {
                              $userRole = 'Supervisor';

                           }
                           // If the user is a member or has no role at all 
                           else if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
                           {
                              $userRole = 'Student';
                           }
                           // Welcome the user and display the role 
                           echo "<strong>Welcome ".$_SESSION['myFirstname']."</strong><br>";
                           echo $userRole;
                    ?>
                </div>

                <!--Browse Header-->
                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:#076ec1;"><strong>Archives</h3><strong>
                </div>


            </div>


            <br/>
            <div class="row">
               <div class='col-xs-12'>
                    <div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                              <!--<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" style="color:green"><strong>Submissions (<?php echo $totalSubmissions; ?>)</strong></a></li>-->
                              <!--<li role="presentation" ><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"style="color:green"><strong>Reviews (<?php echo $totalPapersInReview; ?>)</strong></a></li><br/>-->
                              <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"style="color:red;"><strong>Archives (<?php echo $totalInArchive; ?>)</strong></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div role="tabpanel" class="tab-pane active" id="home" style="color:#212121;">
                              <br/>
                                  <!--<div class='row'>
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
                                  <hr>
                                 <!-- <?php

                                        // Loop through all Submitted Papers and record the date

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




<!-- <In Reviews // -->
                              </div>
                             <!--<div role="tabpanel" class="tab-pane active" id="profile">

                              <br/>
                                  <div class="row" style="color:green">
                                      <div class="col-xs-4">
                                          <strong><big>Project Group</big></strong>
                                      </div>
                                      <div class="col-xs-5">
                                              <strong><big>Paper</big></strong>
                                      </div>
                                  </div>

                              <br/>


                                <?php
                                    // Loop through all fetched reviews and display the results 
                                      foreach($reviews as $res)
                                      {

                                          $paperid = $res['id'];

                                ?>
                                      <div class="row" style="color:green">
                                          <div class="col-xs-4">
                                                <i class='fa fa-folder-o'></i>
                                                <?php echo "<a href='projects.php'>".$res['name']."</a>";  ?>

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
                                                            $selReviewers = $paper->getReviewersToPaper($paperid);

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
                                <br/>-->


                              <!-- end of reviews //-->
                              <div role="tabpanel" class="tab-pane active" id="messages" style="color:#000;">
                                <br/>
                                <?php
                                      foreach($archive as $row)
                                      {
                                         $datesubmitted = new DateTime($row['datesubmitted']);
                                          $datesubmitted = $datesubmitted->format('l jS F, Y');
                                        $photo = "";

                                        // If the user already has a predefined photo 
                                        if ($row['photo']!='')
                                        {
                                          $photo = 'avatars/'.$row['photo'];
                                        }
                                        // If not user a default Avatar 
                                        else{
                                          $photo = "avatars/avatar200.png";
                                        }
                                        $code1 = 'oDdpnVaWwgdsjhMFiyIeLjJjSUCThpJUxfUVwTGnNSGeMLToTq';
                                        $code2 = 'FoltjKlLKnBdPvQfPQi!oLU!lStPXzTyZomFgktMQluhRbCDHe';

                                ?>
                                    <div class='row' >
                                        <div class='col-xs-12'>
                                            <?php
                                                echo "<div ><strong><i class='fa fa-file-o'></i> <a href='FileInfo.php?pid=".$row['paperid']."'>".$row['title']."</a> submitted on:$datesubmitted. </strong><div style='padding-top:10px;'>".nl2br($row['comment'])."</div></div>";
                                                echo "<div><i class='fa fa-paperclip'></i> <a href='uploads/".$row['reviewedfile']."'>".$row['reviewedfile']."</a></div>";
                                                echo "<div style='text-align:right;background-color:white;'><a href='Miembro.php?mp=".$code1.'-'.$row['memberid'].'-'.$code2."'>".$row['lastname'].' '.$row['firstname']."</a> <img class='img-circle' style='width:50px;height:50px;' src='".$photo."'><br/></div>"
                                             ?>


                                        </div>

                                    </div>
                                    <hr>

                                <?php
                                      }


                                ?>





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
