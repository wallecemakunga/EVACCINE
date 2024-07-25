<?php
include('config.php'); // Include your database connection

if(isset($_GET['village'])) {
    $villageId = intval($_GET['village']);
    $query = mysqli_query($con, "SELECT * FROM hospitals WHERE village_id = '$villageId'");
    
    echo "<option value=''>Select Hospital</option>";
    while($row = mysqli_fetch_array($query)) {
        echo "<option value='".htmlspecialchars($row['hospital_id'])."'>".htmlspecialchars($row['hospital_name'])."</option>";
    }
}
?>
