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
    if (!isset($_GET['e'])) {
        header('Location:index.php');
    } elseif ($_GET['e'] == '') {
        header('Location:index.php');
    } else {
        $socialid = $_GET['e'];
    } ?>


    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                            $social_icon  = $_POST['social_icon'];
                            $social_link  = $_POST['social_link'];


                            $social_icon         = $conn->real_escape_string($social_icon);
                            $social_link         = $conn->real_escape_string($social_link);








                            $update_sc = "update pro_social
           set
		   social_icon      = '$social_icon',
		   social_link      = '$social_link'		  
		   where social_slug    = '$socialid'";

                            $update_result = $conn->query($update_sc);

                            if ($update_result) {
                                echo '<div class="alert alert-success alert-dismissable mb-3 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Sociala Link Data updated successfully !!</div>';
                                echo "<meta http-equiv='refresh' content='3, URL=index.php'>";
                            } else {
                                echo '<div class="alert alert-danger alert-dismissable mb-3 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Sociala Link Data not updated !!</div>';
                            }
                        }

                        ?>
                    </div>

                    <div class="card form">
                        <div class="card-header">
                            <i class="fa fa-plus" aria-hidden="true"></i> Edit User
                        </div>
                        <?php
                        $edit_sql = "select * from pro_social where social_slug = '$socialid'";
                        $edit_result = $conn->query($edit_sql);
                        while ($edit_row = $edit_result->fetch_assoc()) { ?>
                            <div class="card-body student2 pl-4 pr-4">
                                <form action="" method="post" charset="utf-8" data-parsley-validate="" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="social_icon">Social Icon &nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
                                            <input type="text" class="form-control" id="social_icon" placeholder="Enter name" name="social_icon" value="<?php if (isset($edit_row['social_icon'])) {
                                                                                                                                                            echo $edit_row['social_icon'];
                                                                                                                                                        } ?>" data-parsley-trigger="change" data-parsley-required autocomplete>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="social_link">Socila Link&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
                                            <input type="text" class="form-control" id="social_link" placeholder="Socila Link" name="social_link" value="<?php if (isset($edit_row['social_link'])) {
                                                                                                                                                                echo $edit_row['social_link'];
                                                                                                                                                            } ?>" data-parsley-trigger="change" data-parsley-required autocomplete>

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