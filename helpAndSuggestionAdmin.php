<?php
session_start();
if(isset( $_SESSION['id']) && $_SESSION['isAdmin'])
{
	include 'db_connect.php';
	
	$query = "select fromid, username ,time from help as ohelp,login where ohelp.fromid=login.userid and (select max(id) from help as inhelp where ohelp.fromid=inhelp.fromid group by fromid)=id";
	if(($result = mysqli_query($conn,$query)))
	{
		$chats = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$r = array();
			$r[] = $row['fromid'];
			$r[] = $row['username'];
			$r[] = $row['time'];
			$chats[] = $r;
		}
		echo json_encode($chats);
		exit();
	}
}
echo "error";
?>