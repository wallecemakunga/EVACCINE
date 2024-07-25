<?php
// Include database connection
require_once("../config.php");

// Get clinic_id from AJAX request
if (isset($_GET['clinic_id'])) {
    $clinic_id = $_GET['clinic_id'];

    // Fetch doctors associated with the selected hospital
    $query = mysqli_query($con, "SELECT * FROM doctors WHERE clinic_id = '$clinic_id'");
    if ($query) {
        echo "<option value=''>Select Doctor</option>";
        while ($row = mysqli_fetch_array($query)) {
            echo "<option value='" . $row['doctor_id'] . "'>" . $row['Full_Name'] . "</option>";
        }
    } else {
        echo "<option value=''>No doctors found</option>";
    }
} else {
    echo "<option value=''>Invalid request</option>";
}
?>
