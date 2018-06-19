<?php
session_start();
if(isset( $_SESSION['id']))
{
	include 'db_connect.php';
	


	if(isset($_POST['jobtitle']) && isset($_POST['qualification']) && isset($_POST['skillsrequired']) && isset($_POST['salary']) && $_SESSION['isAdmin'])
	{
			$query = "INSERT INTO searchjob(jobtitle,qualification,skillsrequired,salary) VALUES("
				."'".mysqli_real_escape_string($conn,$_POST['jobtitle'])."',"
				."'".mysqli_real_escape_string($conn,$_POST['qualification'])."',"
				."'".mysqli_real_escape_string($conn,$_POST['skillsrequired'])."',"
				."'".mysqli_real_escape_string($conn,$_POST['salary'])."');";

			if(!mysqli_query($conn,$query))
			{
				echo "Error : ".mysqli_error($conn);
				exit();
			}
	}
	if(isset($_POST['delete']) &&  $_SESSION['isAdmin'])
	{
			$query = "DELETE FROM searchjob where id = ".mysqli_real_escape_string($conn,$_POST['delete']).";";
			if(!mysqli_query($conn,$query))
			{
				echo "error";
				exit();
			}
	}
	if($_SESSION['isAdmin'])
	{

		$query = "SELECT id,jobtitle,qualification,skillsrequired,salary,(select count(*) from vacencyrequest where sj.id=vacencyrequest.jobid and vacencyrequest.status=1) as cnt FROM searchjob as sj order by id desc;";
		if(($result = mysqli_query($conn,$query)))
		{
			$chats = array();
			while($row = mysqli_fetch_assoc($result))
			{
				$r = array();
				$r[] = $row['id'];
				$r[] = $row['jobtitle'];
				$r[] = $row['qualification'];
				$r[] = $row['skillsrequired'];
				$r[] = $row['salary'];
				$r[] = $row['cnt'];



				$chats[] = $r;
			}
			echo json_encode($chats);
			exit();
		}
	}
	else
		{

		$query = "SELECT id,jobtitle,qualification,skillsrequired,salary,(select status from vacencyrequest  where sj.id=vacencyrequest.jobid and vacencyrequest.userid=".$_SESSION['id'].") as status FROM searchjob as sj ";
		if(isset($_POST['json']))
		{
			$json = json_decode($_POST['json']);
			$skills =  $json[0];
			$courses = $json[1];
			$where = " where (";
			foreach ($skills as $key => $value) {
				$where = $where . " skillsrequired LIKE '%".mysqli_real_escape_string($conn,$value)."%' or ";
			}
			if(count($skills)==0)
				$where = $where . " true ) and ("; //No Comparision
			else	
				$where = $where . " false ) and (";
		
		foreach ($courses as $key => $value) {
				$where = $where . " qualification LIKE '%".mysqli_real_escape_string($conn,$value)."%' or ";
			}
			if(count($courses)==0)
				$where = $where . " true ) "; //No Comparision
			else	
				$where = $where . " false ) ";
			
				

			$query = $query . $where;//Where Clause Appended

		}
		$query = $query." order by id desc;";
		if(($result = mysqli_query($conn,$query)))
		{
			$chats = array();
			while($row = mysqli_fetch_assoc($result))
			{
				$r = array();
				$r[] = $row['id'];
				$r[] = $row['jobtitle'];
				$r[] = $row['qualification'];
				$r[] = $row['skillsrequired'];
				$r[] = $row['salary'];
				$r[] = (is_null($row['status'])?'0':$row['status']);


				$chats[] = $r;
			}
			echo json_encode($chats);
			exit();
		}
	}
}
echo "error";
?>