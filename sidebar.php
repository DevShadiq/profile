<!-- header section starts  -->

<header class="header">
    <?php
    $imageDirectory = './admin/profile/img/';
    $per_sql = "select * from pro_personal_info order by per_id desc limit 1";
    $per_result = $conn->query($per_sql);
    $per_count = $per_result->num_rows;

    if ($per_count == 0) { ?>

        <div class="user"></div>

        <?php } else {

        while ($per_row = $per_result->fetch_assoc()) { ?>
            <div class="user">
                <img src="<?php echo $imageDirectory . $per_row['per_image']; ?>" alt="">
                <h3><?php echo $per_row['per_name']; ?></h3>
                <p><?php echo $per_row['per_designation']; ?></p>
            </div>


    <?php
        }
    }

    ?>

    <nav class="navbar">
        <?php
        $menu_sql = "select * from pro_menu where menu_status = 'active'";
        $menu_result = $conn->query($menu_sql);
        $menu_count = $menu_result->num_rows;

        if ($menu_count == 0) { ?>
            <a href="#"></a>
            <?php
        } else {
            while ($menu_row = $menu_result->fetch_assoc()) {
            ?>
                <a href="#<?php echo $menu_row['menu_link']; ?>"><?php echo $menu_row['menu_name']; ?></a>

        <?php }
        }

        ?>
    </nav>

</header>