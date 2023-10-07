<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon.ico">
</head>

<body>

    <?php ob_start();
    session_start();

    if ($_SESSION['login'] != true) {
        header('Location:../login.php');
    } else {

        $title = "Admin panel";
        include('../connect.php');
        include('path.php');
        include('header.php');
        include('navbar2.php');

    ?> <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up text-center">
                <div class="row">
                    <h4> Under Development </h4>
                </div>
            </div>
        </div>
    <?php
        include('footer.php');
    }
    ?>

</body>

</html>