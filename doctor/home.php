<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
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
  <link rel="stylesheet" href="../assets/css/home.css" />
  <link rel="icon" type="image/jpg" href="../images/logo.jpg">
  <title>HOME</title>
  <style type="text/css">
    .sidebar {
    background-color: var(--white-color);
    width: 270px;
    position: fixed;
    top: 40px;
    left: 0;
    height: 100%;
    padding: 80px 20px;
    z-index: 100;
    overflow-y: scroll;
    box-shadow: 0 0 1px var(--grey-color-light);
    transition: all 0.5s ease;
}
  </style>
</head>

<body>
  <!-- navbar -->
  <nav class="navbar">
    <div class="logo_item">
      <i class="bx bx-menu" id="sidebarOpen"></i>
      <span class="logo_name">Doctor<br>ID: <?php echo $_SESSION['username']; ?> </span>
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
         <li class="item">
            <a href="dashboard.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bxs-grid"></i>
              </span>
              <span class="navlink">Dashboard</span>
            </a>
          </li>
        
          <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
            <i class='bx bxs-injection'></i></span>
              <span class="navlink">Medications</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <ul class="menu_items submenu">
              <a href="treatment.php" class="nav_link sublink">
                <span class="navlink_icon">
               <i class='bx bxs-injection'></i>
               <span class="navlink">Treatment</span> 
             </a>
            </ul>
          </li>
    
        </ul>

        <ul class="menu_items">
          <div class="menu_title menu_editor"></div>
          

          <li class="item">
            <a href="appoint.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bxs-time"></i>
              </span>
              <span class="navlink">Appointments</span>
            </a>
          </li>
        </ul>
        
        <ul class="menu_items">
             <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-home-alt"></i>
              </span>
              <span class="navlink">Settings</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <ul class="menu_items submenu">
               <a href="changepass.php" class="nav_link sublink ">
               <span class="navlink_icon">
                <i class="bx bx-key"></i>
              </span>
               <span class="navlink">Change Password</span>
             </a>
            </ul>

             <ul class="menu_items submenu">
              <a href="../logout.php" class="nav_link sublink">
              <span class="navlink_icon">
                <i class="bx bx-log-out"></i>
              </span>
              <span class="navlink">Logout</span>
            </a>
            </ul>
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
    <script src="script.js"></script>
  </body>
</html>