<?php 
session_start();
if (!isset($_SESSION['username']))
{
header("location:index.php");
}
require_once("../config.php");

// Get the username of the logged-in user
$username = $_SESSION['username']; 

// Modify the SQL query to include a condition that checks if the doctor_id matches the username
$q=mysqli_query($con,"SELECT * FROM appointment WHERE doctor_id = '$username' " )or die('Error223');
?>

<!DOCTYPE html>
<html lang="en">
<title>Appointments</title>
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"> 
<link rel="stylesheet" type="text/css" href="../assets/css/app.min.css">
<link rel="stylesheet" type="text/css" href="../assets/css/argon.min.css"> 
<link rel="stylesheet" type="text/css" href="../assets/libs/footable/footable.core.min.css"> 
<link rel="icon" type="images/jpg" href="../images/logo.jpg">

<body>
	<?php include("home.php")?>

	<div id="wrapper">
		<div class="content-page">
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="page-title-box">
								<h4 class="page-title">Appointment Details</h4>
							</div>
						</div>
					</div>

					<div class="row"> 
						<div class="col-12">
							<div class="card-box">
								<div class="mb-2">
									<div class="row">
										<div class="col-12 text-sm-center form-inline" >
											<div class="form-group mr-2" style="display:none">
												<select id="demo-foo-filter-status" class="custom-select custom-select-sm">
													<option value="">Show all</option>
													<option value="Discharged">Discharged</option>
													<option value="OutPatients">OutPatients</option>
													<option value="InPatients">InPatients</option>
												</select>
											</div>
											
											<div class="form-group">
												<input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
											</div>
										</div>
									</div>
								</div>
								<div class="table-responsive">
									<table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
										<thead>
											<tr>
												<th>#</th>
												<th data-hide="phone">Appointment Number</th>
												<th data-hide="phone">Patient Number</th>
												<th data-toggle="true">Patient Name</th>
												<th data-hide="phone">Patient Phone</th>
												<th data-hide="phone">Service</th>
												<th data-hide="phone">Appointment date</th>
												<th data-hide="phone">Decision</th>
												<th data-hide="phone"> Change Action</th>
											</tr>
										</thead>
										<?php
										$cnt=1;
										while($row=mysqli_fetch_array($q)){
											$n=$row['appointment_id'];
											$patient_id=$row['patient_id'];
											$e=$row['Full_Name'];
											$phone=$row['phone_number'];
											$service=$row['service'];
											$dob=$row['date_of_appointment'];
											$decision=$row['status'];
			?>

											<tbody>
												<tr>
													<td><?php echo $cnt;?></td>
													<td><?php echo $n?></td>
													<td><?php echo $patient_id?></td>
													<td><?php echo $e?></td>
													<td><?php echo $phone?></td>
													<td><?php echo $service?> </td>
													<td><?php echo $dob?></td>
													<td><?php echo $decision?></td>
													<td>
    <a href="update.php?action=accept&pat_id=<?php echo $n ?>&pat_name=<?php echo $e ?>" class="badge badge-success"><i class="mdi mdi-eye"></i> Accept</a>
    <a href="update.php?action=decline&pat_id=<?php echo $n ?>&pat_name=<?php echo $e ?>" class="badge badge-danger"><i class="mdi mdi-eye"></i> Decline</a>
</td>
 
												</tr>
											</tbody>

											<?php 
											$cnt = $cnt +1 ; }
											?>

											<tfoot>
												<tr class="active">
													<td colspan="8">
														<div class="text-right">
															<ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
														</div>
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="../assets/js/vendor.min.js"></script>
		<script src="../assets/libs/footable/footable.all.min.js"></script>
		<script src="../assets/js/pages/foo-tables.init.js"></script>
		<script src="../assets/js/app.min.js"></script>
</body>
</html>