<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("location:index.php");
}
require_once("../config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />

  <!-- Boxicons CSS -->
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/popup_style.css">
  <link rel="stylesheet" href="../assets/css/home.css" />
  <link rel="icon" type="image/jpg" href="../logo.jpg">
  <title>HOME</title>
</head>

<body>
  <!-- navbar -->
  <nav class="navbar">
    <div class="logo_item">
      <i class="bx bx-menu" id="sidebarOpen"></i>
      <span class="logo_name">Coodinator<br>ID: <?php echo $_SESSION['username']; ?> </span>
    </div>

    <div class="navbar_content">
      <i class='bx bx-sun' id="darkLight"></i>
      <span class="admin_name">Welcome: <?php echo $_SESSION['fname']; ?></span>
    </div>
  </nav>

    <!-- sidebar -->
    <nav class="sidebar">
      <div class="menu_content">
        <ul class="menu_items">
          <div class="menu_title menu_dahsboard"></div>
          <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-home-alt"></i>
              </span>
              <span class="navlink">Home</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <ul class="menu_items submenu">
              <a href="changepass.php" class="nav_link sublink">Change Password</a>
            </ul>
          </li>

          <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class='bi bi-person-add'></i>
              </span>
              <span class="navlink">Add Users</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <ul class="menu_items submenu">
              <a href="doctor.php" class="nav_link sublink">
                <span class="navlink_icon">
                   <i class='bx bx-plus-medical'></i></span>
               <span class="navlink">Add Doctor</span> 
             </a>
               <a href="view.php" class="nav_link sublink">
              <span class="navlink_icon">
             <i class='bx bxs-user-detail'></i></span>
                <span class="navlink">View users</span>
              </a>

            </ul>

        <ul class="menu_items">
          <div class="menu_title menu_editor"></div>
          

          <li class="item">
            <a href="hospital.php" class="nav_link">
              <span class="navlink_icon">
                <i class='bx bx-clinic'></i>
              </span>
              <span class="navlink">Add Hospital</span>
            </a>
          </li> 
          
        </ul>
        <ul class="menu_items">
          <div class="menu_title menu"></div>
          <li class="item">
            <a href="../logout.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-log-out"></i>
              </span>
              <span class="navlink">Logout</span>
            </a>
          </li>


        </ul>

        <div class="bottom_content">
          <div class="bottom expand_sidebar">
            <span> Expand</span>
            <i class='bx bx-log-in' ></i>
          </div>
          <div class="bottom collapse_sidebar">
            <span> Collapse</span>
            <i class='bx bx-log-out'></i>
          </div>
        </div>
      </div>
    </nav>
    <!-- JavaScript -->
    <script src="../script.js"></script>
  </body>
</html>
