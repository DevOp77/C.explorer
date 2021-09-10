<?php
// Notify the user in case of any error 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>C.explorer - <?php echo $pageTitle; ?></title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Muli|Nunito|PT+Sans|Source+Sans+Pro|Ubuntu|Pacifico" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-clockpicker.min.css">
    <link rel=icon" type="image/png" href="images/logo2.png"/>


    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            width: 100%;
            border-radius: 5px;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        img {
            border-radius: 5px 5px 0 0;
        }

        .container {
            padding: 2px 16px;
        }

        a.dropdown-toggle
        {

        }

        a.dropdown-toggle:hover
        {
          color:black;
        }


        .navbar-default .navbar-nav > li > a:hover
        {

          color:black;
        }

        .navbar-default .navbar-nav > li > a:hover
        {
          color: green;

        }

        .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus
        {


        }

</style>

  </head>
  <body>

  <?php
  if (isset($_SESSION['memberLogin']) && $_SESSION['memberLogin'] == 'mtabernacle2019' && $_SESSION['myRole']=='admin')
  {
     require_once("AdminBar.php");
  }
  else if (isset($_SESSION['memberLogin']) && $_SESSION['memberLogin'] == 'mtabernacle2019' && $_SESSION['myRole']=='teamleader')
  {
     require_once("LeaderBar.php");
  }else if (isset($_SESSION['memberLogin']) && $_SESSION['memberLogin'] == 'mtabernacle2019' && $_SESSION['myRole']=='')
  {
      require_once("StudentBar.php");
  }

  ?>
