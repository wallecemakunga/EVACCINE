
<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../assets/css/form.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/popup_style.css">
  <link rel="logo" type="image/jpg" href="../images/logo.jpg">
  <title>Book Appointment</title>

  <style>
    .left-container {
    width: 250px;
}
  </style>
</head>
<body>

<?php include("home.php")?>

<?php
$q=mysqli_query($con,"SELECT * FROM patients WHERE patient_id='".$_SESSION['username']."'" );
while($row=mysqli_fetch_array($q)){
  $n=$row['patient_id'];
  $e=$row['Full_Name'];
  $phone=$row['Phone_number'];
  $r=$row['dob'];
  $Gender=$row['Gender'];
  ?>


  <div class='signup-container'>
  <div class='left-container'>
    <h1>
      <i class='fas fa-paw'></i>
    
    </h1>
    <div class='puppy'>
      <img src='4.jpg'>
    </div>
  </div>
  <div class='right-container'>
    <form action="booking.php" method="POST">
      <header>
        <h1>Book Appointment!</h1>
        <div class="col-6">
          <div class='set'>
            <div class='patients-name'>
              <label for='patients-name'>Full Name</label>
              <input type="text" name='fname' value="<?php echo htmlspecialchars($e); ?>" readonly>
            </div>
            <div class='patients-name'>
              <label for='patients-name'>Patient ID</label>
              <input type="text" name='pat_id' value="<?php echo htmlspecialchars($n); ?>" readonly>
            </div>
          </div>
        </div>
        <div class='set'>
          <div class='pets-breed'>
            <label for='pets-breed'>Phone Number</label>
            <input id='pets-breed' type='number' name="phone" value="<?php echo htmlspecialchars($phone); ?>" readonly>
          </div>
          <div class='pets-gender'>
            <label for='pet-gender-female'>Hospital</label>
            <select class="form-select" name="hospital" id="hospitalSelect" required>
              <option value="">Select Hospital</option>
              <?php
              $query = mysqli_query($con, "SELECT * FROM clinics");
              while ($row = mysqli_fetch_array($query)) {
                  echo "<option value='" . htmlspecialchars($row['clinic_id']) . "'>" . htmlspecialchars($row['clinic_name']) . "</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class='set'>
          <div class='pets-weight'>
            <label for='pet-weight-0-25'>Service</label>
            <select class="form-select" name="service" id="serviceSelect" required>
              <option value="">Select Service</option>
            </select>
          </div>
          <div class='pets-spayed-neutered'>
            <label for='pet-gender-female'>Doctor</label>
            <select class="form-select" name="doctor_id" id="doctorSelect" required>
              <option value="">Select Doctor</option>
            </select>
          </div>
        </div>
        <div class='set'>
          <div class='pets-weight'>
            <label for='pet-weight-0-25'>Appointment Date</label>
            <input type="date" name="dop"  id='appointmentDate' class="form-control" required>
          </div>
        </div>
       
      </header>
      <footer>
        <div class='set'>
          <button type="submit" name="register" value="REGISTER">BOOK</button>
        </div>
      </footer>
    </form>
       <?php }?>
  </div>
</div>

<?php
if (isset($_POST["register"])) {
    $fname = $_POST['fname'];
    $pat_id = $_POST['pat_id'];
    $phone = $_POST['phone'];
    $hospital = $_POST['hospital'];
    $doctor = $_POST['doctor_id'];
    $dop = $_POST['dop'];
    $service = $_POST['service'];
    $status='pending';
 $sql = "INSERT INTO appointment VALUES ('','$fname', '$pat_id','$phone','$hospital','$doctor','$dop','$service','$status')";
        $query=mysqli_query($con,$sql);
        if ($query) {
           echo "
            <div class='popup popup--icon -success js_success-popup popup--visible'>
                <div class='popup__background'></div>
                <div class='popup__content'>
                    <h3 class='popup__content__title'>
                        Success 
                    </h1>
                    <p>Appointment booked!Please Visit Your inbox for feedback</p>
                    <p>
                        <a href='results.php'><button class='button button--success' data-for='success'>Return to Home</button></a>
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
?>

<script>
  // Get the current date without any time portion
  const today = new Date();
  today.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to zero

  // Format the current date to "YYYY-MM-DD" string
  const formattedToday = today.toISOString().split('T')[0];

  // Set the minimum date for the appointment date input
  document.getElementById('appointmentDate').min = formattedToday;

    document.getElementById('hospitalSelect').addEventListener('change', function() {
        var clinicId = this.value;
        if (clinicId !== '') {
            // Call function to populate doctors based on selected hospital
            populateDoctors(clinicId);
        } else {
            // Reset doctor options if no hospital is selected
            document.getElementById('doctorSelect').innerHTML = "<option value=''>Select Doctor</option>";
        }
    });

   
</script>

<script>
    // Fetch services when a hospital is selected
    document.getElementById('hospitalSelect').addEventListener('change', function() {
        var clinicId = this.value;
        if (clinicId !== '') {
            populateServices(clinicId);
        } else {
            document.getElementById('serviceSelect').innerHTML = "<option value=''>Select Service</option>";
            document.getElementById('doctorSelect').innerHTML = "<option value=''>Select Doctor</option>";
        }
    });

    function populateServices(clinicId) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_services_by_clinic.php?clinic_id=' + clinicId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('serviceSelect').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

    // Fetch doctors when a service is selected
    document.getElementById('serviceSelect').addEventListener('change', function() {
        var service = this.value;
        var clinicId = document.getElementById('hospitalSelect').value;
        if (service !== '' && clinicId !== '') {
            populateDoctors(clinicId, service);
        } else {
            document.getElementById('doctorSelect').innerHTML = "<option value=''>Select Doctor</option>";
        }
    });

    function populateDoctors(clinicId, service) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_doctors_by_service.php?clinic_id=' + clinicId + '&service=' + service, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('doctorSelect').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

     document.addEventListener("DOMContentLoaded", function() {
    // Get the current date without any time portion
    const today = new Date();
    today.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to zero

    // Format the current date to "YYYY-MM-DD" string
    const formattedToday = today.toISOString().split('T')[0];

    // Set the minimum date for the appointment date input
    document.getElementById('appointmentDate').setAttribute('min', formattedToday);
  });
</script>

</body>
</html>
