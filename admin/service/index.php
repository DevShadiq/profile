<?php ob_start();
session_start();

include('../path.php');

if ($_SESSION['login'] != true) {
	header('Location:../../login.php');
} else {


	$title = "Add Service";

	include('../../connect.php');
	include('../header.php');
	include('../navbar.php');
?>
	<div class="content-wrapper">
		<!-- START PAGE CONTENT-->
		<div class="page-content fade-in-up">
			<div class="row justify-content-md-center">
				<div class="col-md-11">
					<div>
						<?php
						if ($_SERVER['REQUEST_METHOD'] == 'POST') {

							$ser_title  = $_POST['ser_title'];
							$ser_content  = $_POST['ser_content'];
							$ser_status  = $_POST['ser_status'];
							$ser_icon = $_POST['ser_icon'];

							$ser_slug = uniqid();

							$ser_title         = $conn->real_escape_string($ser_title);
							$ser_content         = $conn->real_escape_string($ser_content);
							$ser_status         = $conn->real_escape_string($ser_status);
							$ser_icon         = $conn->real_escape_string($ser_icon);



							$ser_sql = "insert into pro_service(ser_icon, ser_title,ser_content,ser_status,ser_slug)
							values('$ser_icon', '$ser_title','$ser_content','$ser_status','$ser_slug')";

							$ser_result = $conn->query($ser_sql);

							if ($ser_result) {

								echo '<div class="alert alert-success alert-dismissable mb-4 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Service Data submitted successfully</div>';
							} else {
								echo '<div class="alert alert-danger alert-dismissable mb-4 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Service Data not submitted </div>';
							}
						}

						?>
					</div>

					<div class="card form">
						<div class="card-header">
							Add service
						</div>

						<div class="card-body student2 pl-4 pr-4">
							<form action="" method="post" charset="utf-8" data-parsley-validate="" enctype="multipart/form-data">
								<div class="form-row">

									<div class="form-group col-md-6">
										<label for="ser_title">Service Title &nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
										<input type="text" class="form-control" id="ser_title" placeholder="Enter service Title" name="ser_title" value="<?php if (isset($ser_title)) {
																																								echo $ser_title;
																																							} ?>" data-parsley-trigger="change" data-parsley-required autocomplete>
									</div>

									<div class="form-group col-md-6">
										<label for="ser_icon">Service Icon &nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
										<input type="text" class="form-control" placeholder="Enter service icon" name="ser_icon" value="<?php if (isset($ser_icon)) {
																																			echo $ser_icon;
																																		} ?>" autocomplete data-parsley-required>
									</div>

									<div class="form-group col-md-6">
										<label for="ser_content">Service Content &nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
										<input type="text" class="form-control" placeholder="Enter service Content" name="ser_content" value="<?php if (isset($ser_content)) {
																																					echo $ser_content;
																																				} ?>" autocomplete data-parsley-required>
									</div>


									<div class="form-group col-md-6">
										<label for="ser_status">Service Status&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
										<select class="form-control" name="ser_status" data-parsley-required style="font-size:14px;color:#868e96;">
											<option value="" style="font-size:14px;">Select Status</option>
											<option <?php if (isset($ser_status) && $ser_status == 'active') {
														echo 'selected';
													} ?> value="active" style="font-size:14px;">Active</option>
											<option <?php if (isset($ser_status) && $ser_status == 'pending') {
														echo 'selected';
													} ?> value="pending" style="font-size:14px;">Pending</option>
										</select>

									</div>



								</div>
								<div class="form-row mt-3">
									<div class="form-group col-md-2 id-btn">
										<button type="submit" class="btn btn-sm btn-block" name="submit" style="font-family: 'Poppins', sans-serif;font-size:16px;
	font-weight:500;">Add</button>
									</div>
								</div> <!-- button end -->

							</form>
						</div>
					</div>
				</div>
			</div>


			<div class="row justify-content-md-center">
				<div class="col-md-12">
					<div class="ibox">
						<div class="mb-3">
							<?php
							if (isset($_SESSION['error'])) {
								echo $_SESSION['error'];
								unset($_SESSION['error']);

								echo "<meta http-equiv='refresh' content='5, URL=index.php'>";
							}

							?>


						</div>

						<div class="ibox-head">
							<div class="ibox-title">service List</div>
						</div>
						<div class="ibox-body data">
							<table class="table table-bordered" id="example-table" cellspacing="0" width="100%">
								<thead>
									<tr class="text-center" style="font-size:15px;text-align:center !important;">
										<th>service Title</th>
										<th>service Content</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$ser_sql = "select * from pro_service";
									$ser_result = $conn->query($ser_sql);
									while ($ser_row = $ser_result->fetch_assoc()) {
									?>

										<tr class="text-center" style="font-size:15px;">

											<td><?php echo $ser_row['ser_title']; ?></td>
											<td><?php echo $ser_row['ser_content']; ?></td>
											<td><?php echo $ser_row['ser_status']; ?></td>

											<td>

												<a href="edit.php?u=<?php echo $ser_row['ser_slug'] ?>" class="" style="color:#ffffff;font-weight:bold;background: linear-gradient(90deg,#ef3e0f,#ffb800);padding:1px 5px;border-radius:4px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

												<a data-toggle="modal" data-target="#ser<?php echo $ser_row['ser_slug'] ?>" class="" style="color:#ffffff;font-weight:bold;background: linear-gradient(to right, #ff416c, #ff4b2b);padding:1px 5px;border-radius:4px;"><i class="fa fa-trash" aria-hidden="true"></i></a>

											</td>

										</tr>

										<?php include('modal.php'); ?>
									<?php } ?>
								</tbody>
							</table>
						</div>


					</div>

				</div>
			</div>
			<!-- END PAGE CONTENT-->




		</div>
	</div>



<?php
	include('../footer.php');
}
?>