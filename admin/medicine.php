<!DOCTYPE HTML>
<html>
<head>
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/form.css">
  <link rel="stylesheet" href="../assets/css/popup_style.css">
  <link rel="icon" type="image/jpg" href="../images/logo.jpg">
  <title>Add Medicine</title>
</head>
<body>
  <?php include("home.php")?>

  <div class='signup-container'>
    <div class='left-container'>
      <h1><i class='fas fa-paw'></i>Evaccine</h1>

      <div class='puppy'>
        <img src='h1.jpg'>
      </div>
    </div>

    <div class='right-container'>
      <form action="medicine.php" method="POST">
        <div class='right-container'>
          <header>
            <h1>Add medicine!</h1>
            <div class='set'>
              <div class='pets-name'>
                <label for='pets-name'>Name</label>
                <input  name="mname" placeholder="vaccine's name" type='text' required>
              </div>

              <div class='pets-photo'>
                <div class='pets-gender'>
                  <label for='pet-gender-female'>Age Group</label>
                  <select  class="form-select" name="age">
                    <option value="">Select age group</option>
                    <option value="12 months">Below One Year</option>
                    <option value="1-2">1-2 years</option>
                    <option value="3-4">3-4 years</option>
                    <option value="4-5">4-5 years</option>
                    <option value="5 above">Above 5 years</option>
                  </select>
                </div>
              </div>
            </div>

            <div class='set'>
              <div class='pets-gender'>
                <label for='pet-gender-female'>Phone Number</label>
                  <input type="number" name='phone'  placeholder="Phone Number" required>
                </div>
        

                <div class='pets-gender'>
                  <label for='pet-gender-female'>Vendor</label>
                  <select  class="form-select" name="vendor">
                    <option value="">Select Vendor</option>
                    <option value="Tanzania">Tanzania</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Uganda">Uganda</option>
                      <option value="Uganda">Others</option>
                  </select>
                </div>
              </div>

              <div class='set'>
              <div class='pets-gender'>
                <label for='pet-gender-female'>Dosage</label>
                  <input type="text" name='dosage'  placeholder="Dosage" required>
                </div>
              </div>
           
          </header>

          <footer>
            <div class='set'>
              <button input type="submit" name="register" value="REGISTER">ADD</button>
            </div>
          </footer>
        </div>
      </form>
    </div>
  </div>

<?php
 
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "vaccine");
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Function to check if email is already taken
function isEmailTaken($con, $mname) {
    $query = "SELECT COUNT(*) AS count FROM medication WHERE medication_name = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $mname);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['count'] > 0;
}
// Function to validate phone number format
function isPhoneNumberValid($phone) {
    return preg_match("/^[0-9]{10}$/", $phone) === 1; // Assumes a 10-digit phone number
}

// Process user registration form
if (isset($_POST["register"])) {
    $mname = $_POST['mname'];
    $age=$_POST['age'];
    $phone = $_POST['phone'];
    $vendor=$_POST['vendor'];
    $dosage = $_POST['dosage'];
   


    if (isEmailTaken($con, $mname)) {
        echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               Medicine Name taken .Please choose another name!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    } elseif (!isPhoneNumberValid($phone)) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              Invalid phone number.Please enter ten digits 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';;
    }else {
        // Insert user data into the database

      $sql = "INSERT INTO medication VALUES ('','$mname', '$age','$phone','$vendor','$dosage','')";
        $query=mysqli_query($con,$sql);
        if ($query) {
           echo "
            <div class='popup popup--icon -success js_success-popup popup--visible'>
                <div class='popup__background'></div>
                <div class='popup__content'>
                    <h3 class='popup__content__title'>
                        Success 
                    </h1>
                    <p>Medicine Added Successfully</p>
                    <p>
                        <a href='home.php'><button class='button button--success' data-for='success'>Return to Home</button></a>
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

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>