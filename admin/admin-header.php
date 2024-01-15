<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('location: ../');
  exit;
}
if ($_SESSION['privilege'] != 'admin' || $_SESSION['privilege'] != 'admin') {
    header('location: ../');
    exit;
  }

  require_once '../assets/dbhandler.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo WEBSITE_TITLE ?></title>
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <script src="../assets/sidenav.js" defer></script>
  </head>
  <body>
    <header>
      <h1 class="page-head">Voting System Administration</h1>
      <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <!-- <a href="#">About</a>
        <a href="#" class="active">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a> -->
        <ul>
          <li class="t-li"><a href="./" class="t-nav-links">Results</a></li>
          <li class="t-li"><a href="student-acc.php" class="t-nav-links">Student Accounts</a></li>
          <li class="t-li"><a href="register-student.php" class="t-nav-links">Register Student</a></li>
          <li class="t-li"><a href="register-admin.php" class="t-nav-links">Register Admin</a></li>
          <li class="t-li"><a href="view-candidates.php" class="t-nav-links">View Candidates</a></li>
          <li class="t-li"><a href="register-candidate.php" class="t-nav-links">Register Candidate</a></li>
          <li class="t-li"><a href="view-partylist.phpS" class="t-nav-links">View Partylist</a></li>
          <li class="t-li"><a href="register-partylist.phpS" class="t-nav-links">Register Partylist</a></li>
          <li class="t-li"><a href="add-position.phpS" class="t-nav-links">Add Position</a></li>
          <li class="t-li"><a href="view-positions.phpS" class="t-nav-links">View Positions</a></li>
        </ul>
      </div>
      <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <ul>

        </ul>
      </div>
      <nav class="top-nav">
        <ul class="t-ul">
          <li class="t-li t-li-1"><span class="burger" onclick="openNav()">&#9776;</span></li>
        </ul>
        <ul class="t-ul">
          <li class="t-li"><a href="../assets/logout.php" class="t-nav-links">Logout</a></li>               
        </ul>
      </nav>
    </header>
    <main>
   