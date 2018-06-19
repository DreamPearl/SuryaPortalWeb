<?php
session_start();

if(isset( $_POST['userid']) && $_SESSION['isAdmin'])
{
	include 'db_connect.php';
		$query = "SELECT userid,username,emailid,mobile,location,course,qualification FROM registration WHERE userid=".mysqli_real_escape_string($conn,$_POST['userid']).";";

		if($result =mysqli_query($conn,$query))
		{
			$row=mysqli_fetch_assoc($result);
				$r = array();
				$r[] = $row['userid'];
				$r[] = $row['username'];
				$r[] = $row['emailid'];
				$r[] = $row['mobile'];
				$r[] = $row['location'];
				$r[] = $row['course'];
				$r[] = $row['qualification'];


			echo json_encode($r);
			exit();
		}
}
echo "error";
?>