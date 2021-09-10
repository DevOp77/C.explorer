<!--Credential Validation-->
<?php

if (!isset($_GET['pid']) || $_GET['pid']=='')
{
  header("location: Submited.php");
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

    // Include files needed by the FileInfo page 
   require_once("includes/login_module.php");
   $pageTitle = "Assign User to Project";  
   require_once("classes/Config.php");
   require_once("header.php");    
   
   
   $status='';

   // Intitiate a Paper instance and get paper by its unique id 
   $paperid = $_GET['pid'];
   $pageLink = "AssignRev.php?pid=".$paperid;
   $paper = new Paper();
   $paperInfo  = $paper->getPaperById($paperid);

   
   // Loop through the results variable and assign elements in a row to a variable 

   foreach($paperInfo as $result)
   {
      $paperTitle = $result["title"];
      $paperProject = $result['name'];
      $paperDesc = $result['description'];
      $paperFile = $result['file'];
      $paperUserId = $result['userid'];
      $paperSubmitedby = $result['lastname'].' '.$result['firstname'];
      $paperDate = new DateTime($result['datesubmitted']);
      $paperDate = $paperDate->format('l jS F, Y');
   }
   if (isset($_POST['submitForm']))
   {
       // Assign the data from the POST request to new variables 
        $userid = $_POST['user'];
        $duration = $_POST['duration'];

        // Notify user if the neccessary informations weren't provided 
        if ($paperid=='' || $userid=='' || $duration=='' )
        {
           $status='warning';
           $msg = "All fields are required to be filled before continuing.";
        }
        // Else capture an instance of the AssignReviewer
        else
        {
            // Assign a new reviewer to a Paper 
            $dataArray = array("paperid"=>$paperid,"userid"=>$userid,"duration"=>$duration);
            $paper = new Paper();            
            $result = $paper->AssignReviewer($dataArray);
            $status = $result["status"];
            $msg = $result["msg"];
        }
   }

?>
<body style="background:black">  
        <br/><br/><br/>
  
        <div class="container">
            <div class="col-xs-12 text-right" style="color:#c3c3c3">
                  <?php
                           $userRole = '';
                           // If user  is an admin
                           if ($_SESSION['myRole']=='admin')
                           {
                              $userRole = 'Administrator';
                           }
                           // If user  is a teamleader 
                           else if ($_SESSION['myRole']=='teamleader')
                           {
                              $userRole = 'Team Leader';

                           }
                           // If user is a member or has no role 
                           else if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
                           {
                              $userRole = 'Member';
                           }

                           // Welcome the user alongside the role of the user 
                           echo "<strong>Welcome ".$_SESSION['myFirstname']."</strong><br>";
                           echo $userRole;
                    ?>
                </div>

            <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:green;">Paper Detailed Information  <small>(Paper Title: <?php echo $paperTitle; ?>)</small></h3>
                </div>

                
            </div>
                  <!-- Info Requested-->
                  <br>
            <?php
            // Include the Alert function
                  require_once("functions/Alert.php");
            ?>

         <div class="row">
                  <div class="col-xs-12">
                    <h4 class="text-left price-headline" style="color:green;font-weight:bold;">Paper Details</h4>
                </div>

              </div>
              <br/>
              <div class="row" style="color:green">
                  <div class="col-xs-12">
                      <strong>Project Group</strong>
                        <?php 
                            echo "<br/><i class='fa fa-folder-o'></i> <a href='ManageP.php'>".$paperProject."</a><br/></br>";                           
                        ?>
                  </div>

                  <div class="col-xs-12">
                      <strong>Paper Title</strong>
                        <?php 
                            echo "<br/><i class='fa fa-file-o'></i> <a href='Submited.php'>".$paperTitle."</a><br/><br/>";                            
                        ?>
                  </div>
                  <div class="col-xs-12">
                        <strong>Description</strong>
                        <?php  
                            echo "<br/><i class='fa fa-comment-o'></i> ".$paperDesc."<br/><br/>";
                        ?>
                  </div>
                  <div class="col-xs-12">
                      <Strong>File</Strong>
                      <?php
                            echo "<br/><i class='fa fa-file-o'></i> <a target='_blank' href='uploads/".$paperFile."'>".$paperFile."</a><br/><br/>";              
                      ?>
                  </div>

                  <div class="col-xs-12">
                      <Strong>Submitted By</Strong>
                      <?php
                          $code1= "oDdpnVaWwgdsjhMFiyIeLjJjSUCThpJUxfUVwTGnNSGeMLToTq";
                          $code2 = "FoltjKlLKnBdPvQfPQi!oLU!lStPXzTyZomFgktMQluhRbCDHe";
                            echo "<br/><i class='fa fa-user-o'></i> <a target='_blank' href='Miembro.php?mp=".$code1.'-'.$paperUserId.'-'.$code2."'>".$paperSubmitedby."</a><br/><br/>";              
                      ?>
                  </div>

                  <div class="col-xs-12">
                      <Strong>Date Submitted</Strong>
                      <?php
                            echo "<br/><i class='fa fa-calendar-o'></i> ".$paperDate."</a>";              
                      ?>
                  </div>


              </div>
             
              <hr>

              <div class="row">
                  <div class="col-xs-12">
                    <h4 class="text-left price-headline" style="color:green;font-weight:bold;">Assigned Reviewers</h4>
                </div>
                  <ol>
                <?php

                    // Get all reviewers of a specific paper 
                    $selReviewers = $paper->getReviewersToPaper($paperid);
                    
                    // Iterate through the reviewers and record the date 
                    foreach($selReviewers as $row)
                    {
                        $removeAssign = '';
                        if ($_SESSION['myRole']=='teamleader')
                        {
                           $removeAssign = "<a href='#'>Remove</a>";
                        }
                        $dateassigned = new DateTime($row['dateassigned']);
                        $dateassigned = $dateassigned->format('l jS F, Y');
                        echo "<li><a target='_blank' href='Miembro.php?mp=".$code1.'-'.$row['userid'].'-'.$code2."'>".$row['lastname'].' '.$row['firstname']."</a>  - <small>assigned on ".$dateassigned." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$removeAssign."</small></li>";


                    }

                ?>
                  </ol>
              </div>
              <br/>
    </div><!-- end of container //--> 
   
</body>
<?php
   require_once("footer.php");
?>
