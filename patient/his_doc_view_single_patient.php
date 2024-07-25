<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("location:index.php");
}
require_once("../config.php");
?>

<!DOCTYPE html>
    <html lang="en">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="icon" type="text/css" href="../images/logo.jpg">
    <style type="text/css">
        .container-fluid {
    width: 100%;
    padding-right: 12px;
    padding-left: 318px;
    margin-right: auto;
    margin-top: 10px;
    margin-left: auto;
}
    </style>
  

 <?php include("home.php")?>
            <?php
                //$pat_number=$_GET['patient_id'];
                $pat_id=$_GET['pat_id'];
                $q=mysqli_query($con,"SELECT * FROM patients WHERE patient_id='$pat_id'" );                              
                 while($row=mysqli_fetch_array($q))
                                               {
                                                 $n=$row['patient_id'];
                                                $e=$row['Full_Name'];
                                                 $t=$row['address'];
                                                $phone=$row['Phone_number'];
                                                $r=$row['dob'];
                                                $Gender=$row['Gender'];
                                                  $passport=$row['passport'];
                                                 $added=$row['date_added'];

                                            ?>
                
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            
                                       
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo $e?>'s Profile</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

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
                                        <hr>
                                        <p class="text-muted mb-2 font-13"><strong>Date Recorded :</strong> <span class="ml-2"><?php echo date("d/m/Y - h:m", strtotime($added));?></span></p>
                                        <hr>




                                    </div>

                                </div> <!-- end card-box -->

                            </div> <!-- end col-->
                            
                            <?php }?>
                            
                                        
                                    

                                    </div> <!-- end tab-content -->
                                </div> <!-- end card-box-->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->

                </div> <!-- content -->

                

            </div>
            

          


        </div>
    </body>


</html>