<?php
session_start();
//Database configuration:
require_once('../db/config.php');
//Website Settings:
require_once('../const/web-info.php');
//Check login session:
require_once('../const/check_session.php');

switch($res) {
case '0':
$_SESSION['reply'] = array (array("warning","You must login first"));
header("location:../login");
break;

case '2':
$_SESSION['reply'] = array (array("warning","Invalid login session"));
header("location:../login");
break;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title> - Newsletter</title>
  <base href="../">
  <link rel="shortcut icon" href="images/<?php echo WBFavicon; ?>">
	<link href="cpanel/dist/css/style.css" rel="stylesheet" type="text/css">
  <link type="text/css" rel="stylesheet" href="plugins/loader/waitMe.css">
  <link rel="stylesheet" href="cpanel/vendors/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.css" />
</head>

<body id="SELECTOR">

	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>

    <div class="wrapper theme-4-active pimary-color-red">

		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					
				</div>
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="dripicons-menu"></i></a>

			</div>

		</nav>

		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				

				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Content</span>
					<i class="zmdi zmdi-more"></i>
          
          <li>
            <a  href="admin/new-article"><div class="pull-left"><i class="feather icon-edit-1 mr-20"></i><span class="right-nav-text">Publish Article</span></div><div class="clearfix"></div></a>
          </li>
          <li>
            <a  href="admin/articles"><div class="pull-left"><i class="feather icon-file-text mr-20"></i><span class="right-nav-text">Manage Article</span></div><div class="clearfix"></div></a>
          </li>
				</li>

				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Newsletter</span>
					<i class="zmdi zmdi-more"></i>
          <li>
            <a  href="admin/subscribers"><div class="pull-left"><i class="feather icon-users mr-20"></i><span class="right-nav-text">Subscribers</span></div><div class="clearfix"></div></a>
          </li>
          <li>
            <a class="active" href="admin/newsletter"><div class="pull-left"><i class="feather icon-mail mr-20"></i><span class="right-nav-text">Create Newsletter</span></div><div class="clearfix"></div></a>
          </li>
				</li>

        <li><hr class="light-grey-hr mb-10"/></li>
        <li class="navigation-header">
          <span>Settings</span>
          <i class="zmdi zmdi-more"></i>
          <li>
            <a  href="admin/blog-settings"><div class="pull-left"><i class="feather icon-settings mr-20"></i><span class="right-nav-text">Blog Settings</span></div><div class="clearfix"></div></a>
          </li>
          <li>
            <a  href="admin/scripts"><div class="pull-left"><i class="feather icon-code mr-20"></i><span class="right-nav-text">Scripts</span></div><div class="clearfix"></div></a>
          </li>

        </li>

        <li><hr class="light-grey-hr mb-10"/></li>
        <li class="navigation-header">
          <span>Account</span>
          <i class="zmdi zmdi-more"></i>
          <li>
            <a  href="admin/profile"><div class="pull-left"><i class="feather icon-user mr-20"></i><span class="right-nav-text">Profile</span></div><div class="clearfix"></div></a>
          </li>
          <li>
            <a  href="logout"><div class="pull-left"><i class="feather icon-power mr-20"></i><span class="right-nav-text">Logout</span></div><div class="clearfix"></div></a>
          </li>

        </li>

			</ul>
		</div>

		<div class="page-wrapper" id="thewraper">
      <div class="container-fluid pt-25">

        <div class="row heading-bg">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Newsletter</h5>
          </div>

          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
           
            <li><a href="./admin"><span>Dashboard</span></a></li>
            <li class="active"><span>Newsletter</span></li>
            </ol>
          </div>

        </div>

        <div class="row">

          <div class="col-sm-12">
							<div class="panel panel-default card-view">
								<div class="panel-wrapper collapse in">
                  <?php require_once('../const/check-reply.php'); ?>
									<div class="panel-body">
										<div class="form-wrap">
											<form id="send_mail" action="admin/core/send_letter" autocomplete="OFF" method="POST" class="form-horizontal">
                        <div class="form-group">
                          <label class="control-label mb-10 col-sm-2" >Subject</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control txt-cap" name="subject" required>
                          </div>
                        </div>

												<div class="form-group">
													<label class="control-label mb-10 col-sm-2">Letter</label>
												<div class="col-sm-10">
                          <textarea required name="letter" class="textarea_editor form-control" rows="15" placeholder="Enter text ..."></textarea>
												</div>
												</div>

												<div class="form-group mb-0">
													<div class="col-sm-offset-2 col-sm-10">
													  <button type="submit" name="submit" value="1" class="btn btn-danger"><span class="btn-text">Send</span></button>
													</div>
												</div>
                      </form>
										</div>
									</div>
								</div>
							</div>
						</div>

        </div>

			</div>





		</div>

    </div>

    <script src="cpanel/vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="cpanel/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<script src="cpanel/dist/js/jquery.slimscroll.js"></script>
	<script src="cpanel/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	<script src="cpanel/vendors/bower_components/switchery/dist/switchery.min.js"></script>
	<script src="cpanel/dist/js/dropdown-bootstrap-extended.js"></script>
	<script src="cpanel/dist/js/init.js"></script>
  <script src="plugins/loader/waitMe.js"></script>
  <script src="js/forms.js"></script>
  <script src="js/newsletter.js"></script>

  <script src="cpanel/vendors/bower_components/wysihtml5x/dist/wysihtml5x.min.js"></script>
  <script src="cpanel/vendors/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.js"></script>
  <script src="cpanel/dist/js/bootstrap-wysuhtml5-data.js"></script>


</body>

</html>
