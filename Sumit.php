<!--Requesting Credentials-->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
   require_once("includes/login_module.php");
   $pageTitle = "Assign User to Project";
   require_once("classes/Config.php");
   require_once("header.php");


   // Initialize needed variables 

   $status='';
   $title = '';
   $description = '';
   $projectid = '';




   if (isset($_POST['submitForm']))
   {
       // Assign the POST data to declared variables 
        $projectid = $_POST['project'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        // If user ignored any of the important fields 
        if ($projectid=='' || $title=='' || $description=='' || $_SESSION['fileUpload']=='')
        {

           $status='warning';
           $msg = "All fields are required to be filled before continuing.";
        }
        // Else Submit  the paper 
        else
        {
            $dataArray = array("projectid"=>$projectid,"title"=>$title,"description"=>$description,"file"=>$_SESSION['uploadedFile'],"submitedby"=>$_SESSION['myUserId']);
            // A new instance of the paper 
            $paper = new Paper();
            // Save the Paper Submitted by the user 
            $result = $paper->submitPaper($dataArray);
            $status = $result["status"];
            $msg = $result["msg"];
        }
   }


    if (isset($_POST['uploadFile']))
    {
            $projectid = $_POST['project'];
            $title = $_POST['title'];
            $description = $_POST['description'];

    }




?>
<!--User level-->
<body style="background:#fff;"> <br/><br/><br/>
        <div class="container">
            <div class="col-xs-12 text-right"style="color:#076ec1;font-size:20px;">
                  <?php
                           $userRole = '';
                           // user is an admin 
                           if ($_SESSION['myRole']=='admin')
                           {
                              $userRole = 'Administrator';
                           }
                           // if user is a teamleader 
                           else if ($_SESSION['myRole']=='teamleader')
                           {
                              $userRole = 'Supervisor';

                           }
                           // If user is a member or has no role 
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
                    <h3 class="text-left price-headline" style="color:#076ec1;"><strong>Share Resources </strong>  </h3>
                </div>


            </div><br>
                  <!-- Info Related-->
            <?php
                  require_once("functions/Alert.php");
            ?>


             <form name="uploadpaper" action="Sumit.php" method="post" enctype="multipart/form-data">
              <div class="form-group row">
                  <label for="Project Name" style="color:#212121"; class="col-xs-12 col-sm-2 col-form-label text-left">Project Field</label>
                  <div class="form-group col-xs-12 col-sm-5">
                      <select class="form-control" name="project">
                            <option></option>

                            <?php
                                // Initialize a new Project Instance 
                              $project = new Project();
                              // Get all the Projects 
                              $result = $project->getAllProject();

                              // Loop through the projects and save their values in a variable
                              // Also append them to the select input  
                              foreach ($result as $row)
                              {
                                $id = $row['id'];
                                $name =  $row['name'];

                                $selected = '';
                            
                                if ($projectid==$id)
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

                   <label for="Project Name" style="color:#212121";" class="col-xs-12 col-sm-2 col-form-label text-left">Title</label>

                    <div class="col-xs-12 col-sm-8">

                            <input class="form-control" type="text" name="title" value="<?php echo $title; ?>"/>
                    </div>

              </div>
              <div class="form-group row">

                  <label for="Project Short Name" style="color:#212121";" class="col-xs-12 col-sm-2 col-form-label text-left">Description</label>

                  <div class="col-xs-12 col-sm-8">
                      <textarea class="form-control" cols="80" rows="5" name="description"><?php echo $description; ?></textarea>
                  </div>
              </div>

              <div class="row">
                  <div class="col-xs-3"></div>
                  <div class="col-xs-9">
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

                  <label for="Project Short Name" style="color:#212121";" class="col-xs-12 col-sm-2 col-form-label text-right">File</label>

                  <div class="col-xs-7 col-sm-5">
                      <input type="file" name="fileToUpload" ><br>
                      <input type="submit" name="uploadFile" value="Upload File" class="btn btn-info btn-sm">
                  </div>

              </div>

              <div class="row" style="margin-top:10px;">

                  <div class="col-xs-2 col-sm-2">&nbsp;</div>
                  <div class="col-xs-10 col-sm-10">
                      <input  style="font-size:18px;" class="btn btn-primary" type="submit" name="submitForm" value="Submit Paper"/>
                  </div>
              </div>

              </form>

              <?php
                // Get all Submitted Papers so far 
                $paper = new Paper();
                $list = $paper->getAllSubmitedPapers();
                $totalPapers = $list->num_rows;
              ?>
    </div><!-- end of container //-->
</body>
<?php
    require_once("footer.php");
?>
