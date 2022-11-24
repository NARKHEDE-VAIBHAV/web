
<?php
include_once('db.php');
include_once('be.php');

$post_tags = explode(",",$tags);
foreach ($post_tags as $tag) {

}
?>



<!DOCTYPE html>
<html lang="en">
<head>



<base href="http://localhost/templatemo_468_onetel/templatemo_468_onetel/" >
   



	<title>CubiSec - Blog</title>
    <meta name="keywords" content="">
	<meta name="description" content="">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 
CubiSec

-->
	<!-- stylesheet css -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/nivo-lightbox.css">
	<link rel="stylesheet" href="css/nivo_themes/default/default.css">
	<link rel="stylesheet" href="css/keystyle.css">
	<!-- google web font css -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

</head>
<body>
	
<!-- navigation -->

	<div class="container">
		<div class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
			<a href="#" class="navbar-brand"><h3>CubiSec</h3></a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.html">HOME</a></li>
				<li><a href="about.html">ABOUT US</a></li>
				<li><a href="portfolio.html" class="active">PORTFOLIO</a></li>
				<li><a href="contact.html">CONTACT</a></li>
			</ul>
		</div>
	</div>
</div>		

<!-- Blog header section -->
<div id="portfolio-header">
		<div class="container">
			<div class="row">
				<div class="col-md-5 col-sm-3"></div>
				<div class="col-md-7 col-sm-9">
					<h1><?php echo $title; ?></h1>
					<h1><?php echo $post_date; ?></h1>
				</div>
			</div>
		</div>
	</div>

<!-- Blog section -->
<div id="Blog">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-2 col-md-8 col-sm-12">
				<img src="images/blog/<?php echo $media; ?>" class="img-fluid single_blog" alt="">
			</div>
         </div>
	</div>
</div>		
		
	<div class="container">
		<div class="row">
			<div class="col-md-offset-2 col-md-8 col-sm-8">
			<h5><?php echo $cont?></h5>
			<br>
			
	<?php
    $post_tags = explode(",",$tags);
    foreach ($post_tags as $tag) { ?>
	<center><?php echo $tag; ?></center>
	<?php } ?>
	<br>
	<span><center><?php echo $post_views; ?></center></span>
            </div>
         </div>
	</div>


<!-- footer section -->
<footer>
	<div class="container">
		<div class="row">
        
			<div class="col-md-5 col-sm-4">
				<h3>Managed Security Services</h3>
				<p><a href="#">Incident Response & Malware Analysis</a></p>
				<p><a href="#">Security Infrastructure Management</a></p>
				<p><a href="#">Security Event Management</a></p>
				<p>Solution Implementation</p>
				
			</div>

		<div class="col-md-5 col-sm-4">
				<h3>Security Assessment Services</h3>
				<p><a href="#">Vulnerability Assessment</a></p>
				<p><a href="#">Web Application Security</a></p>
				<p><a href="#">Mobile Application Security</a></p>
				<p><a href="#">Penetration Testing Services</a></p>
			</div>
			
            
		</div>
	</div>
</footer>

<!-- copyright section -->


<!-- javascript js -->	
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>	
<script src="js/nivo-lightbox.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>