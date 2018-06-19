<?php
session_start();
if(isset( $_SESSION['id']) && isset( $_POST['userid']))
{

	include 'db_connect.php';
	$query = "SELECT username,resumeFilename,resume from registration WHERE userid='". mysqli_real_escape_string($conn,$_POST['userid'])."';";

	if($result = mysqli_query($conn,$query))
	{
		if($row = mysqli_fetch_assoc($result))
		{
			if(!is_null($row['resumeFilename']) && $row['resumeFilename']!='');
			{
				$ar = array();
				$ar[] = $row['resume'];
				$ar[] = $row['resumeFilename'];
				$ar[] = $row['username'];
				echo json_encode($ar);
				exit;
			}
		}
	}
}
echo 'error';
?>