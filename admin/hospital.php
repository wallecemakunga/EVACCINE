<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../assets/css/form.css">
  <link rel="stylesheet" href="../assets/css/popup_style.css">
  <link rel="icon" type="image/jpg" href="../images/logo.jpg">
  <title>Add Hospital</title>
 <script>
  function getstate(val) {
  //alert(val);
  $.ajax({
  type: "POST",
  url: "get_state.php",
  data:'coutrycode='+val,
  success: function(data){
    $("#statelist").html(data);
  }
  });
}
function getcity(val) {
  //alert(val);
  $.ajax({
  type: "POST",
  url: "get_city.php",
  data:'statecode='+val,
  success: function(data){
    $("#city").html(data);
  }
  });
}
</script> 

  
</head>
<body>

<?php include("home.php")?>

<div class='signup-container'>
  <div class='left-container'>
    <h1>
      <i class='fas fa-paw'></i>
      Evaccine
    </h1>
    <div class='puppy'>
      <img src='../images/doctor.jpg'>
    </div>
  </div>
  <div class='right-container'>
   <form action="hospital.php" method="POST">
    <div class='right-container'>
      <header>
        <h1>Add Hospital!</h1>
        <div class='set'>
          <div class='pets-name'>
            <label for='pets-name'>Name</label>
            <input id='pets-name' name="hname" placeholder="Hospital's Name" type='text' required>
          </div>
          <div class='pets-name'>
            <label for='pets-name'>Email</label>
            <input id='pets-name' name="email" placeholder="hospital@gmail.com" type='email' required>
          </div>

        </div>

        <div class='set'>
          <div class='pets-breed'>
            <label for='pets-breed'>Phone Number</label>
            <input id='pets-breed' name="phone" placeholder="Phone Number" type='number' required>
          </div>

          <div class='pets-birthday'>
            <label for='pets-birthday'>Physical Address</label>
            <input id='pets-birthday' name="address" placeholder='P.O box 2121,Musoma' type='text' required>
          </div>
        </div>

        <div class='set'>
          
        
         <div class='set'>
            <div class='pets-gender'>
              <label for='pet-gender-female'>Region</label>
             <select onChange="getstate(this.value);"  name="region" id="country" class="form-control" required >
        <option value="">Select Region</option>
        <?php $query =mysqli_query($con,"SELECT * FROM country ");
        while($row=mysqli_fetch_array($query))
          {
          ?>
          <option value="<?php echo $row['id'];?>"><?php echo $row['countryname'];?></option>
          <?php
        }
        ?>
      </select>
            </div>
          </div>

            <div class='pets-gender'>
              <label for='pet-gender-female'>District</label>
             <select   name="district" id="statelist" onChange="getcity(this.value);" class="form-control" required >
        <option value="">Select District</option>
      </select>
            </div>
          </div>
         <div class='set'>
            <div class='pets-gender'>
              <label for='pet-gender-female'>Village</label>
              <select  name="village" id="city" required>
        <option value="">Select village</option>
      </select>
            </div>
          </div>
        </div>
            
            
        </header>
        <footer>
          <div class='set'>
             <button input type="submit" name="register" value="REGISTER">REGISTER</button>
          </div>
        </footer>
      </div>
    </div>
</form>
</header>
</div>
</form>
</div>
</div>

<script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>


<?php
 
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "vaccine");
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Function to check if email is already taken
function isEmailTaken($con, $hname) {
    $query = "SELECT COUNT(*) AS count FROM clinics WHERE clinic_name = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $hname);
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


// Process user registration form
if (isset($_POST["register"])) {
    $hname = $_POST['hname'];
   $email=$_POST['email'];
    $phone = $_POST['phone'];
     $address = $_POST['address'];
     $region=$_POST['region'];
      $district = $_POST['district'];
    $ward = $_POST['village'];


    if (isEmailTaken($con, $hname)) {
        echo "Username is already taken. Please choose a different name.";
    } elseif (!isPhoneNumberValid($phone)) {
        echo "Invalid phone number. Please provide a 10-digit phone number.";
    }else {
        // Insert user data into the database

      $sql = "INSERT INTO clinics VALUES ('','$hname','$region','$district',' $ward', '$phone','$address','$email')";
        $query=mysqli_query($con,$sql);
        if ($query) {
           echo "
            <div class='popup popup--icon -success js_success-popup popup--visible'>
                <div class='popup__background'></div>
                <div class='popup__content'>
                    <h3 class='popup__content__title'>
                        Success 
                    </h1>
                    <p>Hospital added SucessFully</p>
                    <p>
                        <a href='hospital.php'><button class='button button--success' data-for='success'>Return to Home</button></a>
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

</body>
</html>