<?php
// Establish database connection
$connection = mysqli_connect('localhost', 'root', '', 'vaccine');

// Check if doctor_id is provided in the URL
if (isset($_GET['doctor_id'])) {
    // Sanitize input and prevent SQL injection
    $delete_id = mysqli_real_escape_string($connection, $_GET['doctor_id']);

    // Formulate the SQL query with proper quotes around $delete_id
    $sql = "DELETE FROM doctors WHERE doctor_id = '$delete_id'";

    // Execute the query
    if (mysqli_query($connection, $sql)) {
        // Redirect to view.php after successful deletion
        header("Location: view.php");
        exit; // Ensure script stops executing after redirection
    } else {
        // Display error if the query fails
        echo "Error deleting record: " . mysqli_error($connection);
    }
} else {
    // Redirect or display error if doctor_id is not provided
    header("Location: view.php"); // Redirect to view.php or handle error
    exit; // Ensure script stops executing after redirection
}

// Close database connection
mysqli_close($connection);
?>
