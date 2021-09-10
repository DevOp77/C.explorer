<?php
    require_once("includes/avatar.php");
?>
<nav class="navbar navbar-default navbar-fixed-top" style="background-color:black;color:white;">
      <div class="navbar-header">
        <a href="BrowseFile.php"><img src="images/logo2.png" id="Cube" sytle="marging-right:100px," width=50%></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-menu" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>



      <div id="nav-menu" class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a style='color:#3ea6ff;' href="BrowseFile.php"><span class="fa fa-search" ></span><strong> Browse Papers</strong></a></li>
            <li><a style='color:#3ea6ff;' href="Review.php"><span class="fa fa-search" ></span><strong> Review</strong></a></li>
            <li><a style="color:#3ea6ff;" href="FileMiembro.php"><span class="fa fa-file-o"></span><strong> Submit Paper</strong></a></li>
            <li><a style="color:#3ea6ff;" href="submissions.php"><span class="fa fa-file-o"></span><strong> My Submissions</strong></a></li>
            <li><a style="color:#3ea6ff;" href="AwaitingFeed.php"><span class="fa fa-file-o"></span><strong> Awaiting Review</strong></a></li>
            <li><a style="color:#3ea6ff;" href="ReviewedFile.php"><span class="fa fa-file-o"></span><strong> Papers Reviewed</strong></a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" href="help.php">
                  <img src="<?php echo $myPhoto; ?>" class="img-circle" width="30px" height="30px" hspace="2px" align="left" > <b class="caret"></b>
              </a>
                <ul class="dropdown-menu">

                  <!--<li><a style="padding-top:8px;padding-bottom:8px;color:#800080;" href="User.php">Profile</a></li>
                  <li><a style="padding-top:8px;padding-bottom:8px;color:#800080;" href="Password.php">Change Password</a></li>
                  <li role="separator" class="divider"></li>-->
                  <li><a style="padding-top:8px;padding-bottom:8px;color:#800080;" href="User.php">Account</a></li>
                  <li><a style="padding-top:8px;padding-bottom:8px;color:#800080;" href="logout.php">Log out</a></li>

                </ul>

            </li>


          </ul>
      </div>
    </nav>
