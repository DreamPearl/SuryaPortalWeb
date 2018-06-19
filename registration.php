<?php
if(isset($_POST['username']) && isset($_POST['password']) &&isset($_POST['emailid']) 
	&& isset($_POST['mobile']) && isset($_POST['location']) && isset($_POST['course']) && isset($_POST['qualification']) )

{
	include 'db_connect.php';
	$query = "INSERT INTO registration(username,password,emailid,mobile,location,resume,resumeFilename,course,qualification) VALUES("
		."'".mysqli_real_escape_string($conn,$_POST['username'])."',"
		."'".md5($_POST['password'])."',"
		."'".mysqli_real_escape_string($conn,$_POST['emailid'])."',"
		."'".mysqli_real_escape_string($conn,$_POST['mobile'])."',"
		."'".mysqli_real_escape_string($conn,$_POST['location'])."',";
	if(isset($_POST['resume'])  && isset($_POST['resumeFilename']))
		$query = 	$query ."'".mysqli_real_escape_string($conn,$_POST['resume'])."', '".mysqli_real_escape_string($conn,$_POST['resumeFilename'])."', ";
	else $query = 	$query ."'','',";


	$query = 	$query 	."'".mysqli_real_escape_string($conn,$_POST['course'])."',"
					. "'".mysqli_real_escape_string($conn,$_POST['qualification'])."')";

	if(mysqli_query($conn,$query))
	{
		echo "New User Registered!";
	}
	else echo "Not Registered! ,Error : ".mysqli_error($conn);

}
?>