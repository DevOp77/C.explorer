<?php
// include file from its location
// Including the Avatar.php file 
    require_once("includes/avatar.php");
    //Admin Navigation menu
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
            <li><a style='color:#3ea6ff;' href="Review.php"><span class="fa fa-search" ></span><strong> Review</strong></a></li><!--revisar estar linea-->
            <li><a style='color:#3ea6ff;' href="Files.php"><span class="fa fa-search" ></span><strong> Archives</strong></a></li><!--revisar estar linea-->
         
            <li><a style="color:#3ea6ff;" href="CreateP.php"><span class="fa fa-folder-o"></span><strong> Create Field </a></li></strong>
            <li><a style="color:#3ea6ff;" href="ManageP.php"><span class="fa fa-folder-o"></span><strong> Manage Field </a></li></strong>
            

            <li><a style="color:#3ea6ff;" href="CreateU.php"><span class="fa fa-user-o"></span><strong> Create User</a></li></strong>
            
            <li><a style="color:#3ea6ff;" href="User2Project.php"><span class="fa fa-user-o"></span><strong> Assign User</a></li></strong>






            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" href="help.php">
                  <img src="<?php echo $myPhoto; ?>" class="img-circle" width="30px" height="30px" hspace="2px" text-align="left" > <b class="caret"></b>
              </a>
                <ul class="dropdown-menu">
                 <li role="separator" class="divider"></li>
                  <li><a style="padding-top:8px;padding-bottom:8px;color:#800080;" href="User.php">Account</a></li>
                  <li><a style="padding-top:8px;padding-bottom:8px;color:#800080;" href="logout.php">Log out</a></li>
                  <li role="separator" class="divider"></li>

                </ul>

            </li>


          </ul>
      </div>
    </nav>
