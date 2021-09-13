<?php # PROCESS LOGIN ATTEMPT.

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Open database connection.
  require ( 'connect_db.php' ) ;

  # Get connection, load, and validate functions.
  require ( 'login_tools.php' ) ;

  # Check login.
  list ( $check, $data ) = validate ( $link, $_POST[ 'email' ], $_POST[ 'pass' ] ) ;

  # On success set session data and display logged in page.
  if ( $check )  
  {
    # Access session.
    session_start();
    $_SESSION[ 'user_id' ] = $data[ 'user_id' ] ;
    $_SESSION[ 'forename' ] = $data[ 'forename' ] ;
    $_SESSION[ 'surname' ] = $data[ 'surname' ] ;
    $_SESSION[ 'email' ] = $data[ 'email' ] ;
    $_SESSION[ 'pass' ] = $data[ 'pass' ] ;
    $_SESSION[ 'phone_no' ] = $data[ 'phone_no' ] ;
    $_SESSION[ 'license_expiry' ] = $data[ 'license_expiry' ] ;
    $_SESSION[ 'check_code' ] = $data[ 'check_code' ] ;   
    $_SESSION[ 'account_level' ] = $data[ 'account_level' ] ;
    $_SESSION[ 'account_status' ] = $data[ 'account_status' ] ;
    load ( '../user_login.php' ) ;
  }
  # Or on failure set errors.
  else { $errors = $data; } 

  # Close database connection.
  mysqli_close( $link) ; 
}

# Continue to display login page on failure.
include ( '../login.php' ) ;
