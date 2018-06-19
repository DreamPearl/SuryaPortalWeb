<?php
session_start();
if(isset( $_SESSION['id']) && isset($_POST['jobid']) && $_SESSION['isAdmin'] )
{
	include 'db_connect.php';
		$query = "SELECT registration.userid as userid,jobtitle,username,course,emailid,mobile FROM vacencyrequest,registration WHERE registration.userid=vacencyrequest.userid and  status=1 and jobid=".mysqli_real_escape_string($conn,$_POST['jobid'])."; ";

		if($result =mysqli_query($conn,$query))
		{
			$data = array();
			while($row=mysqli_fetch_assoc($result))
			{
				$r= array();
				$r[] = $row['userid'];
				$r[] = $row['jobtitle'];
				$r[] = $row['username'];
				$r[] = $row['course'];
				$r[] = $row['emailid'];
				$r[] = $row['mobile'];

				$data[] = $r;


			}
			echo json_encode($data);
			exit();
		}
}
else if(isset( $_SESSION['id']) && $_SESSION['isAdmin'] )
{
	include 'db_connect.php';
		$query = "SELECT registration.userid as userid,jobtitle,username,course,emailid,mobile FROM vacencyrequest,registration WHERE registration.userid=vacencyrequest.userid and  status=2 order by lastchange desc limit 50 ";

		if($result =mysqli_query($conn,$query))
		{
			$data = array();
			while($row=mysqli_fetch_assoc($result))
			{
				$r= array();
				$r[] = $row['userid'];
				$r[] = $row['jobtitle'];
				$r[] = $row['username'];
				$r[] = $row['course'];
				$r[] = $row['emailid'];
				$r[] = $row['mobile'];

				$data[] = $r;


			}
			echo json_encode($data);
			exit();
		}
}
echo "error";
?>