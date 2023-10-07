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
		$perid = $_GET['u'];
	} ?>




	<div class="content-wrapper">
		<!-- START PAGE CONTENT-->
		<div class="page-content fade-in-up">
			<div class="row justify-content-md-center">
				<div class="col-md-8">
					<div>
						<?php
						$imageDirectory = '../profile/img/';
						$documentDirectory = '../profile/doc/';
						if ($_SERVER['REQUEST_METHOD'] == 'POST') {
							$p_pername  = $_POST['p_pername'];
							$p_perdesig  = $_POST['p_perdesig'];
							$p_descontent  = $_POST['p_descontent'];
							$p_pername         = $conn->real_escape_string($p_pername);
							$p_perdesig         = $conn->real_escape_string($p_perdesig);
							$p_descontent         = $conn->real_escape_string($p_descontent);


							//Doc Upload Directory
							$imageDirectory = '../profile/img/';
							$documentDirectory = '../profile/doc/';
							// Handle image file
							$imageFile = $_FILES['per_image']['name'];
							$imageTemp = $_FILES['per_image']['tmp_name'];

							// Handle doc file
							$documentFile = $_FILES['per_cv']['name'];
							$documentTemp = $_FILES['per_cv']['tmp_name'];




							if ($imageFile == '') {
								$sql1 = "select * from pro_personal_info where per_slug = '$perid'";
								$result1 = $conn->query($sql1);
								$row1 = $result1->fetch_assoc();
								$imageFile = $row1['per_image'];
							} else {
								$imageFile = $imageFile;
								move_uploaded_file($imageTemp, $imageDirectory . $imageFile);
							}

							if ($documentFile == '') {

								$sql1 = "select * from pro_personal_info where per_slug = '$perid'";
								$result1 = $conn->query($sql1);
								$row1 = $result1->fetch_assoc();
								$documentFile = $row1['per_cv'];
							} else {
								$documentFile = $documentFile;
								move_uploaded_file($documentTemp, $documentDirectory . $documentFile);
							}



							$update_sc = "update pro_personal_info
           set
		   per_name      = '$p_pername',
		   per_designation  = '$p_perdesig',
		   per_content    = '$p_descontent',
		   per_image     = '$imageFile',
		   per_cv   = '$documentFile'
		   where per_slug    = '$perid'";

							$update_result = $conn->query($update_sc);



							if ($update_result) {





								echo '<div class="alert alert-success alert-dismissable mb-3 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Profile Data updated successfully !!</div>';
								echo "<meta http-equiv='refresh' content='3, URL=index.php'>";
							} else {
								echo '<div class="alert alert-danger alert-dismissable mb-3 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Profile Data not updated !!</div>';
							}
						}

						?>
					</div>

					<div class="card form">
						<div class="card-header">
							<i class="fa fa-plus" aria-hidden="true"></i> Edit User
						</div>
						<?php
						$edit_sql = "select * from pro_personal_info where per_slug = '$perid'";
						$edit_result = $conn->query($edit_sql);
						while ($edit_row = $edit_result->fetch_assoc()) { ?>
							<div class="card-body student2 pl-4 pr-4">
								<form action="" method="post" charset="utf-8" data-parsley-validate="" enctype="multipart/form-data">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="p_pername">Name&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
											<input type="text" class="form-control" id="p_pername" placeholder="Enter name" name="p_pername" value="<?php if (isset($edit_row['per_name'])) {
																																						echo $edit_row['per_name'];
																																					} ?>" data-parsley-trigger="change" data-parsley-required autocomplete>
										</div>

										<div class="form-group col-md-6">
											<label for="p_perdesig">Designation &nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
											<input type="text" class="form-control" id="p_perdesig" placeholder="Enter Designation" name="p_perdesig" value="<?php if (isset($edit_row['per_designation'])) {
																																									echo $edit_row['per_designation'];
																																								} ?>" data-parsley-trigger="change" data-parsley-required autocomplete>

										</div>

										<div class="form-group col-md-6">
											<label for="per_image">Profile Image </label>

											<input type="file" name="per_image" class="form-control" id="per_image" style="line-height:.8;" data-parsley-trigger="change">
										</div>

										<div class="form-group col-md-6">
											<label for="per_cv">Upload CV</label>

											<input type="file" name="per_cv" class="form-control" id="per_cv" style="line-height:.8;" data-parsley-trigger="change">
										</div>

										<div class="form-group col-md-6">
											<img src="<?php echo $imageDirectory . $edit_row['per_image']; ?>" style="padding-left:20px;width:80px;height:60px;">
										</div>


										<div class="form-group col-md-12">
											<label for="p_descontent">Description &nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
											<textarea type="text" class="form-control" id="p_descontent" placeholder="Enter Designation" name="p_descontent"><?php if (isset($edit_row['per_content'])) {
																																									echo $edit_row['per_content'];
																																								} ?>
											</textarea>

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