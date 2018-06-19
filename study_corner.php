<?php
session_start();
if(isset( $_SESSION['id']))
{
	include 'db_connect.php';
	if(isset($_POST['data']) && isset($_POST['filename']) && $_SESSION['isAdmin'])
	{
			$query = "INSERT INTO studycorner(filename,studyinfo) VALUES("
				."'".mysqli_real_escape_string($conn,$_POST['filename'])."',"
				."'".mysqli_real_escape_string($conn,$_POST['data'])."');";

			if(!mysqli_query($conn,$query))
			{
				echo "Error : ".mysqli_error($conn);
				exit();
			}
	}

	if(isset($_POST['delete']) &&  $_SESSION['isAdmin'])
	{
			$query = "DELETE FROM studycorner where id = ".mysqli_real_escape_string($conn,$_POST['delete']).";";
			if(!mysqli_query($conn,$query))
			{
				echo "error";
				exit();
			}
	}


	$query = "SELECT id,filename,date FROM studycorner order by id desc;";
	if(($result = mysqli_query($conn,$query)))
	{
		$chats = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$r = array();
			$r[] = $row['id'];
			$r[] = $row['filename'];
			$r[] = $row['date'];
			$chats[] = $r;
		}
		echo json_encode($chats);
		exit();
	}
}
echo "error";
?>