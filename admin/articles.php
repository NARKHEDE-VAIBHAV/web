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
	<title> - Manage Articles</title>
  <base href="../">
  <link rel="shortcut icon" href="images/<?php echo WBFavicon; ?>">
	<link href="cpanel/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	<link href="cpanel/dist/css/style.css" rel="stylesheet" type="text/css">
  <link type="text/css" rel="stylesheet" href="plugins/loader/waitMe.css">
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
            <a class="active" href="admin/articles"><div class="pull-left"><i class="feather icon-file-text mr-20"></i><span class="right-nav-text">Manage Article</span></div><div class="clearfix"></div></a>
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
         
        <hr class="light-grey-hr mb-10"/></li>
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

		<div id="cpage" class="page-wrapper">
      <div class="container-fluid pt-25">

        <div class="row heading-bg">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Manage Articles</h5>
          </div>

          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
           
            <li><a href="./admin"><span>Dashboard</span></a></li>
            <li class="active"><span>Manage Articles</span></li>
            </ol>
          </div>

        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="panel panel-default card-view">


              <div class="panel-wrapper collapse in">
                <?php require_once('../const/check-reply.php'); ?>
                <div class="panel-body">

                  <div class="table-wrap">
                    <div class="table-responsive">
                      <table id="datable_1" class="table table-hover display  pb-30" >
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>Publish Date</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          function number_abbr($number)
                          {
                          $abbrevs = [12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => ''];

                          foreach ($abbrevs as $exponent => $abbrev) {
                            if (abs($number) >= pow(10, $exponent)) {
                              $display = $number / pow(10, $exponent);
                              $decimals = ($exponent >= 3 && round($display) < 100) ? 1 : 0;
                              $number = number_format($display, $decimals).$abbrev;
                              break;
                            }
                          }

                          return $number;
                          }

                          try {
                          $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
                          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                          $stmt = $conn->prepare("SELECT * FROM tbl_blog_posts LEFT JOIN tbl_categories ON tbl_blog_posts.category = tbl_categories.id ORDER BY tbl_categories.id DESC");
                          $stmt->execute();
                          $result = $stmt->fetchAll();

                          foreach($result as $row)
                          {
                            
                            $id = $row[0];


                            if (WBCleanURL == "true") {
                              $st1 = preg_replace("/[^a-zA-Z]/", " ", $row[1]);
                              $st2 =  preg_replace('/\s+/', ' ', $st1);
                              $article_title = strtolower(str_replace(' ', '-', $st2));

                              $blog_link = "article/$id/$article_title";
                            }else{
                              $blog_link = "pages/article?key=$id";
                            }
                            ?>
                            <tr>
                              <td><a class="text-primary" href="<?php echo $blog_link; ?>" target="_blank"><?php echo $row[1]; ?></a></td>
                           
                              <td><?php echo $row[2]; ?></td>
                              <td width="170">
                                <a href="admin/edit-article?id=<?php echo $row[0]; ?>" class="btn btn-primary  btn-xs">Edit</a>
                                <a onclick="return confirm('Delete article?');" href="admin/core/drop-article?node=<?php echo $row[0]; ?>&img=<?php echo $row[5]; ?>" class="btn btn-danger  btn-xs">Delete</a>
                              </td>
                            </tr>
                            <?php
                          }
                          }catch(PDOException $e)
                          {
                          echo "Connection failed: " . $e->getMessage();
                          }
                          ?>


                        </tbody>
                      </table>
                    </div>
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
	<script src="cpanel/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="cpanel/dist/js/dataTables-data.js"></script>
	<script src="cpanel/dist/js/jquery.slimscroll.js"></script>
	<script src="cpanel/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	<script src="cpanel/vendors/bower_components/switchery/dist/switchery.min.js"></script>
	<script src="cpanel/dist/js/dropdown-bootstrap-extended.js"></script>
	<script src="cpanel/dist/js/init.js"></script>
  <script src="plugins/loader/waitMe.js"></script>
  <script src="js/forms.js"></script>

</body>

</html>
