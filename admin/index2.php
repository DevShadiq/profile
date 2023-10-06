<?php ob_start();
session_start();
/*
if($_SESSION['adminlogin'] != true){
	header('Location:../login.php');
}*/

$title = "Admin panel";
include('../connect.php');
include('header.php');
include('navbar.php');
?>

 <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">         
			  <div class="row">
			  <!--
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-success color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"> </h2>
                                <div class="m-b-5">Total Products</div><i class="ti-shopping-cart widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
					
					<div class="col-lg-3 col-md-6">
                        <div class="ibox bg-info color-white widget-stat">
                            <div class="ibox-body">
        <h2 class="m-b-5 font-strong"></h2><div class="m-b-5">Total Categories</div><i class="fa fa-bars widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
					
					<div class="col-lg-3 col-md-6">
                        <div class="ibox color-white widget-stat" style="background:#1aa780;">
                            <div class="ibox-body">
        <h2 class="m-b-5 font-strong"></h2><div class="m-b-5">Total Brands</div><i class="fa fa-modx widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
					
					
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox color-white widget-stat" style="background:#9547ff;">
                            <div class="ibox-body">
        <h2 class="m-b-5 font-strong"></h2><div class="m-b-5">Total Sections</div><i class="fa fa-puzzle-piece widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
					
					 
					
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-warning color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"></h2>
                                <div class="m-b-5">Total Suppliers</div><i class="fa fa-building widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-danger color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"></h2>
                                <div class="m-b-5">Total Customers</div><i class="fa fa-user-plus widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
					
				<div class="col-lg-3 col-md-6">
                        <div class="ibox color-white widget-stat" style="background:#ff4000;">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"></h2>
                                <div class="m-b-5">Total Stockin</div><i class="fa fa-shopping-cart widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>	
			
            <div class="col-lg-3 col-md-6">
                        <div class="ibox color-white widget-stat" style="background:#e42d91;">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"></h2>
                                <div class="m-b-5">Total Stockout</div><i class="fa fa-shopping-cart widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>	
					
			<div class="col-lg-3 col-md-6">
                        <div class="ibox color-white widget-stat" style="background:#244883;">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"></h2>
                                <div class="m-b-5">Total Damage</div><i class="fa fa-shopping-cart widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>
			
         <div class="col-lg-3 col-md-6">
                        <div class="ibox color-white widget-stat" style="background:#83b799;">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"></h2>
                                <div class="m-b-5">Total Users</div><i class="fa fa-user widget-stat-icon"></i>
                            </div>
                        </div>
                    </div>

-->
			
					
                </div>
   </div>
 </div> 
 <?php
include('footer.php');
?>			
			
          