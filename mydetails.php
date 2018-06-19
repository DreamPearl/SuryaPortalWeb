<?php
session_start();
if(isset($_SESSION['id']))
{
	include 'db_connect.php';
	$query = "SELECT userid,username,emailid,mobile FROM registration WHERE userid=".$_SESSION['id'].";";
	$r = array();
	if(($result = mysqli_query($conn,$query)) && mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		$r[] = $row['userid'];
		$r[] = $row['username'];
		$r[] = $row['emailid'];
		$r[] = $row['mobile'];
		echo json_encode($r);
	}
	else echo "Error!";
}
else echo "Not Logged In!";
?>