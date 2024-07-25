<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("location:index.php");
}
require_once("../config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
<link rel="icon" type="image/jpg" href="../images/logo.jpg">
<style type="text/css">
    .container-fluid {
        width: 100%;
        padding-right: 12px;
        padding-left: 218px;
        margin-right: auto;
        margin-top: 60px;
        margin-left: auto;
    }
</style>
<script src="../assets/js/vendor.min.js"></script>
<!-- App js -->
<script src="../assets/js/app.min.js"></script>
</head>

<body>
    <?php include("home.php")?>
    <?php
    $pat_id=$_GET['pat_id'];
    $q=mysqli_query($con,"SELECT * FROM patients WHERE patient_id='$pat_id'" );
    while($row=mysqli_fetch_array($q)){
        $n=$row['patient_id'];
        $e=$row['Full_Name'];
        $t=$row['address'];
        $phone=$row['Phone_number'];
        $r=$row['dob'];
        $Gender=$row['Gender'];
        ?>

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><?php echo $e?>'s Profile</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-xl-4">
                            <div class="card-box text-center">
                                <img src="../assets/images/users/patient.png" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image">

                                        <div class="text-left mt-3">

                                            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2"><?php echo $e?> </span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2"><?php echo $phone;?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Address :</strong> <span class="ml-2"><?php echo $t?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Date Of Birth :</strong> <span class="ml-2"><?php echo $r?></span></p>
                                            <p class="text-muted mb-2 font-13"><strong>Gender :</strong> <span class="ml-2"><?php echo $Gender?></span></p>
                                        </div>
                            </div> 
                        </div>

                    <?php }?>

                    <div class="col-lg-8 col-xl-8">
                        <div class="card-box">
                            <ul class="nav nav-pills navtab-bg nav-justified">
                                <li class="nav-item">
                                    <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">Prescription</a>
                                </li>

                                <li class="nav-item">
                                     <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Lab Record</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content">
                    <div class="tab-pane show active" id="aboutme">
                  <ul class="list-unstyled timeline-sm">
                                                <?php
                                                    $pres_pat_number =$_GET['pat_id'];
                                                   $q=mysqli_query($con,"SELECT  * FROM vaccination WHERE patient_id = '$pres_pat_number'" )or die('Error223');
                                            $cnt=1;
                                            while($row=mysqli_fetch_array($q)){
                                                $n=$row['vaccine_name'];
                                                $r=$row['date_added'];
                                                ?>
                                            <li class="timeline-sm-item">
                                                        <span class="timeline-sm-date"><?php echo date("Y-m-d", strtotime($r));?></span>
                                                        <h5 class="mt-0 mb-1"><?php echo $n;?></h5>
                                                        <p class="text-muted mt-2">
                                                            
                                                        </p>

                                                    </li>
                                                <?php }?>
                                            </ul> <!-- end tab-pane -->
                                        </div>
                                        <!-- end Prescription section content -->
<div class="tab-pane show " id="timeline">
                                            <div class="table-responsive">
                                                <table class="table table-borderless mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Body Temperature</th>
                                                            <th>Heart Rate/Pulse</th>
                                                            <th>Respiratory Rate</th>
                                                            <th>Blood Pressure</th>
                                                            <th>Date Recorded</th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    $vit_pat_number = $_GET['pat_id']; 

$q=mysqli_query($con,"SELECT  * FROM medical_records WHERE patient_id = '$vit_pat_number'" )or die('Error223');
                                            $cnt=1;
                                            while($row=mysqli_fetch_array($q)){
                                                $n=$row['bodytemp'];
                                                $e=$row['heartpulse'];
                                                $t=$row['resprate'];
                                                $b=$row['bloodpress'];
                                                $r=$row['date_added'];
                                            ?>
                                                        <tbody>
                                                            <tr>
                                                                <td><?php echo $n;?>°C</td>
                                                                <td><?php echo $e;?>BPM</td>
                                                                <td><?php echo $t;?>bpm</td>
                                                                <td><?php echo $b;?>mmHg</td>
                                                                <td><?php echo date("Y-m-d", strtotime($r));?></td>
                                                            </tr>
                                                        </tbody>
                                                    <?php }?>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- end vitals content-->

                                        <div class="tab-pane" id="settings">
                                            <ul class="list-unstyled timeline-sm">
                                                <?php
                                                    $vit_pat_number =$_GET['pat_id'];
                                                    $q=mysqli_query($con,"SELECT  * FROM medical_records WHERE patient_id = '$vit_pat_number'" )or die('Error223');
                                            $cnt=1;
                                            while($row=mysqli_fetch_array($q)){
                                                $pres=$row['lab_records'];
                                                $r=$row['date_added'];
                                         
                                                    
                                                    
                                                ?>
                                                    <li class="timeline-sm-item">
                                                        <span class="timeline-sm-date"><?php echo date("Y-m-d", strtotime($r));?></span>
                                                        <h3 class="mt-0 mb-1"><?php echo $pres;?></h3>
                                                        <hr>
                                                        <h5>
                                                           Laboratory  Tests
                                                        </h5>
                                                        
                                                        <p class="text-muted mt-2">
                                                            <?php echo $pres;?>
                                                        </p>
                                                        <hr>
                                                        <h5>
                                                           Laboratory Results
                                                        </h5>
                                                        
                                                        <p class="text-muted mt-2">
                                                           
                                                        </p>
                                                        <hr>

                                                    </li>
                                                <?php }?>
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                                        


    <script src="../assets/js/vendor.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
</body>
</html>