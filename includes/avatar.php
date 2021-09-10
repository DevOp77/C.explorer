<?php

    $myPhoto = "";
    if ($_SESSION["myPhoto"]!="")
    {
    	$myPhoto = $_SESSION["myPhoto"];
    }
    else
    {
    	$myPhoto = "avatar200.png";
    }

    $myPhoto = "avatars/".$myPhoto;

?>