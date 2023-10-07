<?php ob_start();
session_start();

include('../path.php');

if ($_SESSION['login'] != true) {
	header('Location:../../login.php');
} else {


	$title = "Add Portfolio";

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
							$port_title  = $_POST['port_title'];
							$port_status  = $_POST['port_status'];
							$port_slug = uniqid();
							$port_title         = $conn->real_escape_string($port_title);
							$port_status         = $conn->real_escape_string($port_status);


							// Handle image file
							$imageFile = $_FILES['per_image']['name'];
							$imageTemp = $_FILES['per_image']['tmp_name'];

							if ($imageFile == '') {
								$upload_img  = '';
							} else {
								$upload_img = 'img/portfolio/' . $imageFile;
							}

							$port_sql = "insert into pro_Portfolio( port_title, port_image, port_status, port_slug)
									values('$port_title','$upload_img','$port_status','$port_slug')";

							$port_result = $conn->query($port_sql);

							if ($port_result) {
								move_uploaded_file($imageTemp, '../' . $upload_img);
								echo '<div class="alert alert-success alert-dismissable mb-4 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Portfolio Data submitted successfully</div>';
							} else {
								echo '<div class="alert alert-danger alert-dismissable mb-4 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Portfolio Data not submitted </div>';
							}
						}

						?>
					</div>

					<div class="card form">
						<div class="card-header">
							Add Portfolio
						</div>

						<div class="card-body student2 pl-4 pr-4">
							<form action="" method="post" charset="utf-8" data-parsley-validate="" enctype="multipart/form-data">
								<div class="form-row">

									<div class="form-group col-md-6">
										<label for="port_title">Portfolio Title &nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
										<input type="text" class="form-control" id="port_title" placeholder="Enter Portfolio Title" name="port_title" value="<?php if (isset($port_title)) {
																																									echo $port_title;
																																								} ?>" data-parsley-trigger="change" data-parsley-required autocomplete>
									</div>

									<div class="form-group col-md-6">
										<label for="per_image">Portfolio Image</label>
										<input type="file" name="per_image" class="form-control" id="per_image" style="line-height:1.1;">
									</div>

									<div class="form-group col-md-6">
										<label for="port_status">Portfolio Status&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
										<select class="form-control" name="port_status" data-parsley-required style="font-size:14px;color:#868e96;">
											<option value="" style="font-size:14px;">Select Status</option>
											<option <?php if (isset($port_status) && $port_status == 'active') {
														echo 'selected';
													} ?> value="active" style="font-size:14px;">Active</option>
											<option <?php if (isset($port_status) && $port_status == 'pending') {
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
							<div class="ibox-title">Portfolio List</div>
						</div>
						<div class="ibox-body data">
							<table class="table table-bordered" id="example-table" cellspacing="0" width="100%">
								<thead>
									<tr class="text-center" style="font-size:15px;text-align:center !important;">
										<th>Portfolio Title</th>
										<th>Portfolio Content</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$port_sql = "select * from pro_portfolio order by port_id asc";
									$port_result = $conn->query($port_sql);
									while ($port_row = $port_result->fetch_assoc()) {
									?>
										<tr class="text-center" style="font-size:15px;">
											<td><?php echo $port_row['port_title']; ?></td>
											<td> <img src="../<?php echo $port_row['port_image'] ?>" width="80" height="100">
											</td>
											<td><?php echo $port_row['port_status']; ?></td>
											<td>

												<a href="edit.php?u=<?php echo $port_row['port_slug'] ?>" class="" style="color:#ffffff;font-weight:bold;background: linear-gradient(90deg,#ef3e0f,#ffb800);padding:1px 5px;border-radius:4px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

												<a data-toggle="modal" data-target="#port<?php echo $port_row['port_slug'] ?>" class="" style="color:#ffffff;font-weight:bold;background: linear-gradient(to right, #ff416c, #ff4b2b);padding:1px 5px;border-radius:4px;"><i class="fa fa-trash" aria-hidden="true"></i></a>

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