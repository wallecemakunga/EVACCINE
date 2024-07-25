 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../css/popup_style.css">
  </head>
  <body>


    <?php
    // Function to generate unique ID
    function generateUniqueId($dob, $gender, $lastFourDigits) {
    // Determine the gender prefix
        $genderPrefix = ($gender == 'M') ? 'M' : 'F';

        // Combine the first part of the ID with the last four digits
        $uniqueId = $genderPrefix . '-' . str_replace('-', '', $dob) . '-' . $lastFourDigits;
        return $uniqueId;
}
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "hcis");
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Function to check if email is already taken
function isEmailTaken($con, $fname) {
    $query = "SELECT COUNT(*) AS count FROM patients WHERE Full_Name = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $fname);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['count'] > 0;
}

// Function to validate phone number format
function isPhoneNumberValid($phone) {
    return preg_match("/^[0-9]{10}$/", $phone) === 1; // Assumes a 10-digit phone number
}

// Function to validate password format
function isPasswordValid($password) {
    return preg_match('/^(?=.*[0-9])(?=.*[A-Za-z]).{8,}$/', $password) === 1; // Requires at least one digit, one letter, and be at least 8 characters long
}

// Function to get the last four digits of the last generated ID from the database
function getLastFourDigits($con) {
    $query = "SELECT id_suffix FROM patients ORDER BY id_suffix DESC LIMIT 1";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['id_suffix'] ?? 0; // Default to 0 if no previous IDs exist
}

// Process user registration form
if (isset($_POST["register"])) {
    $fname = $_POST['fname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $region = $_POST['region'];
    $district=$_POST['district'];
    $village=$_POST['village'];
    $phone = $_POST['phone'];
     $passport = $_POST['passport'];
    //$password = $_POST['password'];
    //$pass1 = md5($password);

    // Get the last four digits of the last generated ID
    $lastFourDigits = getLastFourDigits($con);

    // Increment the last four digits
    $lastFourDigits++;

    // Generate unique ID
    $customId = generateUniqueId($dob, $gender, $lastFourDigits);

    if (isEmailTaken($con, $fname)) {
        echo "Username is already taken. Please choose a different name.";
    } elseif (!isPhoneNumberValid($phone)) {
        echo "Invalid phone number. Please provide a 10-digit phone number.";
    }else {
        // Insert user data into the database

      $sql = "INSERT INTO patients VALUES ('$customId','$fname', '$dob','$gender','$region','$district','$village','$phone','$passport',' $lastFourDigits')";
        $query=mysqli_query($con,$sql);
        if ($query) {
           echo "
            <div class='popup popup--icon -success js_success-popup popup--visible'>
                <div class='popup__background'></div>
                <div class='popup__content'>
                    <h3 class='popup__content__title'>
                        Success 
                    </h1>
                    <p>Registration Successfully</p>
                    <p>
                        <a href='patient.php'><button class='button button--success' data-for='success'>Return to Home</button></a>
                    </p>
                </div>
            </div>";
        } else {
            echo" <div class='popup popup--icon -error js_error-popup popup--visible'>
                    <div class='popup__background'></div>
                    <div class='popup__content'>
                        <h3 class='popup__content__title'>
                            Error 
                        </h1>
                        <p>Registration Failed</p>
                        <p>
                            <a href=''><button class='button button--error' data-for='js_error-popup'>Close</button></a>
                        </p>
                    </div>
                </div>";
    }
  }
}
?>
