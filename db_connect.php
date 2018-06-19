<?php

$servername = "mysql.hostinger.in";
$username = "u780203995_tnp";
$password = "bp2h8OwsjO";
$database = 'u780203995_tnp';

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
function db_close()
{
	mysqli_close($conn);
}

?>
