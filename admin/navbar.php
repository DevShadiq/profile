<?php

$user_id = $_SESSION['userid'];

$pro_sql = "select * from admin_user where user_id = '$user_id'";
$pro_result = $conn->query($pro_sql);

while ($pro_row = $pro_result->fetch_assoc()) {
    $p_name = $pro_row['name'];
    $p_uname = $pro_row['username'];
    $p_phone = $pro_row['phone'];
    $p_role = $pro_row['role'];
    $p_status = $pro_row['status'];
    $p_path = $pro_row['image'];
}
echo  $p_path . $p_name . "Test";
?>


<header class="header">
    <div class="page-brand">
        <a class="link" href="<?php echo $path; ?>/index.php">
            <span class="brand">Admin
                <span class="brand-tip"> Panel</span>
            </span>
            <span class="brand-mini">AP</span>
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
            </li>

        </ul>
        <!-- END TOP-LEFT TOOLBAR-->
        <!-- START TOP-RIGHT TOOLBAR-->

        <ul class="nav navbar-toolbar">
            <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    <img src="../<?php echo $p_path; ?>" style="width:45px; height:45px;" />
                    <span><?php echo $p_uname; ?></span><i class="fa fa-angle-down m-l-5"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="<?php echo $path; ?>/profile.php"><i class="fa fa-user"></i>Profile</a>
                    <a class="dropdown-item" href="<?php echo $path; ?>/logout.php"><i class="fa fa-power-off"></i>Logout</a>
                </ul>
            </li>
        </ul>

        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>
<!-- END HEADER-->
<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">

        <ul class="side-menu metismenu pt-3">
            <li>
                <a href="<?php echo $path; ?>/"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>

                </a>
            </li>

            <li>
                <a href="<?php echo $path; ?>/menu/"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Menu</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $path; ?>/personal/"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Personal Info</span>
                </a>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-user"></i>
                    <span class="nav-label">About</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="<?php echo $path; ?>/experience/">Experience</a>
                    </li>
                    <li>
                        <a href="<?php echo $path; ?>/skill/">Skill</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="<?php echo $path; ?>/service/"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Service</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $path; ?>/portfolio/"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Portfolio</span>
                </a>
            </li>

            <li>
                <a href="<?php echo $path; ?>/contact/"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Contact</span>
                </a>
            </li>



            <li>
                <a href="<?php echo $path; ?>/social/"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Social Link</span>
                </a>
            </li>


            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-user"></i>
                    <span class="nav-label">User</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="<?php echo $path; ?>/user/">add User</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="<?php echo $path; ?>/password.php"><i class="sidebar-item-icon fa fa-key"></i>
                    <span class="nav-label">Change Password</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->