<?php ob_start();
session_start();

include('../path.php');

if ($_SESSION['login'] != true) {
	header('Location:../../login.php');
} else {


	$title = "Add Personal Profile User";

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

						$imageDirectory = '../profile/img/';
						$documentDirectory = '../profile/doc/';
						if ($_SERVER['REQUEST_METHOD'] == 'POST') {

							$p_per_name  = $_POST['p_per_name'];
							$p_desig  = $_POST['p_desig'];
							$p_perconten  = $_POST['p_perconten'];
							$slug = uniqid();
							$p_per_name         = $conn->real_escape_string($p_per_name);
							$p_desig         = $conn->real_escape_string($p_desig);
							$p_perconten         = $conn->real_escape_string($p_perconten);

							// $file_name = $_FILES['per_image']['name'];
							// $file_size = $_FILES['per_image']['size'];
							// $file_temp = $_FILES['per_image']['tmp_name'];
							// if ($file_name == '') {
							// 	$upload_img  = 'profile/demo.png';
							// } else {
							// 	$upload_img = 'profile/' . $file_name;
							// }
							//Doc Upload Directory
							$imageDirectory = '../profile/img/';
							$documentDirectory = '../profile/doc/';
							// Handle image file
							$imageFile = $_FILES['per_image']['name'];
							$imageTemp = $_FILES['per_image']['tmp_name'];

							// Handle doc file
							$documentFile = $_FILES['per_cv']['name'];
							$documentTemp = $_FILES['per_cv']['tmp_name'];


							$check_sql = "select * from pro_personal_info where per_name = '$p_per_name' and per_content  ='$p_perconten'";
							$check_result = $conn->query($check_sql);
							$check_count = $check_result->num_rows;

							if ($check_count == 0) {

								$pro_per_sql = "insert into pro_personal_info(per_name, per_designation, per_image, per_cv, per_content, per_slug)
								values('$p_per_name','$p_desig', '$imageFile', '$documentFile','$p_perconten','$slug')";

								$user_result = $conn->query($pro_per_sql);

								if ($user_result) {

									//move_uploaded_file($file_temp, '../' . $upload_img);
									//move_uploaded_file($file_temp, '../' . $upload_cv);

									move_uploaded_file($imageTemp, $imageDirectory . $imageFile);

									move_uploaded_file($documentTemp, $documentDirectory . $documentFile);

									echo '<div class="alert alert-success alert-dismissable mb-4 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Portfolio Information submitted successfully</div>';
								} else {
									echo '<div class="alert alert-danger alert-dismissable mb-4 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Portfolio Information not submitted </div>';
								}
							} else {

								echo '<div class="alert alert-danger alert-dismissable mb-4 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Portfolio Information already exists</div>';
							}
						}

						?>
					</div>

					<div class="card form">
						<div class="card-header">
							<i class="fa fa-plus" aria-hidden="true"></i> Add Portfolio User
						</div>

						<div class="card-body student2 pl-4 pr-4">
							<form action="" method="post" charset="utf-8" data-parsley-validate="" enctype="multipart/form-data">
								<div class="form-row">

									<div class="form-group col-md-6">
										<label for="p_per_name">Profile Name &nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
										<input type="text" class="form-control" id="p_per_name" placeholder="Enter name" name="p_per_name" value="<?php if (isset($p_per_name)) {
																																						echo $p_per_name;
																																					} ?>" data-parsley-trigger="change" data-parsley-required autocomplete>
									</div>

									<div class="form-group col-md-6">
										<label for="p_desig">Designation</label>
										<input type="text" class="form-control" id="p_desig" placeholder="Enter Designation" name="p_desig" value="<?php if (isset($p_desig)) {
																																						echo $p_desig;
																																					} ?>" autocomplete>
									</div>
									<div class="form-group col-md-6">
										<label for="per_image">Profile Image</label>
										<input type="file" name="per_image" class="form-control" id="per_image" style="line-height:1.1;">
									</div>

									<div class="form-group col-md-6">
										<label for="per_cv">Upload CV</label>
										<input type="file" name="per_cv" class="form-control" id="per_cv" style="line-height:1.1;">
									</div>


									<div class="form-group col-md-12">
										<label for="aboutme">Descriptions &nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
										<textarea type="textarea" class="form-control" id="aboutme" placeholder="Enter Description" name="p_perconten"></textarea>
									</div>
									<!-- <div class="form-group col-md-6">
										<label for="u_role">User Role&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
										<select class="form-control" name="u_role" data-parsley-required style="font-size:14px;color:#868e96;">
											<option value="" style="font-size:14px;">Select Role</option>
											<option <?php if (isset($u_role) && $u_role == 'superadmin') {
														echo 'selected';
													} ?> value="super admin" style="font-size:14px;">Super Admin</option>
											<option <?php if (isset($u_role) && $u_role == 'admin') {
														echo 'selected';
													} ?> value="admin" style="font-size:14px;">Admin</option>
											<option <?php if (isset($u_role) && $u_role == 'editor') {
														echo 'selected';
													} ?> value="editor" style="font-size:14px;">Editor</option>
										</select>

									</div> -->

									<!-- <div class="form-group col-md-6">
										<label for="u_status">User Status&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
										<select class="form-control" name="u_status" data-parsley-required style="font-size:14px;color:#868e96;">
											<option value="" style="font-size:14px;">Select Status</option>
											<option <?php if (isset($u_role) && $u_role == 'superadmin') {
														echo 'selected';
													} ?> value="active" style="font-size:14px;">Active</option>
											<option <?php if (isset($u_role) && $u_role == 'admin') {
														echo 'selected';
													} ?> value="inactive" style="font-size:14px;">Inactive</option>
										</select>

									</div> -->


								</div>
								<div class="form-row mt-3">
									<div class="form-group col-md-2 id-btn">
										<button type="submit" class="btn btn-sm btn-block" name="submit" style="font-family: 'Poppins', sans-serif;font-size:16px;
	font-weight:500;">Add User</button>
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
							<div class="ibox-title"> Portfolio Users</div>
						</div>
						<div class="ibox-body data">
							<table class="table table-bordered" id="example-table" cellspacing="0" width="100%">
								<thead>
									<tr class="text-center" style="font-size:15px;text-align:center !important;">
										<th>Image</th>
										<th>Name</th>
										<th>Designation</th>
										<th>Descriptions</th>
										<th>CV</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$pro_per_sql = "select * from pro_personal_info order by per_id desc";
									$user_result = $conn->query($pro_per_sql);
									while ($pro_personal_row = $user_result->fetch_assoc()) {
									?>
										<tr class="text-center" style="font-size:15px;">
											<td>

												<img src="<?php echo $imageDirectory . $pro_personal_row['per_image'] ?>" width="50" height="50">


											</td>

											<td><?php echo $pro_personal_row['per_name']; ?></td>
											<td><?php echo $pro_personal_row['per_designation']; ?></td>
											<td><?php echo $pro_personal_row['per_content']; ?></td>
											<td> <a href="<?php echo $documentDirectory . $pro_personal_row['per_cv']; ?>" class="btn">download CV</a></td>



											<td>
												<a href="edit.php?u=<?php echo $pro_personal_row['per_slug'] ?>" class="" style="color:#ffffff;font-weight:bold;background: linear-gradient(90deg,#ef3e0f,#ffb800);padding:1px 5px;border-radius:4px;" data-toggle="tooltip" data-placement="top" title="Edit User"><i class="fa fa-pencil" aria-hidden="true"></i></a>

												<a data-toggle="modal" data-target="#personalpp<?php echo $pro_personal_row['per_slug'] ?>" class="" style="color:#ffffff;font-weight:bold;background: linear-gradient(to right, #ff416c, #ff4b2b);padding:1px 5px;border-radius:4px;"><i class="fa fa-trash" aria-hidden="true"></i></a>

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