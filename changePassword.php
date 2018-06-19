<?php
session_start();
if(isset( $_SESSION['id']))
{
	include 'db_connect.php';
	if(isset($_POST['oldpassword']) && isset($_POST['newpassword']))
	{
			$query = "UPDATE registration SET password ='". md5($_POST['newpassword'])."' where userid=".$_SESSION['id']." and password='".md5($_POST['oldpassword'])."';";
			if(mysqli_query($conn,$query) && mysqli_affected_rows($conn)>0)
			{
				echo "done";
				exit();
			}
			else
			{
				echo "invalid";
				exit();
			}
	}
}
echo "error";
?>