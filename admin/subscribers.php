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
	<title> - Subscribers</title>
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
            <a  href="admin/articles"><div class="pull-left"><i class="feather icon-file-text mr-20"></i><span class="right-nav-text">Manage Article</span></div><div class="clearfix"></div></a>
          </li>
				</li>

				<li><hr class="light-grey-hr mb-10"/></li>
				<li class="navigation-header">
					<span>Newsletter</span>
					<i class="zmdi zmdi-more"></i>
          <li>
            <a class="active" href="admin/subscribers"><div class="pull-left"><i class="feather icon-users mr-20"></i><span class="right-nav-text">Subscribers</span></div><div class="clearfix"></div></a>
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
          

          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
           
            <li><a href="./admin"><span>Dashboard</span></a></li>
            <li class="active"><span>Subscribers</span></li>
            </ol>
          </div>

        </div>

<title>Subscribers List</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #f2f2f2;
		}
	</style>


<body>

<?php
// Define the database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";


// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the delete form has been submitted
if (isset($_POST['delete'])) {
	// Retrieve the ID of the subscriber to be deleted
	$id = $_POST['id'];
	// Execute the SQL query to delete the subscriber
	$sql = "DELETE FROM tbl_subscribers WHERE id = $id";
	if ($conn->query($sql) === TRUE) {
	    echo "Subscriber deleted successfully";
	} else {
	    echo "Error deleting subscriber: " . $conn->error;
	}
}

// Prepare and execute the SQL query to retrieve all the data from the table
$sql = "SELECT * FROM tbl_subscribers";
$result = $conn->query($sql);

// Check if any data was returned from the query
if ($result->num_rows > 0) {
	// Create a table to display the subscriber information
	echo '<h2>Subscribers List</h2>';
	echo '<table>';
	echo '<tr><th>Email</th><th>Name</th><th>Phone</th><th>Message</th><th>Date/Time</th><th>Action</th></tr>';

	// Loop through each row of data and display it in the table
	while($row = $result->fetch_assoc()) {
		echo '<tr>';
		echo '<td style="padding-right: 10px;">' . $row['email'] . '</td>';
		echo '<td style="padding-right: 20px;">' . $row['name'] . '</td>';
		echo '<td style="padding-right: 20px;">' . $row['phone'] . '</td>';
		echo '<td>' . $row['message'] . '</td>';
		echo '<td>' . $row['date_time'] . '</td>';
		echo '<td>';
		// Add a form to delete the subscriber
		echo '<form method="post" onsubmit="return confirm(\'Are you sure you want to delete this subscriber?\')">';
		echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
		echo '<input type="submit" name="delete" value="Delete">';
		echo '</form>';
		echo '</td>';
		echo '</tr>';
	}

	echo '</table>';
}
else {
	// Display a message if there are no subscribers in the table
	echo '<p>No subscribers found.</p>';
}

// Close the database connection
$conn->close();
?>
</body>
</html>

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
  <script src="js/categories.js"></script>


</body>

</html>
