<?php
//start a connection with the database with hostname, username, password, and database name
$connection = mysqli_connect("127.0.0.1", "root",
	"yngFYiViFq*y@SZ", "test_db"); 
//test connection. if it fails, show an error message
if(mysqli_connect_errno()) {
	die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}
?>