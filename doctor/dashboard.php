<?php
if (session_status() == PHP_SESSION_NONE){
    session_start();
}
if (!isset($_SESSION['username'])){
    header("location:index.php");
}
require_once("../config.php");
$username = $_SESSION['username']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <!-- Boxicons CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
   <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/home.css" />
  <link rel="icon" type="image/jpg" href="../images/logo.jpg">
  <title>HOME</title>
  <style type="text/css">
    .col-md-6 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        padding-top: 200px;
        padding-left: 300px;
        max-width: 45%;
        }
    </style>
</head>
<body>
    <?php include("home.php")?>
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                            <i class="fab fa-accessible-icon  font-22 avatar-title text-danger"></i>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="text-right">
                            <?php
                //code for summing up number of out patients 
                            $result ="SELECT count(*) FROM patients  ";
                            $stmt = $con->prepare($result);
                            $stmt->execute();
                            $stmt->bind_result($patient);
                            $stmt->fetch();
                            $stmt->close();
                            ?>

                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $patient;?></span></h3>
                            <p class="text-muted mb-1 text-truncate">Patients</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
        <!--End Out Patients-->

        <!--Start InPatients-->
        <div class="col-md-6 col-xl-4">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
                            <i class="mdi mdi-flask font-22 avatar-title text-danger"></i>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="text-right">
                            <?php
                            /** code for summing up number of assets,*/ 
                            $result ="SELECT count(*) FROM  appointment where doctor_id = '$username'";
                            $stmt = $con->prepare($result);
                            $stmt->execute();
                            $stmt->bind_result($assets);
                            $stmt->fetch();
                            $stmt->close();
                            ?>
                            <h3 class="text-dark mt-1"><span data-plugin="counterup"><?php echo $assets;?></span></h3>
                            <p class="text-muted mb-1 text-truncate">Appointments</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div>
    </div>
</body>
</html>                               