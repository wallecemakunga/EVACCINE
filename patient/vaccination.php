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
$q=mysqli_query($con,"SELECT * FROM vaccination WHERE patient_id = '$username' " )or die('Error223');
?>

<!DOCTYPE html>
<html lang="en">
<title>Appointments Results</title>
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"> 
<link rel="stylesheet" type="text/css" href="../assets/css/app.min.css">
<link rel="stylesheet" type="text/css" href="../assets/css/argon.min.css"> 
<link rel="stylesheet" type="text/css" href="../assets/libs/footable/footable.core.min.css"> 

<body>
    <?php include("home.php")?>

    <div id="wrapper">
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Vaccine Results</h4>
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
                                    <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="8">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th data-hide="phone">Vaccination Number</th>
                                                <th data-hide="phone">Child's Name</th>
                                                <th data-hide="phone">Vaccine name</th>
                                                <th data-hide="phone">Dosage</th>
                                                <th data-hide="phone">Vaccination Date</th>
                                                <th data-hide="phone"> Next Vaccination Date</th>
                                                <th data-hide="phone">Comments</th>
                                                
                                            </tr>
                                        </thead>
                                        <?php
                                        $cnt=1;
                                        while($row=mysqli_fetch_array($q)){
                                            $n=$row['vaccination_id'];
                                            $patient_id=$row['child_name'];
                                            $e=$row['vaccine_name'];
                                            $hospital=$row['Dose_number'];
                                            $medication=$row['vaccination_Date'];
                                            $batch=$row['Next_vaccine'];
                                           
                                            $comments=$row['comment'];

            ?>

                                            <tbody>
                                                <tr>
                                                    <td><?php echo $cnt;?></td>
                                                    <td><?php echo $n?></td>
                                                    <td><?php echo $patient_id?></td>
                                                    <td><?php echo $e?></td>
                                                    <td><?php echo $hospital?> Times </td>
                                                    <td><?php echo $medication?></td>
                                                    <td><?php echo $batch?></td>
                                                    <td><?php echo $comments?></td>
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