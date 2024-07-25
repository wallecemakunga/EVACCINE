<?php
require_once("../config.php");

if (isset($_POST['vaccination'])) {
    $vaccination = $_POST['vaccination'];

    // Fetch dosages based on the selected vaccination (medication name)
    $query = "SELECT dosage FROM medication WHERE medication_name = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $vaccination);
    $stmt->execute();
    $result = $stmt->get_result();

    $options = '<option value="">Select Dose</option>';
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . htmlspecialchars($row['dosage']) . '">Dose ' . htmlspecialchars($row['dosage']) . '</option>';
    }

    echo $options;
}
?>
