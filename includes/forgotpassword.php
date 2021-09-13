<?php # PROCESS LOGIN ATTEMPT.

session_start() ;

# Check form submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # Open database connection.
  require('connect_db.php');


  $recoveryemail = $_POST['email'];

  mysqli_query($conn, "SELECT * FROM users WHERE email='" . $recoveryemail . "'");

  $token = md5($emailId) . rand(10, 9999);

  $q = "UPDATE users SET pass= SHA2('$token',256) WHERE email='$recoveryemail'";
  $r = @mysqli_query ( $link, $q ) ;

  // the message
  $msg = "Your recovery password is:\n $token\n\nLog in with this password, then navigate to 'My Account' to set a new password";

  // use wordwrap() if lines are longer than 70 characters
  $msg = wordwrap($msg, 70);

  // send email
  mail($recoveryemail, "Webflix Password Recovery", $msg);

  header('Location: ../index.php');
}
