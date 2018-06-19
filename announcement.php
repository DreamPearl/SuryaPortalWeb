<?php
session_start();
if(isset( $_SESSION['id']))
{
	include 'db_connect.php';
	if(isset($_POST['text']) && isset($_POST['startDate']) && isset($_POST['dueDate']) && $_SESSION['isAdmin'])
	{
			$query = "INSERT INTO announcement(startDate,dueDate,Subject) VALUES("
				."'".mysqli_real_escape_string($conn,$_POST['startDate'])."',"
				."'".mysqli_real_escape_string($conn,$_POST['dueDate'])."',"
				."'".mysqli_real_escape_string($conn,$_POST['text'])."');";

			if(!mysqli_query($conn,$query))
			{
				echo "Error : ".mysqli_error($conn);
				exit();
			}
	}
	if(isset($_POST['delete']) &&  $_SESSION['isAdmin'])
	{
			$query = "DELETE FROM announcement where id = ".mysqli_real_escape_string($conn,$_POST['delete']).";";
			if(!mysqli_query($conn,$query))
			{
				echo "error";
				exit();
			}
	}


	$query = "SELECT id,Subject,startDate,dueDate FROM announcement order by id desc;";
	if(($result = mysqli_query($conn,$query)))
	{
		$chats = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$r = array();
			$r[] = $row['id'];
			$r[] = $row['Subject'];
			$r[] = $row['startDate'];
			$r[] = $row['dueDate'];

			$chats[] = $r;
		}
		echo json_encode($chats);
		exit();
	}
}
echo "error";
?>