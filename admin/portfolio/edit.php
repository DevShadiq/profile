<?php ob_start();
session_start();

include '../path.php';

if ($_SESSION['login'] != true) {
	header('Location:../../login.php');
} else {


	$title = "Edit User";
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
		$portid = $_GET['u'];
	} ?>


	<div class="content-wrapper">
		<!-- START PAGE CONTENT-->
		<div class="page-content fade-in-up">
			<div class="row justify-content-md-center">
				<div class="col-md-8">
					<div>
						<?php
						if ($_SERVER['REQUEST_METHOD'] == 'POST') {
							$u_name  = $_POST['u_name'];
							$u_status  = $_POST['u_status'];
							$u_name         = $conn->real_escape_string($u_name);
							$u_status        = $conn->real_escape_string($u_status);

							$file_name = $_FILES['port_image']['name'];
							$file_size = $_FILES['port_image']['size'];
							$file_temp = $_FILES['port_image']['tmp_name'];

							if ($file_name == '') {
								$sql1 = "select * from pro_portfolio where port_slug = '$portid'";
								$result1 = $conn->query($sql1);
								$row1 = $result1->fetch_assoc();
								$uploaded_image = $row1['port_image'];
							} else {
								$uploaded_image = "img/portfolio/" . $file_name;
								move_uploaded_file($file_temp, '../' . $uploaded_image);
							}

							$update_sc = "update pro_portfolio
           set
		   port_title      = '$u_name',		  
		   port_image     = '$uploaded_image',
		   port_status   = '$u_status'
		   where port_slug    = '$portid'";
							$update_result = $conn->query($update_sc);


							if ($update_result) {
								echo '<div class="alert alert-success alert-dismissable mb-3 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Portfolio updated successfully !!</div>';
								echo "<meta http-equiv='refresh' content='3, URL=index.php'>";
							} else {
								echo '<div class="alert alert-danger alert-dismissable mb-3 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Portfolio not updated !!</div>';
							}
						}

						?>
					</div>

					<div class="card form">
						<div class="card-header">
							<i class="fa fa-plus" aria-hidden="true"></i> Edit User
						</div>
						<?php
						$edit_sql = "select * from pro_portfolio where port_slug = '$portid'";
						$edit_result = $conn->query($edit_sql);
						while ($edit_row = $edit_result->fetch_assoc()) { ?>
							<div class="card-body student2 pl-4 pr-4">
								<form action="" method="post" charset="utf-8" data-parsley-validate="" enctype="multipart/form-data">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="u_name">Name&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
											<input type="text" class="form-control" id="u_name" placeholder="Enter name" name="u_name" value="<?php if (isset($edit_row['port_title'])) {
																																					echo $edit_row['port_title'];
																																				} ?>" data-parsley-trigger="change" data-parsley-required autocomplete>
										</div>

										<div class="form-group col-md-6">
											<label for="u_status">status&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
											<select class="form-control" name="u_status" data-parsley-required style="font-size:14px;color:#868e96;">
												<option value="" style="font-size:14px;">Select Status</option>
												<option <?php if (isset($edit_row['port_status']) && $edit_row['port_status'] == 'active') {
															echo 'selected';
														} ?> value="active" style="font-size:14px;">Active</option>
												<option <?php if (isset($edit_row['port_status']) && $edit_row['port_status'] == 'pending') {
															echo 'selected';
														} ?> value="pending" style="font-size:14px;">Pendig</option>

											</select>

										</div>

										<div class="form-group col-md-6">
											<label for="port_image">Profile Image </label>

											<input type="file" name="port_image" class="form-control" id="port_image" style="line-height:.8;" data-parsley-trigger="change">
										</div>

										<div class="form-group col-md-6">
											<img src="../<?php echo $edit_row['port_image']; ?>" style="padding-left:20px;width:80px;height:60px;">
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