<?php

session_start();

$currentPage = 'account';
if (isset($_SESSION['user_id'])) {
	include('includes/header_loggedin.php');
} else {
	header("Location: login.php");
}

?>
<div class="user-section bg-light">
	<div class="container">
		<?php
		echo "<div class=\"container\"><h1 class=\"text-center display-4\">Welcome {$_SESSION['forename']} {$_SESSION['surname']}</title></div>";
		?>
		<div class="row d-flex">
			<div class="col-sm-12 col-md-6">
				<div class="alert fade show" role="alert">

					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>User Details</th>

							</tr>
						</thead>
						<tbody>

							<tr>
								<td>First Name</td>
								<td><?php echo "{$_SESSION['forename']}"; ?></td>
							</tr>
							<tv>
								<td>Last Name</td>
								<td><?php echo "{$_SESSION['surname']}"; ?></td>
							</tv>
							<tr>
								<td>Email</td>
								<td><?php echo "{$_SESSION['email']}"; ?></td>
							</tr>
							<tr>
								<td>Account Status</td>
								<td><?php if ($_SESSION['subscribed'] == "1") {
										echo "Blocked";
									} else {
										echo "Active";
									} ?></td>
							</tr>

						</tbody>
					</table>
					<div class="row">
						<div class="col">
							<a href="#" data-toggle="modal" data-target="#details"><em class="fa fa-edit"></em>Edit Details</a>
						</div>
						<div class="col">
							<a href="#" data-toggle="modal" data-target="#password"><em class="fa fa-edit"></em> Change Password</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="alert fade show" role="alert">

					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>License Details</th>

							</tr>
						</thead>
						<tbody>

							<tr>
								<td>DVLA Check Code</td>
								<td><?php echo "{$_SESSION['check_code']}"; ?></td>
							</tr>
							<tv>
								<td>License Expiry Date</td>
								<td><?php echo "{$_SESSION['license_expiry']}"; ?></td>
							</tv>
							<tr>
								<td>License Status</td>
								<td><?php if ($_SESSION['subscribed'] == "1") {
										echo "Blocked";
									} else {
										echo "Active";
									} ?></td>
							</tr>
							<tr>
								<td>License Expires In</td>
								<td>X Days</td>
							</tr>

						</tbody>
					</table>
					<div class="row">
						<div class="col">
							<a href="#" data-toggle="modal" data-target="#license"><em class="fa fa-edit"></em>Edit Details</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<?php

include('includes/footer.php');

?>
<!--  =========================
=====    Modal Edit Details   =======
	=========================== -->


<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="details" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Change Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="includes/edit.php" method="post">
					<input type="hidden" id="userId" name="user_id" value="<?php echo "{$_SESSION['user_id']}"; ?>">
					<div class="form-group">
						<input type="text" name="forename" class="form-control" placeholder="<?php echo "{$_SESSION['forename']}"; ?>" value="<?php echo "{$_SESSION['forename']}"; ?>">

					</div>
					<div class="form-group">
						<input type="text" name="surname" class="form-control" placeholder="<?php echo "{$_SESSION['surname']}"; ?>" value="<?php echo "{$_SESSION['surname']}"; ?>">

					</div>
					<div class="modal-footer">
						<div class="form-group">
							<input type="submit" name="btnEditUser" class="btn btn-dark btn-block" value="Save Changes" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!--  =========================
=====    Modal License Details   =======
	=========================== -->


<div class="modal fade" id="license" tabindex="-1" role="dialog" aria-labelledby="license" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Change Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="includes/edit.php" method="post">
					<input type="hidden" id="userId" name="user_id" value="<?php echo "{$_SESSION['user_id']}"; ?>">
					<div class="form-group">
						<h6>DVLA Check Code</h6>
						<input type="text" name="check_code" class="form-control" placeholder="<?php echo "{$_SESSION['check_code']}"; ?>" value="<?php echo "{$_SESSION['check_code']}"; ?>">

					</div>
					<div class="form-group">
						<h6>License Expiry Date</h6>
						<input id="datefield" type="date" min="<?php echo date('Y-m-d'); ?>" name="license_expiry" class="form-control" placeholder="<?php echo "{$_SESSION['license_expiry']}"; ?>" value="<?php echo "{$_SESSION['license_expiry']}"; ?>">

					</div>
					<div class="modal-footer">
						<div class="form-group">
							<input type="submit" name="btnEditUser" class="btn btn-dark btn-block" value="Save Changes" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--  =============================
=====    Modal Change Password   =======
	=================================== -->


<div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="password" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Change Password</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="includes/change-password.php" method="post">
					<div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="Confirm Email" value="<?php if (isset($_POST['email'])) {
																														echo $_POST['email'];
																													} ?>" required>

					</div>
					<div class="form-group">
						<input type="password" name="pass1" class="form-control" placeholder="New Password" value="<?php if (isset($_POST['pass1'])) {
																														echo $_POST['pass1'];
																													} ?>" required>

					</div>
					<div class="form-group">
						<input type="password" name="pass2" class="form-control" placeholder="Confirm New Password" value="<?php if (isset($_POST['pass2'])) {
																																echo $_POST['pass2'];
																															} ?>" required>

					</div>
					<div class="modal-footer">
						<div class="form-group">
							<input type="submit" name="btnChangePassword" class="btn btn-dark btn-block" value="Save Changes" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!--  =========================
=====    Modal Edit Details   =======
	=========================== -->


<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="details" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Change Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="includes/edit.php" method="post">
					<input type="hidden" id="userId" name="user_id" value="<?php echo "{$_SESSION['user_id']}"; ?>">
					<div class="form-group">
						<input type="text" name="forename" class="form-control" placeholder="<?php echo "{$_SESSION['forename']}"; ?>" value="<?php echo "{$_SESSION['forename']}"; ?>">

					</div>
					<div class="form-group">
						<input type="text" name="surname" class="form-control" placeholder="<?php echo "{$_SESSION['surname']}"; ?>" value="<?php echo "{$_SESSION['surname']}"; ?>">

					</div>
					<div class="modal-footer">
						<div class="form-group">
							<input type="submit" name="btnEditUser" class="btn btn-dark btn-block" value="Save Changes" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>




<?php

if ($_SESSION['account_status'] == 1) {
	alert("Account awating approval, you may book once your account has been approved.");
}

function alert($msg)
{
	echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>