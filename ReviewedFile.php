<?php


// Report if there is any error 
error_reporting(E_ALL);
ini_set('display_errors', 1);

    // Include needed files for the page 
   require_once("includes/login_module.php");
   $pageTitle = "Assign User to Project";
   require_once("classes/Config.php");
   require_once("header.php");


   $status='';



        // Get All Papers the user reviewed 
        $paper = new Paper();
        $list = $paper->ReviewedPapersByMember($_SESSION['myUserId']);
        $totalPapers = $list->num_rows;


?>
<body style="background:#fff;">
        <br/>
        <br/>
        <br/>

        <div class="container">
            <div class="col-xs-12 text-right" style="color:#076ec1;font-size:20px;">
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
                           // If user is a member or has no role at all 
                           else if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
                           {
                              $userRole = 'Student';
                           }
                           // Welcome the user alongside his/her role 
                           echo "<strong>Welcome ".$_SESSION['myFirstname']."</strong><br>";
                           echo $userRole;
                    ?>
                </div>

            <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:#076ec1;"><strong>My Reviews </strong></h3>
                </div>


            </div>

                  <!-- row 1 //-->
                  <br>




              <?php

                  foreach($list as $row)
                  {
                    $datesubmitted = new DateTime($row['datesubmitted']);
                    $datesubmitted = $datesubmitted->format('l jS F, Y');

                    $assign = '';
                    if ($row['status']=='c' || $row['status']=='r')
                    {
                       $assign="<a href='AssignRev.php?pid=".$row['paperid']."'><strong>Assign reviewer</strong></a>";
                    }

              ?>
              <div class="row" >
                  <div class="col-xs-4" style='background-color: #f1f1f1;border-radius:5px;padding-top:10px;padding-bottom:15px;'>
                        <?php
                            echo "<strong><big>Project</big></strong><br/><i class='fa fa-folder-o'></i> <a href='ManageP.php'>".$row['name']."</a><br/>";
                            echo "<small>Submitted on ".$datesubmitted."</small><br/>";
                        ?>
                        <br/>
                        <?php
                            echo "<strong><big>Paper Title</big></strong><br/><i class='fa fa-comment-o'></i> <a href='FileInfo.php?pid=".$row['paperid']."'><strong>".$row['title']."</strong></a><br/>";
                        ?>
                       <br/>
                       <?php
                            echo "<strong><big>File</big></strong><br/><i class='fa fa-file-o'></i> <a target='_blank' href='uploads/".$row['file']."'>".$row['file']."</a><br/><br/>";

                            //echo "<div style='text-align:right;'><a href='ReviewP.php?pid=".$row['paperid']."'><strong>Review this Paper</strong></a></div>";

                       ?>
                  </div>
                  <div class="col-xs-8">
                        <?php
                        // Get the Paper / Papers  reviewed by the user 
                            $reviews= $paper->paperReviewByMember($row['paperid'],$_SESSION['myUserId']);
                            
                            // Loop through the papers and record the date 
                            foreach($reviews as $rec)
                            {
                              $comment = $rec['comment'];
                              $datecreated= new DateTime($rec['datecreated']);
                              $datecreated = $datecreated->format('l jS F, Y');

                          ?>
                            <div class='row' >
                                <div class='col-xs-12'>
                                    <strong>Review</strong><br/>
                                    <?php
                                      echo "<small>".$datecreated."</small>";


                                        echo "<div style='margin-top:10px;margin-bottom:10px;'>".nl2br($comment)."<br><i class='fa fa-paperclip'></i> <a href='uploads/".$rec['file']."'>".$rec['file']."</a></div><hr>";

                                    ?>
                                </div>
                            </div>

                          <?php

                            }
                          ?>



                  </div>


              </div>
              <hr>



              <?php
                  }
              ?>

    </div><!-- end of container //-->



    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

</body>
<?php
   require_once("footer.php");

?>
