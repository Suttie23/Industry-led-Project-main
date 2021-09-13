<?php

require('connect_db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['booking_id'])) {

    $dir = "../logs/{$_POST['booking_id']}.txt";

    $check = fopen($dir, "w") or die("Unable to generate file!");

    $txt = "Vehicle Check Sheet for Booking ID " . $_POST['booking_id'];
    fwrite($check, $txt);


    /* Before Trip */

    $txt = "\n\nCharge Before: " . $_POST['check_charge_out'];
    fwrite($check, $txt);
    $txt = "\nCharge Lead Present: " . $_POST['charge_lead_out'];
    fwrite($check, $txt);
    $txt = "\nCharging Card Present: " . $_POST['charge_post_card_out'];
    fwrite($check, $txt);
    $txt = "\nWashers/Wipers Clean and Intact: " . $_POST['washers_and_wipers_out'];
    fwrite($check, $txt);
    $txt = "\nWindows Intact: " . $_POST['windows_and_windscreen_out'];
    fwrite($check, $txt);
    $txt = "\nMirrors Clean and Intact: " . $_POST['mirrors_out'];
    fwrite($check, $txt);
    $txt = "\nIndicators Working: " . $_POST['indicators_out'];
    fwrite($check, $txt);
    $txt = "\nLights Working: " . $_POST['lights_out'];
    fwrite($check, $txt);
    $txt = "\nHorn Working: " . $_POST['horn_out'];
    fwrite($check, $txt);
    $txt = "\nSeat Belt Working: " . $_POST['seat_belt_out'];
    fwrite($check, $txt);
    $txt = "\nDamage Before: " . $_POST['body_damage_out'];
    fwrite($check, $txt);
    $txt = "\nTyre Condition Before: " . $_POST['tyre_condition_out'];
    fwrite($check, $txt);
    $txt = "\nFirst Aid Kit Present: " . $_POST['first_aid_out'];
    fwrite($check, $txt);
    $txt = "\nHi-vis Jacket Present: " . $_POST['hi_vis_out'];
    fwrite($check, $txt);
    $txt = "\nWarning Triangle Present: " . $_POST['warning_triangle_out'];
    fwrite($check, $txt);
    $txt = "\nCar Has Been Sanitised: " . $_POST['sanitised_out'];
    fwrite($check, $txt);

    /* After Trip */

    $txt = "\n\nCharge After: " . $_POST['check_charge_in'];
    fwrite($check, $txt);
    $txt = "\nCharge Lead Present: " . $_POST['charge_lead_in'];
    fwrite($check, $txt);
    $txt = "\nCharging Card Present: " . $_POST['charge_post_card_in'];
    fwrite($check, $txt);
    $txt = "\nWashers/Wipers Clean and Intact: " . $_POST['washers_and_wipers_in'];
    fwrite($check, $txt);
    $txt = "\nWindows Intact: " . $_POST['windows_and_windscreen_in'];
    fwrite($check, $txt);
    $txt = "\nMirrors Clean and Intact: " . $_POST['mirrors_in'];
    fwrite($check, $txt);
    $txt = "\nIndicators Working: " . $_POST['indicators_in'];
    fwrite($check, $txt);
    $txt = "\nLights Working: " . $_POST['lights_in'];
    fwrite($check, $txt);
    $txt = "\nHorn Working: " . $_POST['horn_in'];
    fwrite($check, $txt);
    $txt = "\nSeat Belt Working: " . $_POST['seat_belt_in'];
    fwrite($check, $txt);
    $txt = "\nDamage After: " . $_POST['body_damage_in'];
    fwrite($check, $txt);
    $txt = "\nTyre Condition After: " . $_POST['tyre_condition_in'];
    fwrite($check, $txt);
    $txt = "\nFirst Aid Kit Present: " . $_POST['first_aid_in'];
    fwrite($check, $txt);
    $txt = "\nHi-vis Jacket Present: " . $_POST['hi_vis_in'];
    fwrite($check, $txt);
    $txt = "\nWarning Triangle Present: " . $_POST['warning_triangle_in'];
    fwrite($check, $txt);
    $txt = "\nCar Has Been Sanitised: " . $_POST['sanitised_in'];
    fwrite($check, $txt);

    /* Additional Section */

    $txt = "\n\nAdditional Comments\n" . $_POST['comments'];
    fwrite($check, $txt);
    $txt = "\n\nVehicle is in condition indicated on this form: " . $_POST['confirmation'];
    fwrite($check, $txt);

    fclose($check);

    $id = $_POST['booking_id'];

    $bc = trim($dir);
    $q = "UPDATE booking SET booking_check='$bc' WHERE booking_id='$id'";
    mysqli_query($link, $q);

    header("Refresh:0; url=../booking.php");
}
