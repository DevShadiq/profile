<?php ob_start();
session_start();
include('../path.php');

if ($_SESSION['login'] != true) {
	header('Location:' . $indexpath . '/index.php');
} else {

	$title = "Delete Users";
	include('../../connect.php');




	if (!isset($_GET['deleteid'])) {
		header('Location:index.php');
	} elseif ($_GET['deleteid'] == '') {
		header('Location:index.php');
	} else {
		$deleteid = $_GET['deleteid'];
	}

	$delete_sc_sql = "DELETE FROM admin_user WHERE user_id = '$deleteid'";
	$result_delete_sc = $conn->query($delete_sc_sql);

	if ($result_delete_sc) {

		$_SESSION['error'] = '<div class="alert alert-success alert-dismissable mb-3 text-center"><button type="button" class="close" data-dismiss="alert"aria-hidden="true">&times;</button>Done !! User Data Deleted successfully ! </div>';

		header('location:index.php');
		exit();
	} else {

		$_SESSION['error'] = '<div class="alert alert-success alert-dismissable mb-3 text-center"><button type="button" class="close" data-dismiss="alert"aria-hidden="true">&times;</button>Ups !! User Data not Deleted ! </div>';
		header('location:index.php');
		exit();
	}
}
