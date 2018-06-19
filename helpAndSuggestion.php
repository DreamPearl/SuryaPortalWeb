<?php
session_start();
if(isset( $_SESSION['id']) && (!$_SESSION['isAdmin'] || ($_SESSION['isAdmin'] && isset($_POST['to']) //&& is_integer($_POST['to'])
	)))
{
	include 'db_connect.php';
	$_POST['to'] = mysqli_real_escape_string($conn,$_POST['to']);	//Alternate to is_integer

	if(isset($_POST['text']))
	{
			$query = "INSERT INTO help(fromid,toid,text) VALUES("
				."'".($_SESSION['isAdmin']?"-1":$_SESSION['id'])."',";
			if($_SESSION['isAdmin'])
				$query = $query."'".$_POST['to']."',";
			else
				$query = $query."'-1',";//To Admin

			$query=$query	."'".mysqli_real_escape_string($conn,$_POST['text'])."');";
			if(!mysqli_query($conn,$query))
			{
				echo "error";
				exit();
			}
	}


	$query = "SELECT fromid,toid,text,time FROM help WHERE ";
	if($_SESSION['isAdmin'])
		$query = $query . "(fromid=-1 and toid=" . $_POST['to'].") or (fromid = " . $_POST['to'] ." and toid=-1);";
	else
		$query = $query . "(fromid=-1 and toid=" . $_SESSION['id'].") or (fromid = " . $_SESSION['id'] ." and toid=-1);";

	//userid=".$_SESSION['id'].";";
	if(($result = mysqli_query($conn,$query)))
	{
		$chats = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$r = array();
			$r[] = $row['text'];
			$r[] = $row['time'];
			$r[] = $row['fromid'];
			//$r[] = $row['toid'];
			$chats[] = $r;
		}
		echo json_encode($chats);
		exit();
	}
}
echo "error";
?>