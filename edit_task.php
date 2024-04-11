<?php 

include_once("Main_conn_check.php");
$emp_id = $_GET['emp_id'];

if (isset($emp_id) && $emp_id!='')  {

	 $sql="SELECT * from employee e inner join task t on e.project_id=t.project_id where emp_id='".$emp_id."' ";
	$result=mysqli_query($conn,$sql);

	$records=mysqli_num_rows($result);
	if ($result) {
		if (mysqli_num_rows($result)>0) {
			$row=mysqli_fetch_assoc($result);

			$emp_id = $row['emp_id'];
			$name = $row['name'];
			$address = $row['address'];
			$email =  $row['email'];
			$phone = $row['phone'];
			$project_id = $row['project_id'];
			$task = $row['task'];
			$status = $row['status'];

			
		}
	}

}


$msg ="";
$is_error ="0";


//if ($_POST) {

if (isset($_POST['add_details']) && $_POST['add_details']) {

    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $task = $_POST["role"];
    //$status = $_POST["rdo_status"];

    // Validation
    

    if (empty($name)) {
        $empnameErr = "Employee name is required";
        $flag=1;
    }

    if (empty($address)) {
        $addressErr = "Address is required";
        $flag=1;
    }

    if (empty($email)) {
        $emailErr = "Email is required";
         $flag=1;
    } 
    if (empty($phone)) {
        $phoneErr = "Phone is required";
         $flag=1;
    }

    if (empty($task)) {
        $taskErr = "Task is required";
        $flag=1;
    }

    if (!isset($_POST["rdo_status"])) {
        $statusErr = "Status is required";
        $flag=1;
        
    }else{
    	$status=$_POST["rdo_status"];
    }

    

    // If no errors, insert into database
    if($name!='' && $address!='' && $email!='' && $phone!='' && $task!='' && $status!='' ) {
       
      $sql = "SELECT * FROM employee e join task t on e.project_id=t.project_id where email = '".$email."' and emp_id !='".$emp_id."'" ;
			$result2 = mysqli_query($conn, $sql);
			if($result2){
				if(mysqli_num_rows($result2)>0){

					$msg = "Employee <b>$email</b> is already exist ";
					$is_error = 1;
				}
			}
			if($is_error == 0){
			
				 $sql_emp = "UPDATE employee SET name='".$name."', address='$address', email='$email', phone='$phone' WHERE emp_id='$emp_id'";
                 $sql_task = "UPDATE task SET task='$task', status='$status' WHERE project_id='$project_id'";
    
			
				//$res_cat_upd = mysqli_query($conn,$sql_cat_upd );
				if(mysqli_query($conn,$sql_emp )===TRUE && mysqli_query($conn,$sql_task )===TRUE){
					$msg = "Record updated successfully";
					header("Location: Display_table.php"); // redirection
				}
			} 
    }else{
    	$msg = "Please enter all the details";
    }
 }
//}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Project details</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<div class="container mt-5 ">

		<div class="row justify-content-md-center">
			<div class="col-lg-5">
				<div class="text-danger mb-3">
					<?php echo $msg ?>
				</div>
				<div class="text-warning fs-3 mb-3">Edit Project Details</div>
				<div class="mb-3">
					
				<form method="post">
					<div class="  mb-3">
						
						<input type="text" class="form-control" name="name" placeholder="Employee Name" id="name" value="<?php if(isset($name)){ echo $name;}?>">
						<small class="text-danger"><?php echo $empnameErr ?? ''; ?></small>
					</div>
					
					<div class="mb-3">
						
                        <input type="email" class="form-control" name="email" placeholder="Email"  id="email"   aria-describedby="emailHelp" value="<?php if(isset($email)){ echo $email;}?>">
                        <small class="text-danger"><?php echo $emailErr ?? ''; ?></small>
                    </div>
                     
                    <div class="mb-3">
						<input type="text" class="form-control" name="address" id="name"  placeholder=" Address" value="<?php if(isset($address)){ echo $address;}?>" >
						<small class="text-danger"><?php echo $addressErr ?? ''; ?></small>
					</div>
                   
					<div class="mb-3">
						<input type="text" class="form-control" name="phone" id="phone"  placeholder="Phone No." value="<?php if(isset($phone)){ echo $phone;}?>">
						 <small class="text-danger"><?php echo $phoneErr ?? ''; ?></small>
					</div>
					
                 <!---------task table--------->
                     
					<div class="mb-3">
						<textarea type="text" class="form-control" name="role" id="role"  placeholder="Task" ><?php if(isset($task)){ echo $task;}?></textarea>
						<small class="text-danger"><?php echo $taskErr ?? ''; ?></small>
					</div>
					
					<div class="mb-3">
						<label class="form-label">Status </label>

						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="rdo_status" id="rdo_active_status" value="InProgress" <?php if(isset($status) && $status=='InProgress'){ echo "checked"; }?>>
							<label class="form-check-label" for="inlineRadio1">InProgress</label>
						</div>
                        <div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="rdo_status" id="rdo_inactive_status" value="Completed" <?php if(isset($status) && $status=='Completed'){ echo "checked"; }?>>
							<label class="form-check-label" for="inlineRadio2">Completed</label>
						</div>
						 <div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="rdo_status" id="rdo_inactive_status" value="InCompleted" <?php if(isset($status) && $status=='InCompleted'){ echo "checked"; }?>>
							<label class="form-check-label" for="inlineRadio3">InCompleted</label>
						</div>
						<small class="text-danger"><?php echo $statusErr ?? ''; ?></small>
						

						<div class="mb-3">
						<input type="submit" name="add_details" class="btn btn-outline-primary" value="Add">
						<a href="Display_table.php" class="btn btn-outline-primary">Display Records</a></div>
					    </div>

					</div>


				</form>

			</div>
			
		</div>
	</div>

</body>
</html>