<?php

session_start();

$db = require('connect_db.php');


# Check form submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {

  $db;

  $errors = array();

  $id = $_POST['user_id'];

  if (!empty($_POST['forename'])) {
    $fn = trim($_POST['forename']);
    $q = "UPDATE users SET forename='$fn' WHERE user_id='$id'";
    $r = @mysqli_query($link, $q);
    $_SESSION['forename'] = $fn;
  }

  if (!empty($_POST['surname'])) {
    $ln = trim($_POST['surname']);
    $q = "UPDATE users SET surname='$ln' WHERE user_id='$id'";
    $r = @mysqli_query($link, $q);
    $_SESSION['surname'] = $ln;
  }

  if (!empty($_POST['check_code'])) {
    $ln = trim($_POST['check_code']);
    $q = "UPDATE users SET check_code='$ln' WHERE user_id='$id'";
    $r = @mysqli_query($link, $q);
    $_SESSION['check_code'] = $ln;
  }

  if (!empty($_POST['license_expiry'])) {
    $ln = trim($_POST['license_expiry']);
    $q = "UPDATE users SET license_expiry='$ln' WHERE user_id='$id'";
    $r = @mysqli_query($link, $q);
    $_SESSION['license_expiry'] = $ln;
  }

  mysqli_close($link);

  foreach ($errors as $msg) {
    alert($msg);
  }

  header("Refresh:0; url=../user_login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['booking_destination'])) {

  $db;

  $errors = array();

  if (!empty($_POST['booking_destination'])) {

    $ui = trim($_POST['booked_user']);
    $ci = trim($_POST['campus_id']);
    $bd = trim($_POST['booking_destination']);
    $bt = date("Y-m-d H:i:s", strtotime($_POST["booking_time"]));
    $br = date("Y-m-d H:i:s", strtotime($_POST["booking_return"]));

    $z = "SELECT vehicle_id FROM vehicle WHERE vehicle_id NOT IN (SELECT vehicle_id FROM booking WHERE booking_time<='{$br}' AND booking_return>='{$bt}') AND campus_id='$ci' AND vehicle_status='2' LIMIT 1";
    $m = mysqli_query($link, $z);

    if (mysqli_num_rows($m) > 0) {
      while ($car = mysqli_fetch_array($m, MYSQLI_ASSOC)) {
        $vi = $car['vehicle_id'];
      }
    } else {
      $errors[] = "There are no available vehicles, please try again later.";
    }

    $bp = trim($_POST['booking_purpose']);
    $pa = trim($_POST['booking_passengers']);

    $q = "INSERT INTO booking (vehicle_id, user_id, booking_time, booking_return, booking_destination, booking_purpose, booking_passengers) VALUES ('$vi', '$ui', '$bt', '$br', '$bd', '$bp', '$pa')";
    mysqli_query($link, $q);
  }

  mysqli_close($link);

  foreach ($errors as $msg) {
    alert($msg);
  }

  header("Refresh:0; url=../booking.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['booking_id'])) {

  $db;

  $errors = array();

  $id = $_POST['booking_id'];

  if (!empty($_POST['start_mileage'])) {
    $sm = trim($_POST['start_mileage']);
    $q = "UPDATE booking SET start_mileage='$sm' WHERE booking_id='$id'";
    $r = @mysqli_query($link, $q);
  }

  if (!empty($_POST['return_mileage'])) {
    $rm = trim($_POST['return_mileage']);
    $q = "UPDATE booking SET return_mileage='$rm' WHERE booking_id='$id'";
    $r = @mysqli_query($link, $q);

    $q = "UPDATE booking SET trip_mileage=(return_mileage-start_mileage) WHERE booking_id='$id'";
    $r = @mysqli_query($link, $q);
  }

  mysqli_close($link);

  foreach ($errors as $msg) {
    alert($msg);
  }

  header("Refresh:0; url=../booking.php");
}

function alert($msg)
{
  echo "<script type='text/javascript'>alert('$msg');</script>";
}
