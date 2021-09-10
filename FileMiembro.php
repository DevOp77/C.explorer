
<?php

// Return errors in any 
error_reporting(E_ALL);
ini_set('display_errors', 1);

    // Import all the neccessary file for this page 
   require_once("includes/login_module.php");
   $pageTitle = "Assign User to Project";
   require_once("classes/Config.php");
   require_once("header.php");


   // Initialize variables 
   $status='';

   $projectid = '';
   $description = '';
   $title = '';


   if (isset($_POST['submitForm']))
   {
       // Assign values from the POST request to variables for further actions 
        $projectid = $_POST['project'];
        $title = $_POST['title'];
        $description = $_POST['description'];


        // If any of the neccessary information have not been provided, notify the user 

        if ($projectid=='' || $title=='' || $description=='' || $_SESSION['fileUpload']==0)
        {
           $status='warning';
           $msg = "All fields are required to be filled before continuing.";
        }
        // If all the neccesary informations have been provided 
        else
        {
            // Save the Paper submitted by the user 
            $dataArray = array("projectid"=>$projectid,"title"=>$title,"description"=>$description,"file"=>$_SESSION['uploadedFile'],"submitedby"=>$_SESSION['myUserId']);
            $paper = new Paper();
            $result = $paper->submitPaper($dataArray);
            $status = $result["status"];
            $msg = $result["msg"];
        }
   }

   //
   if (isset($_POST['uploadFile']))
   {

        $projectid = $_POST['project'];
        $title = $_POST['title'];
        $description = $_POST['description'];
   }



?>
<body style="background:#fff;">
        <br/>
        <br/>
        <br/>

        <div class="container">
            <div class="col-xs-12 text-right" style="color:#076ec1;font-size:20px;">
                  <?php
                           $userRole = '';
                           // if user is an admin 
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
                    <h3 class="text-left price-headline" style="color:#076ec1;"><strong>Paper Submission </strong></h3>
                </div>


            </div>

                  <!-- Info Requested-->
                  <br>

            <?php
                  require_once("functions/Alert.php");
            ?>
             <form name="uploadpaper" action="FileMiembro.php" method="post" enctype="multipart/form-data">
              <div class="form-group row">
                  <label for="Project Name"  class="col-xs-12 col-sm-2 col-form-label text-left" style="color:#000;">Project</label>
                  <div class="form-group col-xs-12 col-sm-5">
                      <select class="form-control" name="project">
                            <option></option>

                            <?php
                            // Get all the projects and append them to an select input 
                              $project = new Project();
                              $result = $project->getAllProject();

                              // Iterating through the row, and assigning each single value to a variable 
                              foreach ($result as $row)
                              {
                                $id = $row['id'];
                                $name =  $row['name'];
                                $selected = '';
                                
                                // If the id is same as the projectid : 
                                if ($row['id']==$projectid)
                                {
                                  $selected = 'selected';
                                }

                            ?>
                            <option <?php echo $selected; ?> value="<?php echo $id; ?>"><?php echo $name; ?></option>


                            <?php
                              }
                            ?>
                      </select>
                  </div>
              </div>

              <div class="form-group row">

                   <label for="Project Name" class="col-xs-12 col-sm-2 col-form-label text-left" style="color:#000;">Title</label>

                    <div class="col-xs-12 col-sm-8">

                            <input class="form-control" type="text" name="title" value="<?php echo $title; ?>"/>
                    </div>

              </div>
              <div class="form-group row">

                  <label for="Project Short Name"  class="col-xs-12 col-sm-2 col-form-label text-left" style="color:#000;">Description</label>

                  <div class="col-xs-12 col-sm-8">
                      <textarea class="form-control" cols="80" rows="5" name="description"><?php echo  $description; ?></textarea>
                  </div>
              </div>

              <div class="row" >
                  <div class="col-xs-3"></div>
                  <div class="col-xs-9" >
                      <?php
                          if (isset($_POST['uploadFile']))
                          {
                            echo "<strong>";
                            require_once("Carga.php");
                            echo "</strong><br/><br/>";

                          }
                      ?>
                  </div>
              </div>

              <div class="form-group row">

                  <label for="Project Short Name"  class="col-xs-12 col-sm-2 col-form-label text-left"style="color:#000;">File</label>

                  <div class="col-xs-7 col-sm-5">
                      <input type="file" name="fileToUpload" > <br>
                      <input type="submit" name="uploadFile" value="Upload File" class="btn btn-info btn-sm">
                  </div>

              </div>

              <div class="row" style="margin-top:10px;">

                  <div class="col-xs-2 col-sm-2">&nbsp;</div>
                  <div class="col-xs-10 col-sm-10">
                      <input style="font-size:18px;" class="btn btn-primary" type="submit" name="submitForm" value="Submit Paper"/>
                  </div>
              </div>

              </form>

              <?php
                // Get all the Papers the user Submitted 
                $paper = new Paper();
                $list = $paper->SubmitedPapersByMember($_SESSION['myUserId']);
                $totalPapers = $list->num_rows;
              ?>



    </div><!-- end of container //-->





</body>
<?php
    // Include the footer.php file 
   require_once("footer.php");

?>
