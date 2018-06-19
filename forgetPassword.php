<?php
session_start();
?>
<html>
<head><title>Surya Portal</title></head>
<body>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<h1>Surya Portal</h1>
<div class='fullform'>
<h3>Forget Password</h3>
<form>
<?php
if(isset( $_SESSION['id']) && $_SESSION['isAdmin'])
{
	include 'db_connect.php';
	if(isset($_POST['unORemail']) && isset($_POST['newpassword']))
	{
			$query = "UPDATE registration SET password ='". md5($_POST['newpassword'])."' WHERE (username='".mysqli_real_escape_string($conn,$_POST['unORemail'])."' or emailid='".mysqli_real_escape_string($conn,$_POST['unORemail'])."') ";
			if(mysqli_query($conn,$query) && mysqli_affected_rows($conn)>0)
			{
				echo "Password Changed!<br>";
				
			}
			else
			{
				echo "No User Found!<br>";
			}
	}

}
else
{
	echo "Error! Only Admin Can change Password<br>Try Again, <a href='login.html'>Click Here</a> to login as Admin<br>";
	exit();
}
?>
</form>
<form class='form' method="post" action="#">
	<br>
	<input type='text' maxlength="50" placeholder="Username/EmailID" name='unORemail'><br>
	<input type='password' maxlength="20" placeholder="New Password" name='newpassword'><br>
	<br>
	<input type='submit' value='Change Password'> 
	<br><br>

</form>
<br>
</div>
</body>
</html>