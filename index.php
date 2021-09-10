<?php
// display all errors if any
  error_reporting(E_ALL);
ini_set('display_errors', 1);
// create a session period a page title and include the following file from location
session_start();
session_destroy();
$pageTitle = "Home";
require_once("classes/Config.php");

// create variables to accept input
$msg = "";
$status = "";

// login conditions
if (isset($_POST['submitForm']))
{
  // Assign the data from the POST request to variables 
    $username = SanitizeField::clean($_POST['username']);
    $password = SanitizeField::clean($_POST['epassword']);

    // If the user provided all neccessary and required data 
    if ($username!="" && $password!="")
    { 
        // Create an instance of the Member class
        $member = new Member();
        $dataArray = array("username"=>$username,"password"=>$password);
        $result =  $member->login($dataArray);

        // If Login Success, Save needed informations in Session storage 
        if ($result['status']=="success")
        {
          // Initialize the session storage and save the ff data 
            session_start();
            $_SESSION['memberLogin'] = 'mtabernacle2019';
            $_SESSION['myUserId'] = $result["id"];
            $_SESSION['myLastname'] = $result["lastname"];
            $_SESSION['myFirstname'] = $result["firstname"];
            $_SESSION["myLocation"] = $result["location"];
            $_SESSION["myAddress"] = $result["address"];
            $_SESSION["myEmail"] = $result["email"];
            $_SESSION["myCountry"] = $result["country"];
            $_SESSION["myPhoto"] = $result["photo"];
            $_SESSION['myAboutme'] = $result['aboutme'];
            $_SESSION['myRole'] = $result['role'];

            // Redirect to BrowsFile.php with the session storage active 
            header("location:BrowseFile.php");
        }
        else
        {
            // If login was not succesfull 
            $status = $result["status"];
            $msg = $result["message"];
        }


    }
}


// required or included files 
require_once("header.php");
require_once("GuestBar.php");







?>

<style media="screen">
  body{
    background:white;
    background-size: cover;
    background-repeat: no-repeat;
   
  }
</style>

    <br/><br/><br/><br/>
    <section id="signup">
      <div class="container">
        <!-- row 2 -->
        <div class="row">
          <div class="wrap-headline">
            <h1 class="text-center" style="color:#6782B7;">Sign In</h1>
            <h3 class="text-center">For registered members only</h3>
            <hr>



            <!-- sign in form -->
            <div class="col-sm-offset-2 col-sm-8">

              <?php

                 if (isset($_POST['submitForm']))
                 {
                      if ($status=="error")
                      {
                          echo "<div class='col-sm-offset-2 col-sm-8 text-center' style='margin-bottom:10px;color:red;'>".$msg."</div>";
                      }
                 }

              ?>


            <form id="signin" class="form-inline text-center"  action="index.php" method="post">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon"><span class="fa fa-user-o"></span></div>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Email or Username" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon"><span class="fa fa-lock"></div>
                  <input type="password" class="form-control" id="epassword" name="epassword" placeholder="Password" required>
                </div>
              </div>

              <input type="submit" name="submitForm" class="btn btn-primary" value="Submit">

              <div class="row" style="margin-top:10px;">
                  <div class="col-sm-6">
                      <input type="checkbox"> Remember me
                  </div>
                  <div class="col-sm-6">
                      <span class="psw" style="padding-left:10px;">Forgot <a href=mailto:c.explorer@gmail.com>password?</a></span>
                  </div>
              </div>
            </form>


            </div>
            <!-- end of form //-->


          </div>
        </div>
      </div>
    </section>

    <br/><br/><br/><br/>

   <?php
  //  include footer file
   require_once("footer.php");
   ?>
