<?php ob_start();
session_start();

include('../path.php');

if($_SESSION['login'] != true){
header('Location:../../login.php');
}else{


$title = "Add Social Link";

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
	
	 $icon_name  = $_POST['icon_name']; 
	 $icon_link  = $_POST['icon_link']; 
	 
	 $slug = uniqid();
	
	$icon_name         = $conn->real_escape_string($icon_name);
	$icon_link         = $conn->real_escape_string($icon_link);
	
	
$icon_sql = "insert into pro_social(social_icon,social_link,social_slug)
values('$icon_name','$icon_link','$slug')";
   
   $icon_result = $conn->query($icon_sql);
   
   if($icon_result){
	   
	   echo '<div class="alert alert-success alert-dismissable mb-4 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Information submitted successfully</div>';
	   
   }else{
	   echo '<div class="alert alert-danger alert-dismissable mb-4 text-center"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Information not submitted </div>';
   }
   
 
}

?>
			    </div>
			  
	             <div class="card form">
					  <div class="card-header">
						Add Social Link
					  </div>

				   <div class="card-body student2 pl-4 pr-4">
				      <form action="" method="post" charset="utf-8" data-parsley-validate="" enctype="multipart/form-data">
					    <div class="form-row">
					
					      <div class="form-group col-md-6">
						  <label for="icon_name">Icon Name &nbsp;<span><sup><i class="fa fa-asterisk" aria-hidden="true"></i></sup></span></label>
						  <input type="text" class="form-control" id="icon_name" placeholder="Enter Icon Name" name="icon_name" value="<?php if(isset($icon_name)){echo $icon_name;}?>" data-parsley-trigger="change"   data-parsley-required autocomplete>
					      </div>
						  
						  <div class="form-group col-md-6">
						  <label>Icon Link</label>
						  <input type="text" class="form-control"  placeholder="Enter Icon Link" name="icon_link" value="<?php if(isset($icon_link)){echo $icon_link;}?>" autocomplete>
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
                        <div class="ibox-title"> Social Icon List</div>
                    </div>
                    <div class="ibox-body data">
                        <table class="table table-bordered" id="example-table" cellspacing="0" width="100%">
                            <thead>
                                <tr class="text-center" style="font-size:15px;text-align:center !important;">
								  <th>Icon Name</th> 
								  <th>Icon Link</th>
								  <th>Action</th>
								</tr>
                            </thead>
                            
                             <tbody>
			    <?php
				 $iconlist_sql ="select * from pro_social order by social_id asc";
				 $iconlist_result = $conn->query($iconlist_sql);
			     while($iconlist_row = $iconlist_result->fetch_assoc()){
						?>
				
                <tr class="text-center" style="font-size:15px;">
                  
                  <td><?php echo $iconlist_row['social_icon'];?></td>
                  <td><?php echo $iconlist_row['social_link'];?></td>
                  
				  
				   <td>

                     <a href="edit.php?e=<?php echo $iconlist_row['social_slug']?>" class="" style="color:#ffffff;font-weight:bold;background: linear-gradient(90deg,#ef3e0f,#ffb800);padding:1px 5px;border-radius:4px;" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                 
                     <a data-toggle="modal" data-target="#socail<?php echo $iconlist_row['social_slug']?>" class="" style="color:#ffffff;font-weight:bold;background: linear-gradient(to right, #ff416c, #ff4b2b);padding:1px 5px;border-radius:4px;"><i class="fa fa-trash" aria-hidden="true"></i></a>
						
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