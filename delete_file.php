<?php
include_once("Main_conn_check.php");

$project_id = $_GET['project_id'];

$sql_cet_del ="DELETE employee.*, task.* FROM employee inner JOIN task ON employee.project_id = task.project_id where employee.project_id='".$project_id."'";
//$sql_cet_del = "UPDATE category set is_delete=1 where  cat_id ='".$cat_id."' ";

$res_cet_del = mysqli_query($conn, $sql_cet_del);

if($res_cet_del){
	// echo "<script type='text/javascript'>alert('Record deleted successfully');</script>";
	// // to redirect on table page
	// header("Location: ".SITEURL."Display_table.php");
    echo "<script>alert('Record deleted successfully'); window.location.href = 'Display_table.php';</script>";
}

?>