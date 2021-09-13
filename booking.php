<?php

session_start();

$currentPage = 'booking';
if (isset($_SESSION['user_id']) && $_SESSION['account_status'] == 2) {
  include('includes/header_loggedin.php');
} else if ($_SESSION['user_id'] == 1) {
  header("Location: user_account.php");
} else {
  header("Location: login.php");
}
require('includes/connect_db.php');

include('includes/booking-table.php');

include('includes/calendar.php');

$calendar = new Calendar(date('Y-m-d'));

$q = "SELECT * FROM booking";
$r = mysqli_query($link, $q);

if (mysqli_num_rows($r) > 0) {
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    $start = new DateTime("{$row["booking_time"]}");
    $return = new DateTime("{$row["booking_return"]}");
    $days = $return->diff($start)->format("%a");

    $calendar->add_event("Booking ID: {$row['booking_id']} Booking Start: {$row['booking_time']} Booking Return: {$row['booking_return']}", $row['booking_time'], $days+1);
  }
}

?>

<div class="card mb-4">
  <div class="card-header">
    <em class="fas fa-table mr-1"></em>
    All Bookings
  </div>

  <div class="card-body">
    <div class="table-responsive">
        <?= $calendar ?>
    </div>
  </div>

</div>

<?php

include('includes/footer.php');
