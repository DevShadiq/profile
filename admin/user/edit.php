<?php ob_start();
session_start();

include '../path.php';

if($_SESSION['login'] != true){
header('Location:../../login.php');
}else{
	
	
$title = "Edit User";
include('../../connect.php');
include('../header.php');
include('../navbar.php');
?>

<?php
if(!isset($_GET['u'])){
	header('Location:index.php');
}elseif($_GET['u'] == ''){
	header('Location:index.php');
}else{
	$userid = $_GET['u'];
} ?>


 <div class="content-wrapper">
      <!-- START PAGE CONTENT-->
      <div class="page-content fade-in-up"> 
           <div class="row justify-content-md-center">
	          <div class="col-md-8">
			    <div>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	$u_name  = $_POST['u_name'];
	$u_email  = $_POST['u_email'];
	$u_phone  = $_POST['u_phone'];
	$u_status  = $_POST['u_status'];
	
	$u_name         = $conn->real_escape_string($u_name);
	$u_email         = $conn->real_escape_string($u_email);
	$u_phone         = $conn->real_escape_string($u_phone);
	$u_status        = $conn->real_escape_string($u_status);


  $file_name = $_FILES['u_image']['name'];
  $file_size = $_FILES['u_image']['size'];
  $file_temp = $_FILES['u_image']['tmp_name'];
  

  if($file_name == ''){
	  
  $sql1 = "select * from admin_user where u_slug = '$userid'";
  $result1 = $conn->query($sql1);
  $row1 = $result1->fetch_assoc();
  $uploaded_image = $row1['image'];
  
  }else{
  $uploaded_image = "img/user/".$file_name;
  move_uploaded_file($file_temp,'../'.$uploaded_image);
  }

  $update_sc ="update admin_user
           set
		   name      = '$u_name',
		   email      = '$u_email',
		   phone    = '$u_phone',
		   image     = '$uploaded_image',
		   status   = '$u_status'
		   where u_slug    = '$userid'";
		   
		$update_result = $conn->query($update_sc);
		
  if($update_result){
		echo '<div class="alert alert-success alert-dismissable mb-3 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>User Data updated successfully !!</div>';
		echo "<meta http-equiv='refresh' content='3, URL=index.php'>";
	}else{
		echo '<div class="alert alert-danger alert-dismissable mb-3 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>User Data not updated !!</div>';
	}
  
 
 
}

?>
			    </div>
			  
	             <div class="card form">
					  <div class="card-header">
						<i class="fa fa-plus" aria-hidden="true"></i> Edit User
					  </div>
	<?php 
  $edit_sql = "select * from admin_user where u_slug = '$userid'";
  $edit_result = $conn->query($edit_sql);
  while($edit_row = $edit_result->fetch_assoc()){?>
				   <div class="card-body student2 pl-4 pr-4">
				      <form action="" method="post" charset="utf-8" data-parsley-validate="" enctype="multipart/form-data">
					    <div class="form-row">
					<div class="form-group col-md-6">
						  <label for="u_name">Name&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
						  <input type="text" class="form-control" id="u_name" placeholder="Enter name" name="u_name" value="<?php if(isset($edit_row['name'])){echo $edit_row['name'];}?>" data-parsley-trigger="change"   data-parsley-required autocomplete>
					      </div>
						  
						  <div class="form-group col-md-6">
						  <label for="u_email">Email&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
						  <input type="email" class="form-control" id="u_email" placeholder="Enter Email" name="u_email" value="<?php if(isset($edit_row['email'])){echo $edit_row['email'];}?>" data-parsley-trigger="change"   data-parsley-required autocomplete>
						  
					      </div>
						
						  <div class="form-group col-md-6">
						  <label for="u_phone">Phone&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
						  <input type="text" class="form-control" id="u_phone" placeholder="Enter Phone Number" name="u_phone" value="<?php if(isset($edit_row['phone'])){echo $edit_row['phone'];}?>" data-parsley-trigger="change"   data-parsley-required autocomplete data-parsley-length="[11, 15]">
					      </div>
						  
		 <div class="form-group col-md-6">
		  <label for="u_status">status&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
		   <select class="form-control" name="u_status" data-parsley-required style="font-size:14px;color:#868e96;">
			   <option value="" style="font-size:14px;">Select Status</option>
			   <option <?php if(isset($edit_row['status']) && $edit_row['status'] == 'active'){echo'selected';}?> value="active" style="font-size:14px;">Active</option>
			   <option <?php if(isset($edit_row['status']) && $edit_row['status'] == 'inactive'){echo'selected';}?> value="inactive" style="font-size:14px;">Inactive</option>
			   
		   </select>
		 
		</div> 	
      
	 <div class="form-group col-md-6">
	  <label for="u_image">Profile Image </label>
	  
	<input type="file" name="u_image" class="form-control"  id="u_image" style="line-height:.8;" data-parsley-trigger="change">
	 </div>	
	 
	     <div class="form-group col-md-6">
		  <img src="../<?php echo $edit_row['image'];?>" style="padding-left:20px;width:80px;height:60px;">
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
	  