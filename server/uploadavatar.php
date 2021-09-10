<?php
session_start();
require_once("../classes/Member.php");
require_once("../classes/DATABASE.php");
require_once("../classes/ExecuteQuery.php");

header("Content-Type:text/html");

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
{


    $member = new Member();
    $avatar = $member->uploadAvatar();
    $status = $avatar["status"];

    $name = $avatar["name"];
    $location = $avatar["location"];    
    echo $location;

    
    if ($status)
    {
    	 $member->updateAvatar($name,$location);    	 
    }


}	
else
{
	header("location:../Entrar.php");
}






?>