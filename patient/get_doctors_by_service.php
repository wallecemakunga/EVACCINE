<?php
require_once("../config.php");

if (isset($_GET['clinic_id']) && isset($_GET['service'])) {
    $clinic_id = $_GET['clinic_id'];
    $service = $_GET['service'];

    $query = mysqli_query($con, "SELECT * FROM doctors WHERE clinic_id='$clinic_id' AND specialization='$service'");
    
    echo "<option value=''>Select Doctor</option>";
    while ($row = mysqli_fetch_array($query)) {
        echo "<option value='" . htmlspecialchars($row['doctor_id']) . "'>" . htmlspecialchars($row['Full_Name']) . "</option>";
    }
}
?>
