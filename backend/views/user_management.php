<?php

$module_id=2;
include '../common/sessionhandling.php';
$role_id=$userinfo['role_id'];
include '../common/dbconnection.php';
include '../model/usermodel.php';
include '../common/functions.php';

$role_id=$userinfo['role_id'];

$countm=checkModuleRole($module_id, $role_id);
 if($countm==0){ //to check user previlages
   $msg=base64_encode("You dont have permission to access to this Module");
   header("Location:../views/login.php?msg=$msg");
 }
$obuser=new user();
 $resultn=$obuser->viewAllUser();
 $nor=$resultn->rowCount();

 ?>

<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Advanced Tables | Okler Themes | Porto-Admin</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="../assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="../assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="../assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="../assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="../assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="../assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="../assets/vendor/modernizr/modernizr.js"></script>

		<script src="../js/iziToast.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="../css/iziToast.min.css">

	</head>
	<body>
	<?php 
              if(isset($_GET['msg'])){

                $message=$_GET['msg'];
                $order_id=$_REQUEST['order_id'];

                if($message==1)

                  echo "<script type='text/javascript'>iziToast.success({
					title: 'Success!',
					message: 'User Added Successfully',
				});</script>";
                }


                ?>
		<section class="body">

			<!-- start: header -->
			<?php include ('../common/top-nav.php') ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include ('../common/side-nav.php') ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Advanced Tables</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Tables</span></li>
								<li><span>Advanced</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->

						
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<h2 class="panel-title">Basic with Table Tools</h2>
							</header>
							<div class="panel-body">
                            <div>
            <a href="../views/add_user.php" >
              <button type="button" class="btn btn-info">
               <i class="fas fa-utensils"></i>
               Add User
             </button>
           </a>
         </div>
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="../assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
                                        <th>User Image</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Role</th>
                <th>Status</th>

                <th>Action</th>
                <th></th>
										</tr>
									</thead>
									<tbody>

                                    <?php while($row=$resultn->fetch(PDO::FETCH_BOTH)) { 
                if($row['user_image']==""){
                  $uimage="../images/user_icon.png";
                }else{
                  $uimage="../images/user_images/".$row['user_image'];
                }




                ?>
										<tr class="gradeX">
                                        <td><img src="<?php echo $uimage; ?>" class="style1" width="50px" height="50px" /></td>
                  <td><?php echo $row['user_id'];?></td>
                  <td><?php echo $row['user_fname']." ".$row['user_lname']; ?></td>
                  <td><?php echo $row['user_gender']; ?> </td>
                  <td><?php echo $row['role_name'];?></td>
                  <td><?php echo $row['user_status']; ?></td>
                  <td>
                    <a href="../views/update_user.php?user_id=<?php echo $row ['user_id']; ?>">
                      <button type="button" class="btn btn-primary">Update</button>
                    </a>


                    <?php
                         if($row['user_status']== "Active"){
                  $status=1;
                  $sname="Deactivate";
                  $style="danger";
                }  else {
                  $status=0;
                  $sname="Activate";
                  $style="success";
                } ?>

                <?php if($userinfo['user_id']!==$row['user_id']){ ?>
                    <a href="../controller/usercontroller.php?user_id=<?php echo $row ['user_id'];?>&status=<?php echo $status;?>&action=ACDAC&page=<?php echo $page;?>">
                      <button type="button" class="btn btn-<?php echo $style; ?>" onclick="return confirmation('<?php echo $sname;?>')">
                        <?php  echo $sname; ?>
                      </button>
                    </a>

                  <?php }?>


                    

                  </td>
                  <td> </td>
										</tr>
                                        <?php } ?>
									</tbody>
								</table>
							</div>

							
						</section>
						

					<!-- end: page -->
				</section>
			</div>

			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="#" class="mobile-close visible-xs">
							Collapse <i class="fa fa-chevron-right"></i>
						</a>
			
						<div class="sidebar-right-wrapper">
			
							<div class="sidebar-widget widget-calendar">
								<h6>Upcoming Tasks</h6>
								<div data-plugin-datepicker data-plugin-skin="dark" ></div>
			
								<ul>
									<li>
										<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
										<span>Company Meeting</span>
									</li>
								</ul>
							</div>
			
							<div class="sidebar-widget widget-friends">
								<h6>Friends</h6>
								<ul>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
								</ul>
							</div>
			
						</div>
					</div>
				</div>
			</aside>
		</section>

		<!-- Vendor -->
		<script src="../assets/vendor/jquery/jquery.js"></script>
		<script src="../assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="../assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="../assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="../assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="../assets/vendor/select2/select2.js"></script>
		<script src="../assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="../assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="../assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="../assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="../assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="../assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="../assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="../assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="../assets/javascripts/tables/examples.datatables.tabletools.js"></script>
				<!-- Examples -->
				<script src="assets/javascripts/ui-elements/examples.notifications.js"></script>
	</body>
</html>