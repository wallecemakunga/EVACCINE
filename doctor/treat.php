<!DOCTYPE HTML>
<html>
<head>
  <link href="../assets/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/form.css">
  <link rel="stylesheet" href="../assets/css/popup_style.css">
  <link rel="icon" type="image/jpg" href="../assets/logo.jpg">
  <title>Treatment</title>
  <style type="text/css">
    .left-container img {
      filter: sepia(100%);
      width: 100%;
    }

    .row {
      display: flex;
      width: 70%;
      margin-top: 130px;
      margin-left: 200px;
      flex-wrap: wrap;
    }

  </style>
 
</head>
<body>
  <?php include("home.php") ?>
  <?php
  $pat_id = $_GET['pat_id'];
  $q = mysqli_query($con, "SELECT * FROM patients WHERE patient_id='$pat_id'");
  while ($row = mysqli_fetch_array($q)) {
    $n = $row['patient_id'];
    $e = $row['Full_Name'];
    $phone = $row['Phone_number'];
    $r = $row['dob'];
    $Gender = $row['Gender'];
  ?>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="header-title">Child's Vaccination Form</h4>
          <form method="post">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4" class="col-form-label">Parent's Name</label>
                <input type="text" required="required" readonly name="fname" value="<?php echo htmlspecialchars($e); ?>" class="form-control">
              </div>
              <div class="form-group col-md6">
                <label for="inputPassword4" class="col-form-label">Parent's ID</label>
                <input type="text" readonly name="pat_id" value="<?php echo htmlspecialchars($n); ?>" class="form-control" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4" class="col-form-label">Phone Number</label>
                <input type="text" readonly name="phone" value="<?php echo htmlspecialchars($phone); ?>" class="form-control" required>
              </div>
              <div class="form-group col-md-6">
                <label for="inputEmail4" class="col-form-label">Parent's Gender</label>
                <input type="text" readonly name="gender" value="<?php echo htmlspecialchars($Gender); ?>" class="form-control" required>
              </div>
            </div>
            
            <hr>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4" class="col-form-label">Child's Name</label>
                <input type="text" name="cname" placeholder="Child's Name" class="form-control" required>
              </div>
              <div class="form-group col-md-6">
                <label for="inputEmail4" class="col-form-label">Child's Gender</label>
                <select class="form-control" name="cgender" required>
                  <option value="">Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4" class="col-form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" max="<?php echo date('Y') - 5 ?>-12-31" required>
              </div>
              <div class="form-group col-md-6">
                <label for="inputEmail4" class="col-form-label">Birth Place</label>
                <select class="form-control" name="birthplace" required>
                  <option value="">Select Birth Place</option>
                  <option value="Hospital">Hospital</option>
                  <option value="Home">Home</option>
                  <option value="Others">Others</option>
                </select>
              </div>
            </div>

            <hr>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4" class="col-form-label">Vaccine Name</label>
               <select class="form-control" name="vaccine_name" required>
                  <option value="">Select Vaccine</option>
                  <option value="Polio">Polio</option>
                  <option value="DTP">DTP</option>
                  <option value="Surua">Surua</option>
                  <option value="Polio_opv">Polio Opv</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="inputEmail4" class="col-form-label">Dose Number</label>
                <input type="number" name="dose_number" placeholder="Dose Number" class="form-control" required>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4" class="col-form-label">Vaccination Date</label>
                <input type="date" name="vaccination_date"  id='appointmentDate' class="form-control" required>
              </div>
              <div class="form-group col-md-6">
                <label for="inputEmail4" class="col-form-label">Next Appointment Date</label>
                <input type="date" name="next_appointment_date" id='appointmentDate' class="form-control" required>
                
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label class="col-form-label">Comments or Follow-Up Instructions</label>
                <textarea class="form-control" name="comments" placeholder="Comments or Follow-Up Instructions"></textarea>
              </div>
            </div>

            <button type="submit" name="treat" class="btn btn-success">SUBMIT</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
</div>


<?php


if (isset($_POST["treat"])) {
    // Retrieve and sanitize the form data
    //$parent_name = mysqli_real_escape_string($con, $_POST['fname']);
    $parent_id = mysqli_real_escape_string($con, $_POST['pat_id']);
    //$phone = mysqli_real_escape_string($con, $_POST['phone']);
    //$parent_gender = mysqli_real_escape_string($con, $_POST['gender']);
    $child_name = mysqli_real_escape_string($con, $_POST['cname']);
    $child_gender = mysqli_real_escape_string($con, $_POST['cgender']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $birthplace = mysqli_real_escape_string($con, $_POST['birthplace']);
    $vaccine_name = mysqli_real_escape_string($con, $_POST['vaccine_name']);
    $dose_number = mysqli_real_escape_string($con, $_POST['dose_number']);
    $vaccination_date = mysqli_real_escape_string($con, $_POST['vaccination_date']);
    $next_appointment_date = mysqli_real_escape_string($con, $_POST['next_appointment_date']);
    $comments = mysqli_real_escape_string($con, $_POST['comments']);

    // Construct the SQL query to insert the data
    $query = "INSERT INTO vaccination (
              patient_id, 
                child_name, child_gender, dob, place_of_birth, 
                vaccine_name, Dose_number, vaccination_Date, 
                Next_vaccine, comment
              ) VALUES (
                 '$parent_id', 
                '$child_name', '$child_gender', '$dob', '$birthplace', 
                '$vaccine_name', '$dose_number', '$vaccination_date', 
                '$next_appointment_date', '$comments'
              )";

    // Execute the query
    if (mysqli_query($con, $query)) {
        // Success feedback
        echo "<div class='popup popup--icon -success js_success-popup popup--visible'>
                <div class='popup__background'></div>
                <div class='popup__content'>
                  <h3 class='popup__content__title'>Success</h3>
                  <p>Vaccination record successfully added.</p>
                  <p><a href='treatment.php'><button class='button button--success' data-for='success'>Proceed</button></a></p>
                </div>
              </div>";
    } else {
        // Error feedback
        echo "<div class='popup popup--icon -error js_error-popup popup--visible'>
                <div class='popup__background'></div>
                <div class='popup__content'>
                  <h3 class='popup__content__title'>Error</h3>
                  <p>There was an error adding the record: " . mysqli_error($con) . "</p>
                  <p><a href='treatment.php'><button class='button button--error' data-for='error'>Retry</button></a></p>
                </div>
              </div>";
    }
}
?>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Get the current date without any time portion
    const today = new Date();
    today.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to zero

    // Format the current date to "YYYY-MM-DD" string
    const formattedToday = today.toISOString().split('T')[0];

    // Set the minimum date for the appointment date input
    document.getElementById('appointmentDate').setAttribute('min', formattedToday);
  });

  const currentDate = new Date();
const maxDate = new Date(currentDate.getFullYear() - 2, 11, 31);
const input = document.querySelector('input[name="dob"]');

input.max = maxDate.toISOString().split('T')[0];
</script>

<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
