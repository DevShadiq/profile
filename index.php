<?php
include'connect.php';
include'header.php';
include'sidebar.php';
?>
    

<!-- header section ends -->

<div id="menu-btn" class="fas fa-bars"></div>

<!-- theme toggler  -->

<div id="theme-toggler" class="fas fa-moon"></div>

<!-- home section starts  -->

<section class="home" id="home">
<?php
$per_sql2 = "select * from pro_personal_info order by per_id desc limit 1";
$per_result2 = $conn->query($per_sql2);
$per_count2 = $per_result2->num_rows;

if($per_count2 == 0){ ?>

	<div class="content"></div>
	
<?php }else{
	
while($per_row2 = $per_result2->fetch_assoc()){ ?>
	
	 <div class="content">
        <h3><?php echo $per_row2['per_name'];?></h3>
        <p>I am a expert <?php echo $per_row2['per_designation'];?></p>
        <a href="admin/<?php echo $per_row2['per_cv'];?>" class="btn">download CV</a>
    </div>

<?php 
}	
	 
}

?>
   

    <div class="share">
	<?php
	$social_sql = "select * from pro_social order by social_id asc";
	$social_result = $conn->query($social_sql);
	$social_count = $social_result->num_rows;
	if($social_count == 0){ ?>
		
		<a href="" class=""></a>
		
	<?php }else{
		
	while($social_row = $social_result->fetch_assoc()){	?>
	
		<a href="<?php echo $social_row['social_link']?>" class="<?php echo $social_row['social_icon']?>"></a>
		
<?php	}
	
	}
	
	?>
        
        
    </div>

</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <h1 class="heading"> <span>about</span> me </h1>

    <div class="row">

        <div class="box-container">
<?php
$exp_sql = "select * from pro_experience where exp_status = 'active'";
$exp_result = $conn->query($exp_sql);
$exp_count = $exp_result->num_rows;

if($exp_count == 0){ ?>

<div class="box"></div>

<?php }else{  
while($exp_row = $exp_result->fetch_assoc()){ ?>
	

	        <div class="box">
                <h3><?php echo $exp_row['exp_title'];?></h3>
                <p><?php echo $exp_row['exp_content'];?></p>
            </div>
	
	
<?php 
}
}

?>
	
        </div>

<?php
$per_sql3 = "select * from pro_personal_info order by per_id desc limit 1";
$per_result3 = $conn->query($per_sql3);
$per_count3 = $per_result3->num_rows;

if($per_count3 == 0){ ?>

	<div class="content"></div>
	
<?php }else{
	
while($per_row3 = $per_result3->fetch_assoc()){ ?>

	     <div class="content">
            <h3>my name is <span><?php echo $per_row3['per_name'];?></span></h3>
            <p><?php echo $per_row3['per_content'];?></p>
            <a href="#" class="btn">contact me</a>
        </div>

<?php 
}	
	 
}

?>

    </div>

    <div class="row">

        <div class="progress">
		<?php
$skill_sql = "select * from pro_skill where skill_status = 'active' limit 3";
$skill_result = $conn->query($skill_sql);
$skill_count = $skill_result->num_rows;

if($skill_count == 0){ ?>

            <h3></h3>
        
<?php }else{ 
$i=0;
while($skill_row = $skill_result->fetch_assoc()){ 
$i++;

?>

            <h3><?php echo $skill_row['skill_title'];?> <span><?php echo $skill_row['skill_content'];?></span> </h3>
            <div class="bar bar-1-<?php echo $i;?>"><span></span></div>
<?php 

}
} 

?>
 
        </div>
		
        <div class="progress">
		<?php
$skill_sql2 = "select * from pro_skill where skill_status = 'active' limit 3 offset 3";
$skill_result2 = $conn->query($skill_sql2);
$skill_count2 = $skill_result2->num_rows;

if($skill_count2 == 0){ ?>

            <h3></h3>
        
<?php }else{ 
$i=0;
while($skill_row2 = $skill_result2->fetch_assoc()){ 
$i++;

?>

            <h3><?php echo $skill_row2['skill_title'];?> <span><?php echo $skill_row2['skill_content'];?></span> </h3>
            <div class="bar bar-2-<?php echo $i;?>"><span></span></div>
<?php 

}
} 

?>
 
        </div>		

    </div>

</section>

<!-- about section ends -->

<!-- services section starts  -->

<section class="services" id="services">

    <h1 class="heading"> my <span>services</span> </h1>

    <div class="box-container">


<?php
$ser_sql = "select * from pro_service where ser_status = 'active' limit 6";
$ser_result = $conn->query($ser_sql);
$ser_count = $ser_result->num_rows;

if($ser_count == 0){ ?>
	
	 <div class="box">
	  </div>
	  
<?php }else{
while($ser_row = $ser_result->fetch_assoc()){ ?>
	
	    <div class="box">
            <i class="<?php echo $ser_row['ser_icon'];?>"></i>
            <h3><?php echo $ser_row['ser_title'];?></h3>
            <p><?php echo $ser_row['ser_content'];?></p>
        </div>
	
	
<?php }	
	
	
}
?>

       

        
    </div>

</section>

<!-- services section ends -->

<!-- portfolio section starts  -->

<section class="portfolio" id="portfolio">

    <h1 class="heading"> my <span>portfolio</span> </h1>

    <div class="box-container">
<?php
$port_sql = "select * from pro_portfolio where port_status = 'active'";
$port_result = $conn->query($port_sql);
$port_count = $port_result->num_rows;

if($port_count == 0){ ?>
	
	 <div class="box">
	  </div>
	  
<?php }else{
while($port_row = $port_result->fetch_assoc()){ ?>
	
	   <div class="box">
            <img src="admin/<?php echo $port_row['port_image']?>" alt="">
            <div class="content">
                <h3><?php echo $port_row['port_title']?></h3>
            </div>
        </div>  
	
	
<?php }	
	
	
}
?>


       

    </div>

</section>

<!-- portfolio section ends -->

<!-- contact section starts -->

<section class="contact" id="contact">

    <h1 class="heading"> <span>contact</span> me </h1>

<?php
if(isset($_POST['cont_sent'])){
	
	 $cont_name = $_POST['cont_name'];
	 $cont_email = $_POST['cont_email'];
	 $cont_subject = $_POST['cont_subject'];
	 $cont_massege = $_POST['cont_massege'];
	 
	 if($cont_name == '' || $cont_email == '' || $cont_subject == ''){
		 
		 echo '<div class="error-msg danger">This feild is required</div>';
		 
		 
	 }else{
		 
		$ins_sql = "insert into pro_contact(cont_name,cont_email,cont_subject,cont_massege)values('$cont_name',' $cont_email','$cont_subject','$cont_massege')";
       $ins_result = $conn->query($ins_sql);
 
	  if($ins_result){
		  echo '<div class="error-msg success">Massege send successfully</div>';
		  
	  }else{
		 echo '<div class="error-msg danger">Massege not Send.</div>'; 
	  }
		 
	 }
	
	
}

?>


    <form action="" method="post">
        <input type="text" placeholder="your name" class="box" name="cont_name">
        <input type="email" placeholder="your email" class="box" name="cont_email">
        <input type="text" placeholder="subject" class="box" name="cont_subject">
        <textarea class="box" placeholder="your message" id="" cols="30" rows="10" name="cont_massege"></textarea>
        <input type="submit" value="send message" class="btn" name="cont_sent">
    </form>

</section>

<!-- contact section ends -->

<div class="credits"> created by <span>SH.RAKIB</span> | all rights reserved </div>



<?php
include'footer.php';
?>






