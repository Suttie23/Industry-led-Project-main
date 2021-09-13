<?php

require('includes/connect_db.php');

?>

<div class="card mb-4">
    <div class="card-header">
        <em class="fas fa-table mr-1"></em>
        Your Bookings
    </div>
    <div class="d-flex flex-row">
        <?php
        $c = "SELECT * FROM booking WHERE user_id='{$_SESSION['user_id']}' AND booking_check IS NULL";
        $u = mysqli_query($link, $c);
        if (mysqli_num_rows($u) > 0) {
            while ($row = mysqli_fetch_array($u, MYSQLI_ASSOC)) {
        ?>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Booking ID: <?php echo "{$row['booking_id']}"; ?> - Missing Check Sheet</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#newCheckModal<?php echo "{$row['booking_id']}"; ?>" data-toggle="modal">Add Check Sheet</a>
                            <div class="small text-white"><em class="fas fa-angle-right"></em></div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="newCheckModal<?php echo "{$row['booking_id']}"; ?>" tabindex="-1" role="dialog" aria-labelledby="details" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Fill Check Sheet</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="includes/generate_check_sheet.php" method="post">
                                    <input type="hidden" id="userId" name="booking_id" value="<?php echo "{$row['booking_id']}"; ?>">

                                    <div class="row">
                                        <div class="col-sm">
                                            <h5> Car Out </h5>
                                            <div class="form-group">
                                                <input type="text" name="check_charge_out" class="form-control" placeholder="Vehicle Charge Before" value="<?php if (isset($_POST['check_charge_out'])) echo $_POST['check_charge_out']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <h5> Car In </h5>
                                            <div class="form-group">
                                                <input type="text" name="check_charge_in" class="form-control" placeholder="Vehicle Charge After" value="<?php if (isset($_POST['check_charge_in'])) echo $_POST['check_charge_in']; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="charge_lead_out" class="form-control" required>
                                                    <option value="" selected disabled hidden>Charge Lead Present</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="charge_lead_in" class="form-control" required>
                                                    <option value="" selected disabled hidden>Charge Lead Present</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="charge_post_card_out" class="form-control" required>
                                                    <option value="" selected disabled hidden>Charge Post Card Present</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="charge_post_card_in" class="form-control" required>
                                                    <option value="" selected disabled hidden>Charge Post Card Present</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="washers_and_wipers_out" class="form-control" required>
                                                    <option value="" selected disabled hidden>Washers / Wipers Working</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="washers_and_wipers_in" class="form-control" required>
                                                    <option value="" selected disabled hidden>Washers / Wipers Working</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="windows_and_windscreen_out" class="form-control" required>
                                                    <option value="" selected disabled hidden>Windows Intact</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="windows_and_windscreen_in" class="form-control" required>
                                                    <option value="" selected disabled hidden>Windows Intact</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="mirrors_out" class="form-control" required>
                                                    <option value="" selected disabled hidden>Mirrors Clean / Intact</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="mirrors_in" class="form-control" required>
                                                    <option value="" selected disabled hidden>Mirrors Clean / Intact</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="indicators_out" class="form-control" required>
                                                    <option value="" selected disabled hidden>Indicators Working</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="indicators_in" class="form-control" required>
                                                    <option value="" selected disabled hidden>Indicators Working</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="lights_out" class="form-control" required>
                                                    <option value="" selected disabled hidden>Lights Working</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="lights_in" class="form-control" required>
                                                    <option value="" selected disabled hidden>Lights Working</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="horn_out" class="form-control" required>
                                                    <option value="" selected disabled hidden>Horn Working</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="horn_in" class="form-control" required>
                                                    <option value="" selected disabled hidden>Horn Working</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="seat_belt_out" class="form-control" required>
                                                    <option value="" selected disabled hidden>Seat Belt Working</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="seat_belt_in" class="form-control" required>
                                                    <option value="" selected disabled hidden>Seat Belt Working</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <input type="text" name="body_damage_out" class="form-control" placeholder="Damage Before (Describe)" value="<?php if (isset($_POST['body_damage_out'])) echo $_POST['body_damage_out']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <input type="text" name="body_damage_in" class="form-control" placeholder="Damage After (Describe)" value="<?php if (isset($_POST['body_damage_in'])) echo $_POST['body_damage_in']; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <input type="text" name="tyre_condition_out" class="form-control" placeholder="Tyre Condition Before (Describe)" value="<?php if (isset($_POST['tyre_condition_out'])) echo $_POST['tyre_condition_out']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <input type="text" name="tyre_condition_in" class="form-control" placeholder="Tyre Condition After (Describe)" value="<?php if (isset($_POST['tyre_condition_in'])) echo $_POST['tyre_condition_in']; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="first_aid_out" class="form-control" required>
                                                    <option value="" selected disabled hidden>First Aid Kit Present</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="first_aid_in" class="form-control" required>
                                                    <option value="" selected disabled hidden>First Aid Kit Present</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="hi_vis_out" class="form-control" required>
                                                    <option value="" selected disabled hidden>Hi Vis Jacket Present</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="hi_vis_in" class="form-control" required>
                                                    <option value="" selected disabled hidden>High Vis Jacket Present</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="warning_triangle_out" class="form-control" required>
                                                    <option value="" selected disabled hidden>Warning Triangle Present</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="warning_triangle_in" class="form-control" required>
                                                    <option value="" selected disabled hidden>Warning Triangle Present</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="sanitised_out" class="form-control" required>
                                                    <option value="" selected disabled hidden>Vehicle Sanitised</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <select name="sanitised_in" class="form-control" required>
                                                    <option value="" selected disabled hidden>Vehicle Sanitised</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>Comments and Details</h5>
                                        <input type="text" name="comments" class="form-control" placeholder="Comments on Vehicle" value="<?php if (isset($_POST['comments'])) echo $_POST['comments']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <select name="confirmation" class="form-control" required>
                                            <option value="" selected disabled hidden>Vehicle is in Condition Indicated on This Form</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <input type="submit" name="btnAddCheck" class="btn btn-dark btn-block" value="Submit Check Sheet" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="d-flex flex-row">
        <?php
        $c = "SELECT * FROM booking WHERE user_id='{$_SESSION['user_id']}' AND trip_mileage IS NULL";
        $u = mysqli_query($link, $c);
        if (mysqli_num_rows($u) > 0) {
            while ($row = mysqli_fetch_array($u, MYSQLI_ASSOC)) {
        ?>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Booking ID: <?php echo "{$row['booking_id']}"; ?> - Missing Mileage</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#editMileageModal<?php echo "{$row['booking_id']}"; ?>" data-toggle="modal">Add Mileage Information</a>
                            <div class="small text-white"><em class="fas fa-angle-right"></em></div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editMileageModal<?php echo "{$row['booking_id']}"; ?>" tabindex="-1" role="dialog" aria-labelledby="details" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Update Vehicle Mileage</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="includes/edit.php" method="post">
                                    <input type="hidden" id="userId" name="booking_id" value="<?php echo "{$row['booking_id']}"; ?>">
                                    <div class="form-group">
                                        <input type="text" name="start_mileage" class="form-control" placeholder="Mileage Before Use" value="<?php if (isset($_POST['start_mileage'])) echo $_POST['start_mileage']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="return_mileage" class="form-control" placeholder="Mileage After Use" value="<?php if (isset($_POST['return_mileage'])) echo $_POST['return_mileage']; ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <input type="submit" name="btnAddLog" class="btn btn-dark btn-block" value="Submit Vehicle Milage" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

        <?php
            }
        }
        ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Vehicle Booked</th>
                        <th>Booked Start Time</th>
                        <th>Booked End Time</th>
                        <th>Destination</th>
                        <th>Purpose</th>
                        <th>Passenger Count</th>
                        <th>Start Mileage</th>
                        <th>Return Mileage</th>
                        <th>Trip Mileage</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Booking ID</th>
                        <th>Vehicle Booked</th>
                        <th>Booked Start Time</th>
                        <th>Booked End Time</th>
                        <th>Destination</th>
                        <th>Purpose</th>
                        <th>Passenger Count</th>
                        <th>Start Mileage</th>
                        <th>Return Mileage</th>
                        <th>Trip Mileage</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>

                    <?php
                    $g = "SELECT * FROM booking WHERE user_id='{$_SESSION['user_id']}'";
                    $n = mysqli_query($link, $g);
                    if (mysqli_num_rows($n) > 0) {
                        while ($row = mysqli_fetch_array($n, MYSQLI_ASSOC)) {
                    ?>
                            <tr>
                                <td><?php echo "{$row['booking_id']}"; ?></td>
                                <td>
                                    <?php
                                    $q = "SELECT vehicle_reg FROM vehicle WHERE vehicle_id = '{$row['vehicle_id']}'";
                                    $r = mysqli_query($link, $q);
                                    if (mysqli_num_rows($r) == 0) {
                                        echo "No Vehicle Assigned";
                                    } else {
                                        $cam = mysqli_fetch_array($r, MYSQLI_ASSOC);

                                        echo "{$cam['vehicle_reg']}";
                                    }
                                    ?>
                                </td>
                                <td><?php echo "{$row['booking_time']}"; ?></td>
                                <td><?php echo "{$row['booking_return']}"; ?></td>
                                <td><?php echo "{$row['booking_destination']}"; ?></td>
                                <td><?php echo "{$row['booking_purpose']}"; ?></td>
                                <td><?php echo "{$row['booking_passengers']}"; ?></td>
                                <td><?php echo "{$row['start_mileage']}"; ?></td>
                                <td><?php echo "{$row['return_mileage']}"; ?></td>
                                <td><?php echo "{$row['trip_mileage']}"; ?></td>
                                <td>
                                    <div class="row">
                                        <form action="includes/delete.php" method="post">
                                            <input type="hidden" id="bookingID" name="booking_id" value="<?php echo "{$row['booking_id']}"; ?>">
                                            <button type="submit" name="btnDeleteUsr" class="btn" value=""><em class="fa fa-trash"></em> Delete</button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                    <?php
                        }
                    }

                    ?>
                </tbody>
                <a href="#newBookingModal" data-toggle="modal" style="text-decoration:none; color:inherit;"><button class="btn"><em class="fa fa-plus"></em> New Booking</a></button>
                <hr>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="newBookingModal" tabindex="-1" role="dialog" aria-labelledby="details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">New Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="includes/edit.php" method="post">
                    <input type="hidden" id="userId" name="booked_user" value="<?php echo "{$_SESSION['user_id']}"; ?>">
                    <div class="form-group">
                        <div class="form-group">
                            <select name="campus_id" class="form-control">
                                <option value="" selected disabled hidden>Choose Current Campus</option>

                                <?php

                                $f = "SELECT * FROM campus";
                                $a = mysqli_query($link, $f);
                                if (mysqli_num_rows($a) > 0) {
                                    while ($coc = mysqli_fetch_array($a, MYSQLI_ASSOC)) {

                                ?>
                                        <option value="<?php echo "{$coc['campus_id']}"; ?>"><?php echo "{$coc['campus_name']}"; ?></option>
                                <?php
                                    }
                                }

                                ?>

                            </select>

                        </div>
                        <input type="text" name="booking_destination" class="form-control" placeholder="Destination" value="<?php if (isset($_POST['booking_destination'])) {
                                                                                                                                echo $_POST['booking_destination'];
                                                                                                                            } ?>" required>

                    </div>
                    <div class="form-group">
                        <h6>Booking Start Time</h6>
                        <input type="datetime-local" name="booking_time" class="form-control" min="<?php echo date('Y-m-d H:i'); ?>" placeholder="Destination" value="<?php echo date('Y-m-d H:i'); ?>" required>
                    </div>
                    <div class="form-group">
                        <h6>Booking Return Time</h6>
                        <input type="datetime-local" name="booking_return" class="form-control" min="<?php echo date('Y-m-d H:i'); ?>" placeholder="Destination" value="<?php echo date('Y-m-d  H:i'); ?>" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" cols="60" name="booking_purpose" placeholder="Booking Purpose"><?php if (isset($_POST['booking_purpose'])) {
                                                                                                                                    echo $_POST['booking_purpose'];
                                                                                                                                } ?></textarea>
                    </div>
                    <div class="form-group">
                        <select name="booking_passengers" class="form-control">
                            <option value="" selected disabled hidden>Passengers</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <input type="submit" name="btnEditUser" class="btn btn-dark btn-block" value="Submit Changes" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>