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
		$skillid = $_GET['u'];
	} ?>


	<div class="content-wrapper">
		<!-- START PAGE CONTENT-->
		<div class="page-content fade-in-up">
			<div class="row justify-content-md-center">
				<div class="col-md-8">
					<div>
						<?php
						if ($_SERVER['REQUEST_METHOD'] == 'POST') {

							$u_skilltitle  = $_POST['u_skilltitle'];
							$u_skillcontent  = $_POST['u_skillcontent'];
							$u_status  = $_POST['u_status'];

							$u_skilltitle         = $conn->real_escape_string($u_skilltitle);
							$u_skillcontent         = $conn->real_escape_string($u_skillcontent);
							$u_status        = $conn->real_escape_string($u_status);




							$update_sc = "update pro_skill
           set
		   skill_title      = '$u_skilltitle',		
		   skill_content    = '$u_skillcontent',		   
		   skill_status   = '$u_status'
		   where skill_slug    = '$skillid'";

							$update_result = $conn->query($update_sc);

							if ($update_result) {
								echo '<div class="alert alert-success alert-dismissable mb-3 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> User skill updated successfully !!</div>';
								echo "<meta http-equiv='refresh' content='3, URL=index.php'>";
							} else {
								echo '<div class="alert alert-danger alert-dismissable mb-3 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> User skill not updated !!</div>';
							}
						}

						?>
					</div>
					<div class="card form">
						<div class="card-header">
							<i class="fa fa-plus" aria-hidden="true"></i> Edit User
						</div>
						<?php
						$edit_sql = "select * from pro_skill where skill_slug = '$skillid'";
						$edit_result = $conn->query($edit_sql);
						while ($edit_row = $edit_result->fetch_assoc()) { ?>
							<div class="card-body student2 pl-4 pr-4">
								<form action="" method="post" charset="utf-8" data-parsley-validate="" enctype="multipart/form-data">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="u_skilltitle">skillerience Title &nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
											<input type="text" class="form-control" id="u_skilltitle" placeholder="Enter skillerience Title" name="u_skilltitle" value="<?php if (isset($edit_row['skill_title'])) {
																																											echo $edit_row['skill_title'];
																																										} ?>" data-parsley-trigger="change" data-parsley-required autocomplete>
										</div>



										<div class="form-group col-md-6">
											<label for="u_skillcontent">skillerience Content&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
											<input type="text" class="form-control" id="u_skillcontent" placeholder="skillerience Content" name="u_skillcontent" value="<?php if (isset($edit_row['skill_content'])) {
																																											echo $edit_row['skill_content'];
																																										} ?>" data-parsley-trigger="change" data-parsley-required autocomplete data-parsley-length="[1, 4]">
										</div>

										<div class="form-group col-md-6">
											<label for="u_status">status&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
											<select class="form-control" name="u_status" data-parsley-required style="font-size:14px;color:#868e96;">
												<option value="" style="font-size:14px;">Select Status</option>
												<option <?php if (isset($edit_row['skill_status']) && $edit_row['skill_status'] == 'active') {
															echo 'selected';
														} ?> value="active" style="font-size:14px;">Active</option>
												<option <?php if (isset($edit_row['skill_status']) && $edit_row['skill_status'] == 'pending') {
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