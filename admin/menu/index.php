<?php ob_start();
session_start();

include('../path.php');

if ($_SESSION['login'] != true) {
	header('Location:../../login.php');
} else {


	$title = "Add Experience";

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
				<h1> Under Development </h1>
	</div>



<?php
	include('../footer.php');
}
?>