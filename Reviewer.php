<?php

if (!isset($_GET['pid']) || $_GET['pid']=='')
{
    // Redirecting to Submitted 
  header("location: Submited.php");
}

// Notify if any error 
error_reporting(E_ALL);
ini_set('display_errors', 1);
    // Include files for this page 
   require_once("includes/login_module.php");
   $pageTitle = "Assign User to Project";  
   require_once("classes/Config.php");
   require_once("header.php");    
   
   
   // Initiliaze needed variables 

   $status='';

   $paperid = $_GET['pid'];
   $pageLink = "AssignRev.php?pid=".$paperid;


   // Get a paper by its Id 

   $paper = new Paper();
   $paperInfo  = $paper->getPaperById($paperid);

   
   foreach($paperInfo as $result)
   {
       // Assign needed variables from each of the Papers obtained 
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
       // Assign the POST data to variables for further actions 
        $userid = $_POST['user'];
        $duration = $_POST['duration'];


        // Notify user if some fields have been ignored 
        if ($paperid=='' || $userid=='' || $duration=='' )
        {
           $status='warning';
           $msg = "All fields are required to be filled before continuing.";
        }else
        {
            // Assign a Reviewer to the Paper  
            $dataArray = array("paperid"=>$paperid,"userid"=>$userid,"duration"=>$duration);

            $paper = new Paper();            
            $result = $paper->AssignReviewer($dataArray);
            $status = $result["status"];
            $msg = $result["msg"];
        }
   }

    

?>  
        <br/>
  
        <div class="container">
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
                              $userRole = 'Team Leader';

                           }
                           // If the user is a member or has no role at all 
                           else if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
                           {
                              $userRole = 'Member';
                           }

                           echo "<strong>Welcome ".$_SESSION['myLastname'].' '.$_SESSION['myFirstname']."</strong>,<br>";
                           echo $userRole;
                    ?>
                </div>

            <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:purple;">Assign Reviewer  <small>(Paper Title: <?php echo $paperTitle; ?>)</small></h3>
                </div>

                
            </div>
                  
                  <!-- row 1 //-->
                  <hr>
             
            <?php
                // Including the Alert function 
                  require_once("functions/Alert.php");

            ?>
           

             <form name="uploadpaper" action="<?php echo $pageLink; ?>" method="post" enctype="multipart/form-data">     
              
              <div class="form-group row">
                  
                  <label for="Project Name"  class="col-xs-12 col-sm-2 col-form-label text-right">Select Reviewer</label>
                  
                  <div class="form-group col-xs-12 col-sm-5">
                      <select class="form-control" name="user">
                            <option></option>

                            <?php
                                // Getting all the Users and Display each of them 
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

              <div class="form-group row">
            
                   <label for="Project Name" class="col-xs-12 col-sm-2 col-form-label text-right">Duration (in days)</label>
                      
                    <div class="col-xs-12 col-sm-4">
                        
                            <input class="form-control" type="text" name="duration" value="15"/>                      
                    </div> 

              </div>
             
                            
              <div class="row" style="margin-top:10px;">
                  
                  <div class="col-xs-2 col-sm-2">&nbsp;</div>
                  <div class="col-xs-10 col-sm-10">
                      <input  class="btn btn-primary" type="submit" name="submitForm" value="Assign Reviewer"/>
                  </div>
              </div>

              </form>

              <br/>
               <hr>
              
              
              
              <div class="row">
                  <div class="col-xs-12">
                    <h4 class="text-left price-headline" style="color:purple;font-weight:bold;">Assigned Reviewers</h4>
                </div>
                  <ol>
                <?php
                    // Get all the Reviewers of a Particular paper
                    $selReviewers = $paper->getReviewersToPaper($paperid);
                    
                    // Loop through all of them and record the dates 
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
              <hr>


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
                            echo "<br/><i class='fa fa-user-o'></i> <a target='_blank' href='Miembro.php?mp=".$paperUserId."'>".$paperSubmitedby."</a><br/><br/>";              
                      ?>
                  </div>

                  <div class="col-xs-12">
                      <Strong>Date Submitted</Strong>
                      <?php
                            echo "<br/><i class='fa fa-calendar-o'></i> ".$paperDate."</a>";              
                      ?>
                  </div>


              </div>
             



              
                          
    </div><!-- end of container //--> 

     
  

    

<?php
   require_once("footer.php");

?>
