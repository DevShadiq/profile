<?php ob_start();
session_start();

include('../path.php');

if($_SESSION['login'] != true){
header('Location:../../login.php');
}else{


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
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	 $exp_title  = $_POST['exp_title']; 
	 $exp_content  = $_POST['exp_content'];
	 $exp_status  = $_POST['exp_status'];
	 
	 $exp_slug = uniqid();
	
	$exp_title         = $conn->real_escape_string($exp_title);
	$exp_content         = $conn->real_escape_string($exp_content);
	$exp_status         = $conn->real_escape_string($exp_status);
	
	
	
$exp_sql = "insert into pro_experience(exp_title,exp_content,exp_status,exp_slug)
values('$exp_title','$exp_content','$exp_status','$exp_slug')";
   
   $exp_result = $conn->query($exp_sql);
   
   if($exp_result){
	   
	   echo '<div class="alert alert-success alert-dismissable mb-4 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data submitted successfully</div>';
	   
   }else{
	   echo '<div class="alert alert-danger alert-dismissable mb-4 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data not submitted </div>';
   }
   
 
}

?>
			    </div>
			  
	             <div class="card form">
					  <div class="card-header">
						Add Experience
					  </div>

				   <div class="card-body student2 pl-4 pr-4">
				      <form action="" method="post" charset="utf-8" data-parsley-validate="" enctype="multipart/form-data">
					    <div class="form-row">
					
					      <div class="form-group col-md-6">
						  <label for="exp_title">Experience Title &nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
						  <input type="text" class="form-control" id="exp_title" placeholder="Enter Experience Title" name="exp_title" value="<?php if(isset($exp_title)){echo $exp_title;}?>" data-parsley-trigger="change"   data-parsley-required autocomplete>
					      </div>
						  
						  <div class="form-group col-md-6">
						  <label for="exp_content">Experience Content &nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
						  <input type="text" class="form-control"  placeholder="Enter Experience Content" name="exp_content" value="<?php if(isset($exp_content)){echo $exp_content;}?>" autocomplete data-parsley-required>
					      </div>
						  
		<div class="form-group col-md-6">
		  <label for="exp_status">Experience Status&nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
		   <select class="form-control" name="exp_status" data-parsley-required style="font-size:14px;color:#868e96;">
			   <option value="" style="font-size:14px;">Select Status</option>
			   <option <?php if(isset($exp_status) && $exp_status == 'active'){echo'selected';}?> value="active" style="font-size:14px;">Active</option>
			   <option <?php if(isset($exp_status) && $exp_status == 'pending'){echo'selected';}?> value="pending" style="font-size:14px;">Pending</option>
		   </select>
		 
		</div>
						  
						  
		
		</div>
		<div class="form-row mt-3"> 
			<div class="form-group col-md-2 id-btn">
			  <button type="submit" class="btn btn-sm btn-block" name="submit" style="font-family: 'Poppins', sans-serif;font-size:16px;
	font-weight:500;">Add</button>
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
                        <div class="ibox-title">Experience List</div>
                    </div>
                    <div class="ibox-body data">
                        <table class="table table-bordered" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr class="text-center" style="font-size:15px;text-align:center !important;">
								  <th>Experience Title</th> 
								  <th>Experience Content</th>
								  <th>Status</th>
								  <th>Action</th>
								</tr>
                            </thead>
                            
                             <tbody>
			    <?php
				 $exp_sql ="select * from pro_experience";
				 $exp_result = $conn->query($exp_sql);
			     while($exp_row = $exp_result->fetch_assoc()){
						?>
				
                <tr class="text-center" style="font-size:15px;">
                  
                  <td><?php echo $exp_row['exp_title'];?></td>
                  <td><?php echo $exp_row['exp_content'];?></td>
                  <td><?php echo $exp_row['exp_status'];?></td>
				  
				   <td>

                     <a href="edit.php?e=<?php echo $exp_row['exp_slug']?>" class="" style="color:#ffffff;font-weight:bold;background: linear-gradient(90deg,#ef3e0f,#ffb800);padding:1px 5px;border-radius:4px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                 
                     <a data-toggle="modal" data-target="#socail<?php echo $exp_row['exp_slug']?>" class="" style="color:#ffffff;font-weight:bold;background: linear-gradient(to right, #ff416c, #ff4b2b);padding:1px 5px;border-radius:4px;"><i class="fa fa-trash" aria-hidden="true"></i></a>
						
				  </td>
				
                </tr>
		
				
				<?php include('modal.php');?>
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