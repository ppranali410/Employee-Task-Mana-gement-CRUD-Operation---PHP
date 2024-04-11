<?php 
include_once("Main_conn_check.php");

$msg='';
$empnameErr = $addressErr = $emailErr = $phoneErr = $taskErr = $statusErr = "";

if (isset($_POST['add_details']) && $_POST['add_details']) {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $task = $_POST["role"];

    // Validation
    if (empty($name)) {
        $empnameErr = "Employee name is required";
    }

    if (empty($address)) {
        $addressErr = "Address is required";
    }

    if (empty($email)) {
        $emailErr = "Email is required";
     } else {
        // Check for duplicate email
        $sql = "SELECT * FROM employee WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $emailErr = "Email already exists";
        }
    }

    if (empty($phone)) {
        $phoneErr = "Phone is required";
    }

    if (empty($task)) {
        $taskErr = "Task is required";
    }

    if (!isset($_POST["rdo_status"])) {
        $statusErr = "Status is required";
    }else{
    	$status=$_POST["rdo_status"];
    }

    // If no errors, insert into database
    if($name!='' && $address!='' && $email!='' && $phone!='' && $task!='' && $status!='' && (empty($emailErr))) {
       
        // Insert into task table
        $sql_task="INSERT INTO task (task,status) VALUES('".$task."','".$status."')";
      
       	if(mysqli_query($conn,$sql_task)){
        // Get the employee ID
        $project_id = mysqli_insert_id($conn);

         
         $sql_emp="INSERT INTO employee (name,address,email,phone,project_id) VALUES('".$name."','".$address."','".$email."', '".$phone."', '".$project_id."')";
        $res=mysqli_query($conn,$sql_emp);
         
        $msg= "Record inserted successfully";
        header("Location:Display_table.php");
        } 
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Project details</title>
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
				<div class="text-warning fs-3 mb-3">Add Project Details</div>
				<div class="mb-3">
					
				<form method="post">
					<div class="  mb-3">
						
						<input type="text" class="form-control" name="name" placeholder="Employee Name" id="name">
						<small class="text-danger"><?php echo $empnameErr ?? ''; ?></small>
					</div>
					
					<div class="mb-3">
						
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"  aria-describedby="emailHelp">
                        <small class="text-danger"><?php echo $emailErr ?? ''; ?></small>
                    </div>
                     
                    <div class="mb-3">
						<input type="text" class="form-control" name="address" id="name"  placeholder=" Address" >
						<small class="text-danger"><?php echo $addressErr ?? ''; ?></small>
					</div>
                   
					<div class="mb-3">
						<input type="text" class="form-control" name="phone" id="phone"  placeholder="Phone No." >
						 <small class="text-danger"><?php echo $phoneErr ?? ''; ?></small>
					</div>
					
                 <!---------task table--------->
                     
					<div class="mb-3">
						<textarea type="text" class="form-control" name="role" id="role"  placeholder="Task" ></textarea>
						<small class="text-danger"><?php echo $taskErr ?? ''; ?></small>
					</div>
					
					<div class="mb-3">
						<label class="form-label">Status </label>

						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="rdo_status" id="rdo_active_status" value="InProgress">
							<label class="form-check-label" for="inlineRadio1">InProgress</label>
						</div>
                        <div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="rdo_status" id="rdo_inactive_status" value="Completed">
							<label class="form-check-label" for="inlineRadio2">Completed</label>
						</div>
						 <div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="rdo_status" id="rdo_inactive_status" value="InCompleted">
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