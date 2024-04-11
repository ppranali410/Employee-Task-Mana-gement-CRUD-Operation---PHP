
<?php 
include_once("Main_conn_check.php");

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script type="text/javascript">
    	
    	function delete_cat(project_id){
    		//alert("Cat id = "+cat_id);
    		// ask confirmation to delete a category
    		ans = confirm("Are you sure, you want to delete this Record?");
    		if(ans){
    			location.href="<?php echo SITEURL;?>delete_file.php?project_id="+project_id;
    		}
    	}
    </script>
  </head>
  <body>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- <div class="p-3 mb-2 bg-info-subtle text-info-emphasis"> -->
    
    <div class="container mt-5" >
    	<div class="row">
    		
    		<div><a href="Insert_records.php" class="btn btn-outline-primary mb-2 ">Add employee</a></div>
    		<div class=" text-center mb-3 bg-secondary text-white">TASK MANAGEMENT</div>
    	</div>

<?php 
$sql_cat_sel = "SELECT e.*,  t.task,t.status  FROM employee e LEFT JOIN task t ON e.project_id = t.project_id ";

	$res_cat_sel = mysqli_query($conn, $sql_cat_sel);
	$total_records  = mysqli_num_rows($res_cat_sel);
	if($res_cat_sel){
			if(mysqli_num_rows($res_cat_sel)>0){
				$srno =1;
				?>

				<table class="table table-bordered  table-striped table-success ">
					<thead class="table-dark ">
					<tr >
						<th>Sr.No</th>
						<th>Employee ID</th>
						<th>Project ID</th>
						<th>Employee Name</th>
						<th>Address</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Task</th>
						<th>Status</th>
						<th>Action</th>
							
					</tr>
				</thead>
				<?php
					
					while( $data = mysqli_fetch_array($res_cat_sel) ){	
						
						?>
					<tr>
						<td><?php echo $srno++ ;?></td>
						<td><?php echo $data['emp_id'];?></td>
						<td><?php echo $data['project_id'];?></td>
						<td><?php echo $data['name'];?></td>
						<td><?php echo $data['address'];?></td>
						<td><?php echo $data['email'];?></td>  
						<td><?php echo $data['phone'];?></td>
						<td><?php echo $data['task'];?></td>
						<td class="text-secondary fw-bold mx-2 my-2"><?php echo $data['status'];?></td>
						<td><a href="<?php echo SITEURL;?>edit_task.php?emp_id=<?php echo $data['emp_id'];?>">
							<button type="button" class="btn btn-outline-success">Edit</button></a>
							<a href="#" onclick="delete_cat(<?php echo $data['project_id'];?>)">
					  	<button type="button" class="btn btn-outline-danger">Delete</button></a>
					  </td>
					</tr>
						<?php
						
					}
					?>
				</table>
					<?php
			}
			else{
				echo "No record found";	
			}
	}
	else{
		echo "SQL not executed...";
	}


?>
</div> 
</div> 
</body>
</html>


