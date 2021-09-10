<?php
//condition when not getting any id or inputs from the submitted.php file
if (!isset($_GET['pid']) || $_GET['pid']=='')
{
  header("location: Submited.php");
}
// display all errors if any
error_reporting(E_ALL);
ini_set('display_errors', 1);
// include the following files from locations
   require_once("includes/login_module.php");
   $pageTitle = "Assign User to Project";  
   require_once("classes/Config.php");
   require_once("header.php");    
   
   // creating variables to accept input or access properties
   $status='';

   $paperid = $_GET['pid'];
   $pageLink = "AssignRev.php?pid=".$paperid;
   $paper = new Paper();
   $paperInfo  = $paper->getPaperById($paperid);

//    for each papers information the following must be made available or have inputs
//   Looping through $result and assigning each element in a row to a new  variable 
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


   
  //Submit button to assign  paper to user
   if (isset($_POST['submitForm']))
   {
       // Assign post data to variables ; 
        $userid = $_POST['user'];
        $duration = $_POST['duration'];

        // Check if user did not submit any of the required information and notify user 
        if ($paperid=='' || $userid=='' || $duration=='' )
        {
           $status='warning';
           $msg = "All fields are required to be filled before continuing.";
        }else
        {
            // Assign a new Reviewer 

            $dataArray = array("paperid"=>$paperid,"userid"=>$userid,"duration"=>$duration);
            // New instance of the Paper 
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
            <div class="col-xs-12 text-right"style="color:#c3c3c3">
                  <?php
                           $userRole = '';
                           // if user is an admin 
                           if ($_SESSION['myRole']=='admin')
                           {
                              $userRole = 'Administrator';
                           }
                           // If user is am teamleader 
                           else if ($_SESSION['myRole']=='teamleader')
                           {
                              $userRole = 'Team Leader';

                           }
                           // If user is a member or has no role 
                           else if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
                           {
                              $userRole = 'Member';
                           }
                           // Welcome the user along with the role 
                           echo "<strong>Welcome ".$_SESSION['myFirstname']."</strong><br>";
                           echo $userRole;
                    ?>
                </div>

            <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:green;"><strong>Paper Title: <?php echo $paperTitle; ?></strong></h3>
                </div>

                
            </div>
                  
                  <!-- row 1 //-->
                  <br>
             
            <?php
                  require_once("functions/Alert.php");

            ?>
           

             <form name="uploadpaper" action="<?php echo $pageLink; ?>" method="post" enctype="multipart/form-data">     
              
              <div class="form-group row" style="color:#c3c3c3">
                  
                  <label for="Project Name"  class="col-xs-12 col-sm-2 col-form-label text-right">Select Reviewer</label>
                  
                  <div class="form-group col-xs-12 col-sm-5">
                      <select class="form-control" name="user">
                            <option></option>

                            <?php
                            // Get all the users and add the to the select options 
                              $project = new User();
                              $result = $project->getAllUsers();
                              foreach ($result as $row)
                              {
                                $id = $row['id'];
                                $name =  $row['lastname'].' '.$row['firstname'];

                                

                            ?>
                            <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                             

                            <?php

                              }

                            ?>   
                      </select>
                  </div>
              </div>

              <div class="form-group row" style="color:#c3c3c3">
            
                   <label for="Project Name" class="col-xs-12 col-sm-2 col-form-label text-right">Duration (in days)</label>
                      
                    <div class="col-xs-12 col-sm-4">
                        
                            <input  class="form-control" type="text" name="duration" value="15"/>                      
                    </div> 

              </div>
             
                            
              <div class="row" style="margin-top:10px;" >
                  
                  <div class="col-xs-2 col-sm-2">&nbsp;</div>
                  <div class="col-xs-10 col-sm-10">
                      <input style="background:gray" class="btn btn-primary" type="submit" name="submitForm" value="Assign Reviewer"/>
                  </div>
              </div>

              </form>

              <br/>
               <br>
              
              
              
              <div class="row">
                  <div class="col-xs-12">
                    <h4 class="text-left price-headline" style="color:green;font-weight:bold;">Assigned Reviewers</h4>
                </div>
                  <ol>
                <?php
                    // Get all the Get all the Rewiewers  and display them 
                    $selReviewers = $paper->getReviewersToPaper($paperid);

                    foreach($selReviewers as $row)
                    {
                        $dateassigned = new DateTime($row['dateassigned']);
                        $dateassigned = $dateassigned->format('l jS F, Y');
                        echo "<li>".$row['lastname'].' '.$row['firstname']."  - <small>assigned on ".$dateassigned." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#'>Remove</a></small></li>";


                    }

                ?>
                  </ol>
              </div>
              <br/>
              <br>

            <!--
              <div class="row">
                  <div class="col-xs-12">
                    <h4 class="text-left price-headline" style="color:purple;font-weight:bold;">Paper Details</h4>
                </div>

              </div>
              <br/>
              <div class="row" >
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
                            echo "<br/><i class='fa fa-user-o'></i> <a target='_blank' ".$paperUserId."'>".$paperSubmitedby."</a><br/><br/>";              
                      ?>
                  </div>

                  <div class="col-xs-12">
                      <Strong>Date Submitted</Strong>
                      <?php
                            echo "<br/><i class='fa fa-calendar-o'></i> ".$paperDate."</a>";              
                      ?>
                  </div>


              </div>
             -->



              
                          
    </div><!-- end of container //--> 

     
  

    

<?php
    // Require the Footer.php file 
   require_once("footer.php");

?>
