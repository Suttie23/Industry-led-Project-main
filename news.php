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

<div class="d-flex justify-content-center">
  <h2>All News Articles</h2>
</div>

<!--News Cards-->
<div class="d-flex justify-content-center">
  <div class="row d-flex justify-content-center mx-auto">

    <?php
    $q = "SELECT * FROM news order by post_id desc";
    $r = mysqli_query($link, $q);
    if (mysqli_num_rows($r) > 0) {
      while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        $short = substr($row['post_content'], 0, 197) . "...";  // returns "abcde"
    ?>
        <div class="card col-xl-3 mx-2 mt-2">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?php echo "{$row['post_title']}"; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo "{$row['post_date']}"; ?></h6>
            <p class="card-text"><?php echo "$short"; ?></p>
            <div class="card-footer bg-transparent mt-auto">
              <a href="article.php?id=<?php echo "{$row['post_id']}"; ?>" class="card-link">Read Full Article</a>
            </div>
          </div>
        </div>

    <?php
      }
    }
    # Or display message.
    else {
      echo '<p>There are currently no news posts</p>';
    }
    ?>
  </div>
</div>
<div class="d-flex mt-2 justify-content-center" style="padding-bottom: 20px;">
<a href="index.php" class="btn btn-secondary btn-lg" role="button" aria-disabled="true">Return Home</a>
</div>

<?php

include('includes/footer.php');

?>