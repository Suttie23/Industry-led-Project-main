<?php

session_start();

$currentPage = 'register';
if (!isset($_SESSION['user_id'])) {
  include('includes/header.php');
} else {
  header("Location: user_login.php");
}

# Check form submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # Connect to the database.
  require('includes/connect_db.php');

  # Initialize an error array.
  $errors = array();

  # Check for a first name.
  if (empty($_POST['first_name'])) {
    $errors[] = 'Enter your first name.';
  } else {
    $fn = mysqli_real_escape_string($link, trim($_POST['first_name']));
  }

  # Check for a last name.
  if (empty($_POST['last_name'])) {
    $errors[] = 'Enter your last name.';
  } else {
    $ln = mysqli_real_escape_string($link, trim($_POST['last_name']));
  }

  # Check for a date of birth.
  if (empty($_POST['license_expiry'])) {
    $errors[] = 'Enter your license expiry date.';
  } else {
    $le = mysqli_real_escape_string($link, trim($_POST['license_expiry']));
  }

  # Check for a date of birth.
  if (empty($_POST['check_code'])) {
    $errors[] = 'Enter your DVLA Check Code.';
  } else {
    $ck = mysqli_real_escape_string($link, trim($_POST['check_code']));
  }

  # Check for a contact number.
  if (empty($_POST['contact_no'])) {
    $errors[] = 'Enter your contact number.';
  } else {
    $cn = mysqli_real_escape_string($link, trim($_POST['contact_no']));
  }

  # Check for an email address:
  if (empty($_POST['email'])) {
    $errors[] = 'Enter your email address.';
  } else {
    $e = mysqli_real_escape_string($link, trim($_POST['email']));
  }

  # Check for a password and matching input passwords.
  if (!empty($_POST['pass1'])) {
    if ($_POST['pass1'] != $_POST['pass2']) {
      $errors[] = 'Passwords do not match.';
    } else {
      $p = mysqli_real_escape_string($link, trim($_POST['pass1']));
    }
  } else {
    $errors[] = 'Enter your password.';
  }

  # Check if email address already registered.
  if (empty($errors)) {
    $q = "SELECT user_id FROM users WHERE email='$e'";
    $r = @mysqli_query($link, $q);
    if (mysqli_num_rows($r) != 0) $errors[] = 'Email address already registered. <a href="login.php">Login</a>';
  }

  # On success register user inserting into 'users' database table.
  if (empty($errors)) {
    $q = "INSERT INTO users (forename, surname, email, pass, phone_no, license_expiry, check_code) VALUES ('$fn', '$ln', '$e', SHA2('$p',256), '$cn', '$le', '$ck')";
    $r = @mysqli_query($link, $q);
    if ($r) {
      header("Location: index.php");
    }

    # Close database connection.
    mysqli_close($link);

    exit();
  }
  # Or report errors.
  else {
    echo '<div class="container">
			<div class="alert alert-primary alert-dismissible fade show" role="alert">
			<h1>Error!</h1>
			<p id="err_msg">The following error(s) occurred:<br>';
    foreach ($errors as $msg) {
      echo " - $msg<br>";
    }
    echo '<hr>
			<p class="mb-0">Please try again.</p>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		   </div>
		  </div>';
    # Close database connection.
    mysqli_close($link);
  }
}
?>



<div class="container">
  <br>
  <h1 class="text-center light-text display-4">Sign Up</h1>
  <br>
  <div class="col-sm d-flex justify-content-center">
    <div class="card text-center">

      <div class="card-body">
        <!-- Display body section with sticky form. -->
        <form action="register.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-12">
              <h4>Account Information</h4>
            </div>
            <div class="form-group col-md-6">
              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" size="20" required value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
            </div>
            <div class="form-group col-md-6">
              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" size="20" required value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
            </div>
            <div class="form-group col-md-6">
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" size="50" required value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
            </div>
            <div class="form-group col-md-6">
              <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Enter Contact Number" size="20" required value="<?php if (isset($_POST['contact_no'])) echo $_POST['contact_no']; ?>">
            </div>
            <div class="form-group col-md-6">
              <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Create Password" size="20" required value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>">
            </div>
            <div class="form-group col-md-6">
              <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Confirm Password" size="20" required value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>">
            </div>
            <div class="form-group col-md-12">
              <h4>Driving License Information</h3>
            </div>
            <div class="form-group col-md-6">
              <h6>License Expiry Date</h6>
              <input type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" id="datefield" name="license_expiry" size="20" required value="<?php if (isset($_POST['license_expiry'])) echo $_POST['license_expiry']; ?>">
            </div>
            <div class="form-group col-md-6">
              <h6>DVLA Check Code</h6>
              <input type="text" class="form-control" id="check_code" name="check_code" placeholder="Enter DVLA Check Code" size="20" required value="<?php if (isset($_POST['check_code'])) echo $_POST['check_code']; ?>">
            </div>
          </div>
      </div>
      <div class="card-footer text-muted">
        <div class="col-auto my-1">
          <button type="submit" class="btn btn-dark btn-block">Sign Up Now</button>
        </div>
        </form>

      </div>
    </div>
  </div>
</div>

<?php

include('includes/footer.php');


?>