<?php

    // Basically the page that loads if your auth went on successfully

// display all errors if any
error_reporting(E_ALL);
ini_set('display_errors', 1);
// include the following files from locations
   require_once("includes/login_module.php");
   $pageTitle = "Manage Users";  
   require_once("classes/Config.php");
   require_once("header.php");    
   

   
   
// creating variables or methods to accept inputs

    // Initializing an instance of the Paper class ; 
   $paper = new Paper();

   // Initialize variables 
   $submissions = '' ;
   $reviews = '';
   $archive = '';

//    conditions based on roles to variables or access properties or methods

    // Statements that executes if $_SESSION is not a member or is not empty ; 

   if ($_SESSION['myRole']=='admin' || $_SESSION['myRole']=='teamleader' )
   {
      $submissions = @$paper->getAllSubmitedPapers();
      $reviews = $paper->getAllPapersInReview();
      

   }
   // Statements that executes if the above is not met 
   if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
   {
       // Sumbit the Papers by the userId provided 

      $submissions = $paper->SubmitedPapersByMember($_SESSION['myUserId']);

      $reviews = $paper->MemberAssignedPapersInReview($_SESSION['myUserId']);
      
      
   }
   
   //  Get all reviewed Papers 
    $archive = $paper->ReviewedPapers();

   
   $totalSubmissions = @$submissions->num_rows;
   $totalPapersInReview = @$reviews->num_rows;
   $totalInArchive = $archive->num_rows;

    

?>
    

   

    
<body style=background:white>  

        <br/>
        <br/>
        <br/>
                
        <div class="container" >

            <div class="row" style="color:#076ec1;font-size:20px;">
                <div class="col-xs-12 text-right">
                  <?php
                   //   Session identifiers is a unique number which is used to identify every user in a session based environment               
                           $userRole = '';
                           // Run this is the user is an admin ; 
                           if ($_SESSION['myRole']=='admin')
                           {
                              $userRole = 'Administrator';
                           }
                           // Run this if the user is a teamleader 
                           else if ($_SESSION['myRole']=='teamleader')
                           {
                              $userRole = 'Supervisor';

                           }
                           // Run this is the user is a member or does not have a role at all 
                           else if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
                           {
                              $userRole = 'Student';
                           }
                            // Welcome the user and also display the user's role  
                           echo "<strong>Welcome ".$_SESSION['myFirstname']."</strong><br>";
                           echo $userRole;
                    ?>
                </div>

                <!--Browse Header-->
                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:#076ec1;"><strong>Research Works</h3><strong>
                </div>

                
            </div>
                  
                  
            <br/>
            <div class="row">
               <div class='col-xs-12'>
                    <div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" style="color:red;font-size:16px;"><strong>Submissions (<?php echo $totalSubmissions; ?>)</strong></a></li>
                              <!--<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"style="color:green"><strong>Reviews (<?php echo $totalPapersInReview; ?>)</strong></a></li>
                              <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"style="color:green"><strong>Archives (<?php echo $totalInArchive; ?>)</strong></a></li>-->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div role="tabpanel" class="tab-pane active" id="home" style="color:black">
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
                                  <hr>
                                 <?php

                                    //    for each submission made, record date as current date in the datesubmitted array and use date format
                                        foreach($submissions as $row)
                                        {
                                          $datesubmitted = new DateTime($row['datesubmitted']);
                                          $datesubmitted = $datesubmitted->format('l jS F, Y');

                                          // And also display the results 
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

                                  ?>





                              </div>
                              <div role="tabpanel" class="tab-pane" id="profile">
                              <!-- In Reviews //-->
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
                                // for each review made
                                      foreach($reviews as $res)
                                      {
                                        // let paper id variable match to resource id in database
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
                                                          // for each reviewer made, create date assigned and use date format and print out details of assignee, date and duration of review
                                                          //Iterate through all reviewers and display them in a list   
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



                              
                                <?php
                                // for archives show image and reviews of a work
                                      foreach($archive as $row)
                                      {
                                        $photo = "";

                                        // Display the Avatar provided by the user if any  
                                        if ($row['photo']!='')
                                        {
                                          $photo = 'avatars/'.$row['photo'];
                                        }
                                        // Else display a default Avatar ; 
                                        else{
                                          $photo = "avatars/avatar200.png";
                                        }
                                        $code1 = 'oDdpnVaWwgdsjhMFiyIeLjJjSUCThpJUxfUVwTGnNSGeMLToTq';
                                        $code2 = 'FoltjKlLKnBdPvQfPQi!oLU!lStPXzTyZomFgktMQluhRbCDHe';

                                ?>
                                    <div class='row' >
                                        <div class='col-xs-12'>
                                            <?php
                                                echo "<div ><strong><i class='fa fa-file-o'></i> <a href='FileInfo.php?pid=".$row['paperid']."'>".$row['title']."</a></strong><div style='padding-top:10px;'>".nl2br($row['comment'])."</div></div>";
                                                echo "<div><i class='fa fa-paperclip'></i> <a href='uploads/".$row['reviewedfile']."'>".$row['reviewedfile']."</a></div>";
                                                echo "<div style='text-align:right;background-color:black;'><a href='Miembro.php?mp=".$code1.'-'.$row['memberid'].'-'.$code2."'>".$row['lastname'].' '.$row['firstname']."</a> <img class='img-circle' style='width:50px;height:50px;' src='".$photo."'><br/></div>"
                                             ?>


                                        </div>

                                    </div>
                                    <hr>

                                <?php
                                      }


                                ?>-->





                              </div>
                              
                            </div>

                          </div>
               </div><!-- end of col //-->
            </div><!-- end of row //-->
             
            
                          
    </div><!-- end of container //--> 

     
  

    </body>    
<br/><br/><br/><br/><br/>
<!-- include the footer from location -->
<?php
   require_once("footer.php");

?>

