<?php
// include file from location
require_once("classes/Config.php");
// setting condition and refering to the managed projects
if (!isset($_GET['id']) || $_GET['id']=='')
{
	header("location:ManageP.php");
}

// Delete a project by it's id 
$projectid = $_GET['id'];
// id of project can allow an admin to delete the project field by the delete property
$project = new Project();
$project->deleteProject($projectid);
header("location:ManageP.php");

?>