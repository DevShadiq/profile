<?php ob_start();
session_start();

include('../path.php');

if($_SESSION['login'] != true){
header('Location:../../login.php');
}else{


$title = "Add User";

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
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	 $u_name  = $_POST['u_name']; 
	 $u_email  = $_POST['u_email']; 
	 $u_username  = $_POST['u_username'];
	 $u_password  = md5($_POST['u_password']); 
	 $u_phone  = $_POST['u_phone']; 
	 $u_role  = $_POST['u_role']; 
	 $u_status  = $_POST['u_status']; 

	 $slug = uniqid();
	
	$u_name         = $conn->real_escape_string($u_name);
	$u_email         = $conn->real_escape_string($u_email);
	$u_username         = $conn->real_escape_string($u_username);
	$u_password         = $conn->real_escape_string($u_password);
	$u_phone         = $conn->real_escape_string($u_phone);
	$u_role         = $conn->real_escape_string($u_role);
	$u_status         = $conn->real_escape_string($u_status);
	
	
	
	
   
   $file_name = $_FILES['u_image']['name']; 
   $file_size = $_FILES['u_image']['size']; 
   $file_temp = $_FILES['u_image']['tmp_name'];
   
   if($file_name == ''){
	   $upload_img  = 'img/user/demo.png';
   }else{
       $upload_img = 'img/user/'.$file_name;
   }               
   
   $check_sql = "select * from admin_user where username = '$u_username'";
   $check_result = $conn->query($check_sql);
   $check_count = $check_result->num_rows;
   
   if($check_count == 0){
	
   $user_sql = "insert into admin_user(name,email,username,password,phone,image,role,status,u_slug)values('$u_name','$u_email','$u_username','$u_password','$u_phone','$upload_img','$u_role','$u_status','$slug')";
   
   $user_result = $conn->query($user_sql);
   
   if($user_result){
	   
	    move_uploaded_file($file_temp, '../'.$upload_img );
	   
	   echo '<div class="alert alert-success alert-dismissable mb-4 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>User information submitted successfully</div>';
	   
   }else{
	   echo '<div class="alert alert-danger alert-dismissable mb-4 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>User information not submitted </div>';
   }
   
   
   
   }else{
	   
	   echo '<div class="alert alert-danger alert-dismissable mb-4 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Username already exit</div>'; 
   }
   
  
  
  
}

