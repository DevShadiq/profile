<?php ob_start();
session_start();

include '../path.php';

if ($_SESSION['login'] != true) {
	header('Location:../../login.php');
} else {


	$title = "Edit Service";
	include('../../connect.php');
	include('../header.php');
	include('../navbar.php');
?>

	<?php
	if (!isset($_GET['u'])) {
		header('Location:index.php');
	} elseif ($_GET['u'] == '') {
		header('Location:index.php');
	} else {
		$serid = $_GET['u'];
	} ?>


	<div class="content-wrapper">
		<!-- START PAGE CONTENT-->
		<div class="page-content fade-in-up">
			<div class="row justify-content-md-center">
				<div class="col-md-8">
					<div>
						<?php
						if ($_SERVER['REQUEST_METHOD'] == 'POST') {

							$u_sertitle  = $_POST['u_sertitle'];
							$u_sericon  = $_POST['u_sericon'];
							$u_sercontent  = $_POST['u_sercontent'];
							$u_status  = $_POST['u_status'];

							$u_sertitle         = $conn->real_escape_string($u_sertitle);
							$u_sericon         = $conn->real_escape_string($u_sericon);
							$u_sercontent         = $conn->real_escape_string($u_sercontent);
							$u_status        = $conn->real_escape_string($u_status);




							$update_sc = "update pro_service
         					  set
								ser_title      = '$u_sertitle',									
								ser_content    = '$u_sercontent',
								ser_icon = '$u_sericon',		   
								ser_status   = '$u_status'
								where ser_slug    = '$serid'";

							$update_result = $conn->query($update_sc);

							if ($update_result) {
								echo '<div class="alert alert-success alert-dismissable mb-3 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> User Service updated successfully !!</div>';
								echo "<meta http-equiv='refresh' content='3, URL=index.php'>";
							} else {
								echo '<div class="alert alert-danger alert-dismissable mb-3 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> User Service not updated !!</div>';
							}
						}

						?>
					</div>
					<div class="card form">
						<div class="card-header">
							<i class="fa fa-plus" aria-hidden="true"></i> Edit User
						</div>
						<?php
						$edit_sql = "select * from pro_service where ser_slug = '$serid'";
						$edit_result = $conn->query($edit_sql);
						while ($edit_row = $edit_result->fetch_assoc()) { ?>
							<div class="card-body student2 pl-4 pr-4">
								<form action="" method="post" charset="utf-8" data-parsley-validate="" enctype="multipart/form-data">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="u_sertitle">Service Title &nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
											<input type="text" class="form-control" id="u_sertitle" placeholder="Enter Service Title" name="u_sertitle" value="<?php if (isset($edit_row['ser_title'])) {
																																									echo $edit_row['ser_title'];
																																								} ?>" data-parsley-trigger="change" data-parsley-required autocomplete>
										</div>


										<div class="form-group col-md-6">
											<label for="u_sericon">Service Content&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
											<input type="text" class="form-control" id="u_sericon" placeholder="Service Content" name="u_sericon" value="<?php if (isset($edit_row['ser_icon'])) {
																																								echo $edit_row['ser_icon'];
																																							} ?>" data-parsley-trigger="change">
										</div>



										<div class="form-group col-md-6">
											<label for="u_sercontent">Service Content&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
											<input type="text" class="form-control" id="u_sercontent" placeholder="Service Content" name="u_sercontent" value="<?php if (isset($edit_row['ser_content'])) {
																																									echo $edit_row['ser_content'];
																																								} ?>" data-parsley-trigger="change">
										</div>

										<div class="form-group col-md-6">
											<label for="u_status">status&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
											<select class="form-control" name="u_status" data-parsley-required style="font-size:14px;color:#868e96;">
												<option value="" style="font-size:14px;">Select Status</option>
												<option <?php if (isset($edit_row['ser_status']) && $edit_row['ser_status'] == 'active') {
															echo 'selected';
														} ?> value="active" style="font-size:14px;">Active</option>
												<option <?php if (isset($edit_row['ser_status']) && $edit_row['ser_status'] == 'pending') {
															echo 'selected';
														} ?> value="pending" style="font-size:14px;">Pending</option>

											</select>

										</div>





									</div>

									<div class="form-row mt-3">
										<div class="form-group col-md-2 id-btn">
											<button type="submit" class="btn btn-sm" name="submit" style="font-family: 'Poppins', sans-serif;font-size:16px;
	font-weight:500;">Update</button>
										</div>
									</div> <!-- button end -->

								</form>
							</div>

						<?php } ?>


					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include('../footer.php');
}
?>