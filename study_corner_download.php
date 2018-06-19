<?php
session_start();
if(isset( $_SESSION['id']))
{
	include 'db_connect.php';
	
	if(isset($_POST['id']))
	{
		$query = "SELECT studyinfo FROM studycorner Where id=".$_POST['id'].";";
		if(($result = mysqli_query($conn,$query)))
		{
			$chats = array();
			if($row = mysqli_fetch_assoc($result))
			{
				echo $row['studyinfo'];
				exit();
			}
			exit();
		}
	}
}
echo "error";
?>