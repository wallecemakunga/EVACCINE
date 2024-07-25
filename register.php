<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration Form</title>
    <!-- Boxicons CDN Link -->
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
   <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/popup_style.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <link rel="icon" type="images/jpg" href="images/logo.jpg">
   <style>
     .word{
      color: hotpink;
      font-size: 24px;
     }
     .word span a{
      color: violet;
     }

     .bg-img{
  background: url('images/vaccine3.jpg');
  height: 100vh;
  background-size: cover;
  background-position: center;
}
   </style>
   <script>
 const currentDate = new Date();
const maxDate = new Date(currentDate.getFullYear() - 20, 11, 31);
const input = document.querySelector('input[name="dob"]');

input.max = maxDate.toISOString().split('T')[0];
</script>
  </head>
  <body>
    <div class="bg-img">
      <div class="content">
        <header> Register</header>
        <form action="register.php" method="post">

          <div class="field">
            <span class="bx bx-user"></span>
            <input type="text" name="fname"  placeholder="Enter Your Fullname" required>
          </div>

          <div class="field space">

            <span class="bi bi-gender-ambiguous"></span>
           <select name="gender" required>
            <option value=""> Select your Gender</option>
            <option value="Male">Male</option>  
            <option value="Female">Female</option>
          </select>
          </div>

           <div class="field space">
            <span class="bi bi-calendar-check-fill"></span>
            <input type="date" name="dob" placeholder="Date of Birth" required max="<?php echo date('Y') - 20 ?>-12-31">
          </div>


            <div class="field space">
            <span class="bi bi-telephone"></span>
            <input type="tel" name="phone" id="phone" placeholder="Phone Number (10 digits)" required>
          </div>
          

          <div class="field space">
            <span class="bx bx-key"></span>
            <input type="password"  name="password" class="pass-key" required placeholder="Password">
            <span class="show">SHOW</span>
          </div>

          <div class="field space">
            <input type="submit" name="register" value="REGISTER">
          </div><br>
          <div class="word">
    <span>Already have an account?</span>
    <span><a href="index.php">Login Here</a></span>
  </div>
          
        </form>
       <?php
// Function to generate unique ID
function generateUniqueId($dob, $gender, $lastFourDigits) {
    // Determine the gender prefix
    $genderPrefix = ($gender == 'Male') ? 'M' : 'F';

    // Combine the first part of the ID with the last four digits
    $uniqueId = $genderPrefix . '-' . str_replace('-', '', $dob) . '-' . $lastFourDigits;

    return $uniqueId;
}

// Connect to the database
$con = mysqli_connect("localhost", "root", "", "vaccine");
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
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $pass1 = md5($password);

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
    } elseif (!isPasswordValid($password)) {
        echo "Password must contain at least one letter, one digit, and be at least 8 characters long.";
    } else {
        // Insert user data into the database

      $sql = "INSERT INTO patients VALUES ('$customId','$fname', '$dob','$gender','$phone', '$pass1',' $lastFourDigits')";
        $query=mysqli_query($con,$sql);
        if ($query) {
           echo "
    <div class='popup popup--icon -success js_success-popup popup--visible'>
        <div class='popup__background'></div>
        <div class='popup__content'>
            <h3 class='popup__content__title'>
                Success 
            </h3>
            <p>Registration Successfully<br>Remember your login ID Before Proceeding <span id='customId'>$customId</span></p>
            <p>
                <a href='index.php'><button class='button button--success' data-for='success'>Return to Home</button></a>
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


      </div>
    </div>

    <script>
      const pass_field = document.querySelector('.pass-key');
      const showBtn = document.querySelector('.show');
      showBtn.addEventListener('click', function(){
       if(pass_field.type === "password"){
         pass_field.type = "text";
         showBtn.textContent = "HIDE";
         showBtn.style.color = "#3498db";
       }else{
         pass_field.type = "password";
         showBtn.textContent = "SHOW";
         showBtn.style.color = "#222";
       }
      });
  </script> 

  <script>
document.addEventListener("DOMContentLoaded", function() {
  var phoneInput = document.getElementById('phone');

  // Restrict input to 10 digits
  phoneInput.addEventListener('input', function() {
    if (phoneInput.value.length > 10) {
      phoneInput.value = phoneInput.value.slice(0, 10); // Limit to first 10 digits
    }
  });
});
</script> 
   
  




  </body>
</html>