?>
			    </div>
			  
	             <div class="card form">
					  <div class="card-header">
						<i class="fa fa-plus" aria-hidden="true"></i> Add User
					  </div>

				   <div class="card-body student2 pl-4 pr-4">
				      <form action="" method="post" charset="utf-8" data-parsley-validate="" enctype="multipart/form-data">
					    <div class="form-row">
					
					      <div class="form-group col-md-6">
						  <label for="u_name">Name&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
						  <input type="text" class="form-control" id="u_name" placeholder="Enter name" name="u_name" value="<?php if(isset($u_name)){echo $u_name;}?>" data-parsley-trigger="change"   data-parsley-required autocomplete>
					      </div>
						  
						  <div class="form-group col-md-6">
						  <label for="u_email">Email</label>
						  <input type="email" class="form-control" id="u_email" placeholder="Enter Email" name="u_email" value="<?php if(isset($u_email)){echo $u_email;}?>" autocomplete>
					      </div>
						  
						  <div class="form-group col-md-6">
						  <label for="username">Username&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
						  <input type="text" class="form-control" id="username" placeholder="Enter Username" name="u_username" data-parsley-trigger="change" data-parsley-required autocomplete>
					      </div>
						  
						  <div class="form-group col-md-6">
						  <label for="u_password">Password&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
						  <input type="password" class="form-control" id="u_password" placeholder="Enter Password" name="u_password" data-parsley-trigger="change"   data-parsley-required autocomplete>
					      </div>
						  
						  <div class="form-group col-md-6">
						  <label for="u_phone">Phone&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
						  <input type="text" class="form-control" id="u_phone" placeholder="Enter Phone Number" name="u_phone" value="<?php if(isset($u_phone)){echo $u_phone;}?>" data-parsley-trigger="keyup"   data-parsley-required autocomplete data-parsley-length="[11, 15]">
					      </div>
						  
	<div class="form-group col-md-6">
	  <label for="u_image">Profile Image</label>
	<input type="file" name="u_image" class="form-control"  id="u_image" style="line-height:1.1;" >
	</div>	
	 
		 <div class="form-group col-md-6">
		  <label for="u_role">User Role&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
		   <select class="form-control" name="u_role" data-parsley-required style="font-size:14px;color:#868e96;">
			   <option value="" style="font-size:14px;">Select Role</option>
			   <option <?php if(isset($u_role) && $u_role == 'superadmin'){echo'selected';}?> value="super admin" style="font-size:14px;">Super Admin</option>
			   <option <?php if(isset($u_role) && $u_role == 'admin'){echo'selected';}?> value="admin" style="font-size:14px;">Admin</option>
			   <option <?php if(isset($u_role) && $u_role == 'editor'){echo'selected';}?> value="editor" style="font-size:14px;">Editor</option>
		   </select>
		 
		</div> 
		
		 <div class="form-group col-md-6">
		  <label for="u_status">User Status&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
		   <select class="form-control" name="u_status" data-parsley-required style="font-size:14px;color:#868e96;">
			   <option value="" style="font-size:14px;">Select Status</option>
			   <option <?php if(isset($u_role) && $u_role == 'superadmin'){echo'selected';}?> value="active" style="font-size:14px;">Active</option>
			   <option <?php if(isset($u_role) && $u_role == 'admin'){echo'selected';}?> value="inactive" style="font-size:14px;">Inactive</option>
		   </select>
		 
		</div>
		
		
		</div>
		<div class="form-row mt-3"> 
			<div class="form-group col-md-2 id-btn">
			  <button type="submit" class="btn btn-sm btn-block" name="submit" style="font-family: 'Poppins', sans-serif;font-size:16px;
	font-weight:500;">Add User</button>
		   </div>
        </div> <!-- button end -->				
						
					  </form>
				   </div>
				 </div>
	          </div>
           </div>
		   
		   
	<div class="row justify-content-md-center">
	    <div class="col-md-12">				
			<div class="ibox">
			<div class="mb-3">		
	<?php
	    if(isset($_SESSION['error'])){
			echo $_SESSION['error'];
			unset($_SESSION['error']);
			echo "<meta http-equiv='refresh' content='5, URL=index.php'>";
		}
	
	  ?>
	  
	
	 </div> 	
			
                    <div class="ibox-head">
                        <div class="ibox-title"> User List</div>
                    </div>
                    <div class="ibox-body data">
                        <table class="table table-bordered" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr class="text-center" style="font-size:15px;text-align:center !important;">
								  <th>Image</th> 
								  <th>Name</th>
								  <th>Phone</th>
								  <th>Username</th>
								  <th>Status</th>
								  <th>Action</th>
								</tr>
                            </thead>
                            
                             <tbody>
			    <?php
				 $user_sql ="select * from admin_user order by user_id desc";
				 $user_result = $conn->query($user_sql);
			     while($user_row = $user_result->fetch_assoc()){
						?>
				
                <tr class="text-center" style="font-size:15px;">
                    
                   <td>
				      <img src="../<?php echo $user_row['image']?>" width="50" height="50">				  
				  </td> 
                    
                  <td><?php echo $user_row['name'];?></td>
                  <td><?php echo $user_row['phone'];?></td>
                  <td><?php echo $user_row['username'];?></td>
                  <td><?php echo $user_row['status'];?></td>
				  
				   <td>

                     <a href="edit.php?u=<?php echo $user_row['u_slug']?>" class="" style="color:#ffffff;font-weight:bold;background: linear-gradient(90deg,#ef3e0f,#ffb800);padding:1px 5px;border-radius:4px;" data-toggle="tooltip" data-placement="top" title="Edit User"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                 
                     <a data-toggle="modal" data-target="#user<?php echo $user_row['user_id']?>" class="" style="color:#ffffff;font-weight:bold;background: linear-gradient(to right, #ff416c, #ff4b2b);padding:1px 5px;border-radius:4px;"><i class="fa fa-trash" aria-hidden="true"></i></a>
						
				  </td>
				
                </tr>
				<?php //include('modal.php');?>
             <?php } ?>   
              </tbody>
                        </table>
                    </div>	
				
	
            </div>
	  
	    </div> 
	  </div>
 <!-- END PAGE CONTENT-->	   
		   
		   
		   
		   
   </div>
  </div>



<?php
include('../footer.php');

}
?>	