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
	<title> - Publish Article</title>
  <base href="../">
  <link rel="shortcut icon" href="images/<?php echo WBFavicon; ?>">
	<link href="cpanel/dist/css/style.css" rel="stylesheet" type="text/css">
  <link type="text/css" rel="stylesheet" href="plugins/loader/waitMe.css">
  <link rel="stylesheet" href="cpanel/vendors/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.css" />
  <link href="cpanel/vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="cpanel/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
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
            <a class="active" href="admin/new-article"><div class="pull-left"><i class="feather icon-edit-1 mr-20"></i><span class="right-nav-text">Publish Article</span></div><div class="clearfix"></div></a>
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
            <a  href="admin/newsletter"><div class="pull-left"><i class="feather icon-mail mr-20"></i><span class="right-nav-text">Create Newsletter</span></div><div class="clearfix"></div></a>
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
            <h5 class="txt-dark">Publish Article</h5>
          </div>

          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
           
            <li><a href="./admin"><span>Dashboard</span></a></li>
            <li class="active"><span>Publish Article</span></li>
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
											<form id="app_frm" action="admin/core/new_blog_post" method="POST" enctype="multipart/form-data" autocomplete="OFF" class="form-horizontal">
                        <div class="form-group">
                          <label class="control-label mb-10 col-sm-2" >Title</label>
                          <div class="col-sm-10">
                            <input placeholder="Enter post title" type="text" class="form-control txt-cap" name="title" required>
                          </div>
                        </div>

												
											

                        <div class="form-group">
                          <label class="control-label mb-10 col-sm-2">Short Description</label>
                        <div class="col-sm-10">
                          <textarea id="short_description" name="description" class="form-control" rows="5" required placeholder="Enter short description (Minimum 150 Characters)"></textarea>
                        </div>
                        </div>


												<div class="form-group">
													<label class="control-label mb-10 col-sm-2">Content</label>
												<div class="col-sm-10">
													<textarea name="content" class="textarea_editor form-control" rows="15" required placeholder="Enter content ..."></textarea>
												</div>
												</div>

                        <div class="form-group">
                          <label class="control-label mb-10 col-sm-2" >Image</label>
                          <div class="col-sm-10">
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                              <div class="form-control" data-trigger="fileinput"> <i class="feather icon-image fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                              <span class="input-group-addon fileupload btn btn-info btn-anim btn-file"><i class="feather icon-upload"></i> <span class="fileinput-new btn-text">Select file</span> <span class="fileinput-exists btn-text">Change</span>
                              <input required type="file" accept="image/*" name="file" required>
                              </span> <a href="#" class="input-group-addon btn btn-danger btn-anim fileinput-exists" data-dismiss="fileinput"><i class="feather icon-trash-2"></i><span class="btn-text"> Remove</span></a>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label mb-10 col-sm-2" >Youtube Video ID</label>
                          <div class="col-sm-10">
                            <input placeholder="*optional* video will be displayed instead of image" type="text" class="form-control" name="y_video">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label mb-10 col-sm-2" >Tags</label>
                          <div class="col-sm-10">
                            	<input name="tags" required type="text" class="form-control" data-role="tagsinput" placeholder="Add Tags"/>
                          </div>
                        </div>

												<div class="form-group mb-0">
													<div class="col-sm-offset-2 col-sm-10">
													  <button type="submit" id="article_btn" name="submit" class="btn btn-danger"><span class="btn-text">Publish Article</span></button>
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
	<script src="cpanel/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
	<script src="cpanel/dist/js/jquery.slimscroll.js"></script>
	<script src="cpanel/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	<script src="cpanel/vendors/bower_components/switchery/dist/switchery.min.js"></script>
	<script src="cpanel/dist/js/dropdown-bootstrap-extended.js"></script>
	<script src="cpanel/dist/js/init.js"></script>
  <script src="plugins/loader/waitMe.js"></script>
  <script src="js/forms.js"></script>
  <script src="cpanel/vendors/bower_components/wysihtml5x/dist/wysihtml5x.min.js"></script>
  <script src="cpanel/vendors/bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.js"></script>
  <script src="cpanel/dist/js/bootstrap-wysuhtml5-data.js"></script>
  <script src="cpanel/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>


</body>

</html>
