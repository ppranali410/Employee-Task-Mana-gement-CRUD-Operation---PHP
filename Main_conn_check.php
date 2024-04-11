<?php

define("HOST","localhost");
define("DBUSERNAME","root");
define("DBPASSWORD","");
define("DBNAME","project_details");

define("SITEURL","http://localhost/Web_php_code_2nd_Batch/DBConnection/CRUDOperation/");

$conn = mysqli_connect(HOST, DBUSERNAME, DBPASSWORD, DBNAME);

if (!$conn) {

    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
else
{
	//echo "Database Connected ...";
	
}
?>