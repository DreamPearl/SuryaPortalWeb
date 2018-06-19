<?php
session_start();
$arr = array();
if(isset($_POST['unORemail']) && isset($_POST['password']))
{
	include 'db_connect.php';
	$query = "SELECT userid,isAdmin,username FROM login WHERE (username='".mysqli_real_escape_string($conn, $_POST['unORemail'])."' or emailid='".mysqli_real_escape_string($conn, $_POST['unORemail'])."') "
		." and password='".md5($_POST['password'])."' ;";
	if($result = mysqli_query($conn,$query))
	{
		if(mysqli_num_rows($result)>0)
		{
			$row = mysqli_fetch_assoc($result);
			$id = $row['userid'];
			$arr[] = 1;
			$arr[] = $id;
			$_SESSION['isAdmin'] = $row['isAdmin'];
			$arr[] = $row['isAdmin'];
			//if(isset($_SESSION['id'] )) $arr[1] = 1000; //Just to test Session.........
			$_SESSION['id'] = $id;
			$arr[] = $row['username'];
			
		}
	else 			$arr[] = 0;
	}
	else $arr[] = -1;
}
else $arr[] = -10;
echo json_encode($arr);
?>