<?php
session_start();
if(isset( $_SESSION['id']))
{

	include 'db_connect.php';
	$query = "UPDATE registration SET resume = ";
	if(isset($_REQUEST['resume']) && isset($_REQUEST['resumeFilename']))
		$query = 	$query ."'".mysqli_real_escape_string($conn,$_REQUEST['resume'])."', resumeFilename='".mysqli_real_escape_string($conn,$_REQUEST['resumeFilename'])."' ";
	else $query = 	$query ."NULL, resumeFilename='' ";

	$query = 	$query ." WHERE userid=". $_SESSION['id'];

	if(mysqli_query($conn,$query) && mysqli_affected_rows($conn)>0)
	{
		echo "Updated";
		exit();
	}
	
}
echo "Not Updated";

?>