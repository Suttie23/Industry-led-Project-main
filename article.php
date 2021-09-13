<?php

session_start();

$currentPage = 'index';
if (isset($_SESSION['user_id'])) {
  include('includes/header_loggedin.php');
} else {
  include('includes/header.php');
}

require('includes/connect_db.php');
?>

<?php if ($_SESSION['account_status'] == "2" && isset($_SESSION['forename'])) : ?>
  <header class="masthead light-text" id="index-mast">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h2>Edinburgh College Fleet Booking</h2>
            <a href="booking.php" class="btn btn-secondary btn-lg" role="button" aria-disabled="true">Book A Car!</a>
          </div>
        </div>
      </div>
    </div>
  </header>
<?php else : ?>
  <header class="masthead light-text" id="index-mast">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h2>Edinburgh College Fleet Master</h2>
            <a href="register.php" class="btn btn-secondary btn-lg" role="button" aria-disabled="true">Register</a>
            <a href="login.php" class="btn btn-secondary btn-lg" role="button" aria-disabled="true">Login</a>
          </div>
        </div>
      </div>
    </div>
  </header>
<?php endif ?>

<?php

# Get passed movie id and assign it to a variable.
if (isset($_GET['id'])) $id = $_GET['id'];

# Open database connection.
require('includes/connect_db.php');

$q = "SELECT * FROM news WHERE post_id = '$id'";
$r = mysqli_query($link, $q);

#Create conditional if statement which will execute code if the condition is TRUE.
if (mysqli_num_rows($r) > 0) {


    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '
        <div class="container">
        <h1 class="card-title mb-3">'  . $row['post_title'] . '</h1>
        <h2 class="card-subtitle mb-3 text-muted">Posted On: '  . $row['post_date'] . ' </h2>
        </div>
         <div class="container">
         <hr class="featurette-divider text-white">
         </div>
         <div class="container">
         <div class="row">
          <p>'  . $row['post_content'] . '</p>
        </div>
        <hr class="featurette-divider text-white">
        <a id="myLink" title="Return to previous page" href="#" onclick="goBack();return false;">Return to previous page</a>
        </div>
        <hr class="featurette-divider text-white">
      ';
    }
}

?>

<?php

include('includes/footer.php');


?>