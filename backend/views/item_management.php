<?php
$module_id=3;
include '../common/dbconnection.php';
include '../common/functions.php';
include '../common/sessionhandling.php';
include '../model/categorymodel.php';
include '../model/itemmodel.php';

$role_id=$userinfo['role_id'];

$countm=checkModuleRole($module_id, $role_id);
 if($countm==0){ //to check user previlages
   $msg=base64_encode("You dont have permission to access to this Module");
   header("Location:../views/login.php?msg=$msg");
 }


$obitem = new item();
$result = $obitem->viewAllItems();
$obcat=new category;
$resultc=$obcat->displayAllCategory();

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
                if($message==1)

                  echo "<script type='text/javascript'>iziToast.success({
					title: 'Success!',
					message: 'Item Added Successfully',
				});</script>";
                }

                ?>

				
	<?php 
              if(isset($_GET['msg'])){

                $message=$_GET['msg'];
                if($message==3)

                  echo "<script type='text/javascript'>iziToast.success({
					title: 'Success!',
					message: 'Status changed',
				});</script>";
                }

                ?>

<?php 
              if(isset($_GET['msg'])){

                $message=$_GET['msg'];
                if($message==4)

                  echo "<script type='text/javascript'>iziToast.warning({
					title: 'Success!',
					message: 'Item Deleted',
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
            <a href="../views/add_item.php" >
              <button type="button" class="btn btn-info">
               <i class="fas fa-utensils"></i>
               Add Item
             </button>
           </a>
         </div>
								<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="../assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
									<thead>
										<tr>
                                        <th style="height:40px">Item Image &nbsp;</th>
                                        <th style="height:40px">Item Name</th>
                                        <th style="height:40px">Category</th>
                                        <th style="height:40px">Item Price</th>
                                        <th style="height:40px">Status</th>
                                        <th style="height:40px">Action</th>
										</tr>
									</thead>
									<tbody>

                                    <?php
             while ($row = $result->fetch(PDO::FETCH_BOTH)) {

if($row['item_image']==""){
              $cimage="../images/foodwow.png";
            }else{
              $cimage="../images/item_images/".$row['item_image'];
            }

            ?>
										<tr class="gradeX">
                                        <td style="height:45px"><img src="<?php echo $cimage;?>" height="60px" width="80px"></td>
             <td style="height:45px"><?php echo $row['item_name']; ?></td>
             <td style="height:45px"><?php echo $row['cat_name']; ?></td>
             <td style="height:45px"><?php echo $row['item_price']; ?></td>
             <td style="height:45px"><?php echo $row['item_status']; ?></td>
             <td style="height:45px">

              <a href="../views/update_item.php?item_id=<?php echo $row ['item_id']; ?>">
                <button type="button" class="btn btn-primary">Update</button>
              </a>


              <?php if($count==0){ ?>
                <a href="../controller/itemcontroller.php?item_id=<?php echo $row ['item_id'];?>&action=Delete">
                  <button type="button" class="btn btn-warning"  onclick="return confirmation('Delete','A Item')">
                    Delete
                  </button>
                </a>
              <?php } ?>


                               <?php
                         if($row['item_status']== "Available"){
                  $status=1;
                  $sname="Unavailable";
                  $style="danger";
                }  else {
                  $status=0;
                  $sname="Available";
                  $style="success";
                } ?>

       <a href="../controller/itemcontroller.php?item_id=<?php echo $row ['item_id'];?>&status=<?php echo $status;?>&action=ACDAC">
                      <button type="button" class="btn btn-<?php echo $style; ?>" onclick="return confirmation('<?php echo $sname;?>')">
                        <?php  echo $sname; ?>
                      </button>
                    </a>

              

            </td>
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
	</body>
</html>