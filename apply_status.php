<?php
session_start();
if(isset( $_SESSION['id']))
{
	include 'db_connect.php';
	if($_SESSION['isAdmin'])
	{


		if(isset($_POST['jobid']) && isset($_POST['status']) && isset($_POST['userid']))
			{
							$query = "UPDATE apply SET status = ".mysqli_real_escape_string($conn,$_POST['status'])." where userid=".$_POST['userid']." and jobid = ".$_POST['jobid'].";";
							if(mysqli_query($conn,$query))
							{
								echo "Done";
								exit();
							}	
						
			}




	} else //NORMAL PERSON
	if(isset($_POST['jobid']) && isset($_POST['status']))
	{
			$query = "INSERT INTO apply(userid,jobid,status) VALUES("
				."'".mysqli_real_escape_string($conn,$_SESSION['id'])."',"
				."'".mysqli_real_escape_string($conn,$_POST['jobid'])."',"
				."'".mysqli_real_escape_string($conn,$_POST['status'])."');";

			if(!mysqli_query($conn,$query))
			{
				//Record Already Exists
				if($_POST['status']!=2 && $_POST['status']!=3)		//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
				{
					$query = "UPDATE apply SET status = ".mysqli_real_escape_string($conn,$_POST['status'])." where userid=".$_SESSION['id']." and jobid = ".$_POST['jobid'].";";
					if(mysqli_query($conn,$query))
					{
						echo "Done";
						exit();
					}	
				}
				
			}
			else
			{
				echo "Done";
				exit();
			}
	}
}
echo "error";
?>