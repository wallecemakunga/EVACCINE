<?php
require_once("../config.php");

if (isset($_GET['clinic_id'])) {
    $clinic_id = $_GET['clinic_id'];

    $query = mysqli_query($con, "SELECT DISTINCT specialization FROM doctors WHERE clinic_id='$clinic_id'");
    
    echo "<option value=''>Select Service</option>";
    while ($row = mysqli_fetch_array($query)) {
        echo "<option value='" . htmlspecialchars($row['specialization']) . "'>" . htmlspecialchars($row['specialization']) . "</option>";
    }
}
?>
