<?php
// display all errors if any
error_reporting(E_ALL);
ini_set('display_errors', 1);
// include the following files from locations
   require_once("includes/login_module.php");
   $pageTitle = "Create Project";
   require_once("classes/Config.php");
   require_once("header.php");
   //require_once("AdminBar.php");


// creating variable status
   $status='';

//    checks if a declared variable, array or array key has null value and gives conditions.
   if (isset($_POST['submitForm']))
   {
    //an array of variables passed to the current script via the HTTP POST method
        $longname = $_POST['longname'];
        $shortname = $_POST['shortname'];
// conditions
        if ($longname=='' || $shortname=='')
        {
            // send alert when all fields arent filled
           $status='warning';
           $msg = "All fields are required to be filled before continuing.";
        }else
        {
            // if successfully filled, create new project
            $project = new Project();
            $result = $project->createproject($longname,$shortname);
            $status = $result["status"];
            $msg = $result["msg"];
        }
   }



?>






<body style=background:white;>
        <br/>
        <br/>
        <br/>

        <div class="container" >

            <div class="row" style="color:#076ec1;font-size:20px;">
                <div class="col-xs-12 text-right">
                  <?php
                //   Session identifiers is a unique number which is used to identify every user in a session based environment
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
                           // If the user a member or has no role 
                           else if ($_SESSION['myRole']=='member' || $_SESSION['myRole']=='')
                           {
                              $userRole = 'Member';
                           }
                            // Display the user role 
                           echo "<strong>Welcome ".$_SESSION['myFirstname']."</strong><br>";
                           echo $userRole;
                    ?>
                </div>

                <div class="col-xs-12">
                    <h3 class="text-left price-headline" style="color:#000;"><strong>Create Project Field</h3></strong>
                </div>


            </div>

                  <!-- row 1 //-->
                  <hr>

            <?php
            // include the following function file from location
                  require_once("functions/Alert.php");

            ?>


             <form name="create_project" action="CreateP.php" method="post">
              <div class="form-group row">

                   <label style="color:gray" for="Project Name" class="col-xs-12 col-sm-2 col-form-label text-left" ><strong>Project Field Name</label></strong>

                    <div class="col-xs-12 col-sm-5">

                            <input class="form-control" type="text" name="longname"/>
                    </div>

              </div>
              <div class="form-group row">

                  <label style="color:gray" for="Project Short Name"  class="col-xs-12 col-sm-2 col-form-label text-left">Field Short Name</label>

                  <div class="col-xs-12 col-sm-5">
                      <input class="form-control" type="text" name="shortname"/>
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-xs-12 col-sm-2"></div>
                  <div class="col-xs-12 col-sm-10">
                      <input style="font-size:20px;" class="btn btn-primary" type="submit" name="submitForm" value="Create"/>
                  </div>
              </div>
              </form>

    </div><!-- end of container //-->




 <br/><br/><br/><br/><br/><br/><br/><br/>
</body>
 <!-- include the footer from location -->
<?php
   require_once("footer.php");

?>
