<?php

session_start();

$currentPage = 'forgot_password';
if(!isset($_SESSION['user_id']) ){
    include('includes/header.php');
} else {
    header("Location: user_login.php");
}

/* The $errors array will only be set by the PHP
handler script after the form has been submitted
Display any error messages if present.*/

if ( isset( $errors ) && !empty( $errors ) )
{
 echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
		<p id="err_msg">Oops! There was a problem:<br>' ;
 foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
 echo 'Please try again or <a href="register.php"><strong>Register</strong></a></p>
 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>' ;
}
?>

<!-- Display body section. 
Clicking the login button before the PHP handler 
script has been created will simply produce an HTTP404 page Not Found error
-->
<br>
<h1 class="text-center light-text display-4">Forgot Password</h1>
<br>
<div class="d-flex justify-content-center">
	<div class="card text-center flex-even">
	  
	 
	  <div class="card-body">
	   <div class="row">
		<div class="col-sm col-md">
			<form action="includes/forgotpassword.php" method="post">
				<input type="text"  class="form-control" name="email" placeholder="Email" required>
		</div>
		</div>
	  <div class="card-footer text-muted">
			<input type="submit" class="btn btn-dark btn-block" value="Reset Password" >
		</form>

	  </div>
	</div>
</div>

</div>

<?php

include('includes/footer.php');


?>
