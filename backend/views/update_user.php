<?php

include '../common/sessionhandling.php';
$role_id=$userinfo['role_id'];
include '../common/dbconnection.php';
include '../model/usermodel.php';
include '../common/functions.php';
include '../model/rolemodel.php';


$user_id1 = $_REQUEST['user_id'];//To take the user id of the particular person
$obu=new user();
$resultuser = $obu->viewAUser($user_id1); //to get the specific user details
$rowuser=$resultuser->fetch(PDO::FETCH_BOTH);

$obrole=new role();
$resultrole=$obrole->displayRoles();

?>
<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Basic Forms | Okler Themes | Porto-Admin</title>
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
		<link rel="stylesheet" href="../assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

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
		<section class="body">
		<?php 
              if(isset($_GET['msg'])){

                $message=$_GET['msg'];
                $order_id=$_REQUEST['order_id'];

                if($message==1)

                  echo "<script type='text/javascript'>iziToast.success({
					title: 'Success!',
					message: 'User Updated Successfully',
				});</script>";
                }


                ?>
			<!-- start: header -->
			<?php include ('../common/top-nav.php') ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include ('../common/side-nav.php') ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Basic Forms</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Forms</span></li>
								<li><span>Basic</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
						<div class="row">
							<div class="col-lg-12">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>
						
										<h2 class="panel-title">Form Elements</h2>
									</header>
									<div class="panel-body">
										<form class="form-horizontal form-bordered" action="../controller/usercontroller.php?action=update&user_id=<?php echo $user_id1 ?>" enctype="multipart/form-data" name="RegForm" method="POST">
                                        <div class="form-group">
												<label class="col-md-3 control-label" for="inputPopover">First Name</label>
												<div class="col-md-6">
													<input type="text" required name="user_fname" id="user_fname" placeholder="Click Here" class="form-control" data-toggle="popover" data-placement="top" data-original-title="The Title" data-content="Content goes here..." data-trigger="click" value="<?php echo $rowuser['user_fname']; ?>">
												</div>
                                            </div>
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputPopover">Last Name</label>
												<div class="col-md-6">
													<input type="text" required name="user_lname" id="user_lname" placeholder="Click Here" class="form-control" data-toggle="popover" data-placement="top" data-original-title="The Title" data-content="Content goes here..." data-trigger="click" value="<?php echo $rowuser['user_lname']; ?>">
												</div>
                                            </div>
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputPopover">Date of birth</label>
												<div class="col-md-6">
                                                <input type="date"  required name="user_dob" id="user_dob" placeholder="Date of Birth" class="form-control" max="<?php echo date('Y-m-d');?>" value="<?php echo $rowuser['user_dob']; ?>" />
												</div>
                                            </div>
                                           
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Gender</label>
												<div class="col-md-6">
                                                <input type="radio" name="user_gender" id="male"  class=" " value="Male" <?php echo($rowuser['user_gender']=="Male")?'checked':''; ?>/> Male
                      <input type="radio" name="user_gender" id="female" class=" "  value="Female" <?php echo($rowuser['user_gender']=="Female")?'checked':''; ?>/> Female
												</div>
                                            </div>
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Email</label>
												<div class="col-md-6">
                                                <input required type="text" name="user_email" id="user_email" placeholder="User Email"  value="<?php echo $rowuser['user_email']; ?>" readonly class="form-control" onkeyup="checkEmail(this.value)"/>
												</div>
                                            </div>
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Telephone</label>
												<div class="col-md-6">
                                                <input type="text" required name="user_tel" id="user_tel" placeholder="User Telephone" class="form-control"  value="<?php echo $rowuser['user_tel']; ?>"/>
												</div>
                                            </div>

                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">NIC</label>
												<div class="col-md-6">
                                                <input type="text" required name="user_nic" id="user_nic" placeholder="User NIC" class="form-control" value="<?php echo $rowuser['user_nic']; ?>" />
												</div>
                                            </div>
                                                                                       
											<div class="form-group">
												<label class="col-md-3 control-label">File Upload</label>
												<div class="col-md-6">
                                                <input type="file" required name="user_image" id="user_image" placeholder="User Image" class="form-control" onchange="readURL(this)" />
                                                <?php 
                                                if($rowuser['user_image']==""){
                                                $user_image="../images/user_icon.png";
                                                }else{
                                                $user_image="../images/user_images/".$rowuser['user_image'];
                                                }
                                                ?>
                                                <img id="image_view"  src="<?php echo $user_image; ?>" style="width: 100px"/>
                                                
                                                </div>
											</div>
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">Address</label>
												<div class="col-md-6">
                                                <textarea required name="user_add" id="user_address" class="form-control"><?php echo $rowuser['user_add']; ?></textarea>
												</div>
                                            </div>
                                            
                                            <div class="form-group">
												<label class="col-md-3 control-label" for="inputSuccess">User Role</label>
												<div class="col-md-6">
                                                    <select required name="role_id" id="role_id" class="form-control mb-md">
                                                    <option value="">Select a Role Name</option>
                                                    <?php
                                                    while ($rowrole=$resultrole->fetch(PDO::FETCH_BOTH)){?>
                                                        <option value="<?php echo $rowrole['role_id']?>"  <?php if($rowrole['role_id']==$rowuser['role_id']){ echo "SELECTED";} ?>>

                                                        
                                                        <?php echo $rowrole['role_name']; ?>
                                                    </option>
                                                    <?php }?>
                                                </select>
												</div>
                                            </div>          

                                            
                                        <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary btn-lg btn-block">Update User</button>
										</form>
									</div>
								</section>

					
						
							</div>
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
		<script src="../assets/vendor/jquery-autosize/jquery.autosize.js"></script>
		<script src="../assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="../assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="../assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="../assets/javascripts/theme.init.js"></script>

	</body>
</html>