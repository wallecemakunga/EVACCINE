<!DOCTYPE html>
<html>
<head>
  <title>Update</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/popup_style.css">
    <link rel="icon" type="image/jpg" href="..images/logo.jpg">
</head>
<body>
<?php
// Check if pat_id and pat_name are provided via GET request
if(isset($_GET['pat_id']) && isset($_GET['pat_name']) && isset($_GET['action'])) {
    $pat_id = $_GET['pat_id'];
    $pat_name = $_GET['pat_name'];
    $action = $_GET['action'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vaccine";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Determine status based on action
    $status = '';
    if($action === 'accept') {
        $status = 'Accepted';
    } elseif($action === 'decline') {
        $status = 'Declined';
    }

    // Prepare SQL statement to update status
    $sql = "UPDATE appointment SET status = '$status' WHERE appointment_id = '$pat_id' AND Full_Name = '$pat_name'";
    //$sql = "UPDATE appointment SET status = '$status' WHERE patient_id = '$pat_id' AND Full_Name = '$pat_name'";
    
    $result = mysqli_query($conn,$sql);

if($result==true){
  echo" <div class='popup popup--icon -success js_success-popup popup--visible'>
    <div class='popup__background'></div>
    <div class='popup__content'>
    <h3 class='popup__content__title'>
    Success
    </h1>
    <p>Status updated Successfully </p>
    <p><a href='appoint.php'><button class='button button--success' data-for='success'>Return to home Page</button></a></p>
    </div>
    </div>";

  }else {
        echo "Error updating status: " . $conn->error;
    }

    // Close statement and connection
   
    $conn->close();
} else {
    echo "Invalid parameters provided";
}
?>
</body>
</html>