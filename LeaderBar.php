<?php
// include the following file from location
    require_once("includes/avatar.php");

?>
<nav class="navbar navbar-default navbar-fixed-top" style="background-color:black;color:white;">
    <!--navigation header-->
    <div class="navbar-header">
      <a href="BrowseFile.php"><img src="images/logo2.png" id="Cube" sytle="marging-right:100px," width=50%></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-menu" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

      </div>

      <div id="nav-menu" class="collapse navbar-collapse navbar-right" >
          <!--Browser-->
          <ul class="nav navbar-nav">
            <li><a style='color:#3ea6ff;' href="BrowseFile.php"><span class="fa fa-search" ></span><strong> Browse Papers</strong></a></li>
            <li><a style='color:#3ea6ff;' href="Review.php"><span class="fa fa-search" ></span><strong> Review</strong></a></li>
            <li><a style='color:#3ea6ff;' href="Files.php"><span class="fa fa-search" ></span><strong> Archives</strong></a></li>
            <li><a style="color:#3ea6ff;" href="ManageP.php" ><span class="fa fa-book"></span><strong> Views Projects</strong></a></li> 
            <li><a style="color:#3ea6ff;" href="ManageU.php"> <span class="fa fa-user-o"></span><strong> View Users</strong></a></li>
            <li><a style="color:#3ea6ff;" href="Sumit.php"><span class="fa fa-laptop"></span><strong> Share Resources</strong></a></li>
            <li><a style="color:#3ea6ff;" href="Submited.php"><span class="fa fa-laptop"></span><strong> Resources</strong></a></li>
            <li><a style="color:#3ea6ff;" href="ReviewFile.php"><span class="fa fa-laptop"></span><strong> In Review</strong></a></li>

            <!--user log out-->
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" href="help.php">
                <img src="<?php echo $myPhoto; ?>" class="img-circle" width="30px" height="30px" hspace="2px" align="left" > <b class="caret"></b>
              </a>
                <ul class="dropdown-menu">
                 <li><a style="padding-top:8px;padding-bottom:8px;color:#800080;" href="User.php">Account</a></li>
                  <li><a style="padding-top:8px;padding-bottom:8px;color:#800080;" href="logout.php">Log out</a></li>
                </ul>
            </li>

          </ul>
      </div>
  </nav>
