<?php

session_start();

require('connect_db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['booking_id'])) {

    $errors = array();

    $id = $_POST['booking_id'];

    if (!empty($_POST['booking_id'])) {

        $q = "DELETE FROM booking WHERE booking_id='$id'";
        $r = @mysqli_query($link, $q);
    }

    foreach ($errors as $msg) {
        alert($msg);
    }

    header("Refresh:0; url=../booking.php");
}


function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

?>
