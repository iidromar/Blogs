<?php
	session_start();
	$username = $_GET['author'];
	include 'DB_CONFIG.PHP';
	$conf = mysqli_connect(DBHOST,DBUSER,DBPWD,DBNAME);
	$isEmpty = false;
	$isSignedIn = false;
  if(isset($_SESSION['username'])){
    $isSignedIn = true;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>BetaBlogs</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CMuli:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	<!-- HEADER -->
	<header id="header">
		<!-- NAV -->
		<div id="nav">
			<!-- Top Nav -->
			<div id="nav-top">
				<div class="container">
					<!-- social -->
					<ul class="nav-social">
						<li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA"><i class="fa fa-twitter"></i></a></li>
						<li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA"><i class="fa fa-instagram"></i></a></li>
					</ul>
					<!-- /social -->

					<!-- logo -->
					<div class="nav-logo">
						<a href="index.php" class="logo"><img src="./img/logoBeta.png" alt=""></a>
					</div>
					<!-- /logo -->

					<!-- search & aside toggle -->
					<div class="nav-btns">
						<?php
						if(!$isSignedIn){
							echo "<a href='signin.php'><i class='fa fa-user'></i></a>";
						}
						else {
							echo "<a href='signOut.php'><i class='fa fa-sign-out' aria-hidden='true' style='padding-right: 15px;''></i></a>";
							echo "<a href='author.php'><i class='fa fa-user'></i></a>";
						}

						?>
						<button class="search-btn"><i class="fa fa-search"></i></button>
						<button class="aside-btn"><i class="fa fa-bars"></i></button>


						<div id="nav-search">
							<form>
								<input class="input" name="search" placeholder="Enter your search...">
							</form>
							<button class="nav-close search-close">
								<span></span>
							</button>
						</div>
					</div>
					<!-- /search & aside toggle -->
				</div>
			</div>
			<!-- /Top Nav -->

			<!-- Main Nav -->
			<div id="nav-bottom">
				<div class="container">
					<!-- nav -->
					<ul class="nav-menu">
						<li class="has-dropdown">
							<a href="index.php">Home</a>
							<div class="dropdown">
								<div class="dropdown-body">
									<ul class="dropdown-list">
										<li><a href="about.php">About Us</a></li>
										<li><a href="contact.php">Contacts</a></li>
									</ul>
								</div>
							</div>
						</li>
            <li><a href="category.php?cn=Technology">Technology</a></li>
						<li><a href="category.php?cn=Health">Health</a></li>
						<li><a href="category.php?cn=Travel">Travel</a></li>
            <li><a href="category.php?cn=Food">Food</a></li>
					</ul>
					<!-- /nav -->
				</div>
			</div>
			<!-- /Main Nav -->

			<!-- Aside Nav -->
			<div id="nav-aside">
				<ul class="nav-aside-menu">
					<li><a href="index.php">Home</a></li>
					<li class="has-dropdown"><a>Categories</a>
						<ul class="dropdown">
              <li><a href="category.php?cn=Technology">Technology</a></li>
  						<li><a href="category.php?cn=Health">Health</a></li>
  						<li><a href="category.php?cn=Travel">Travel</a></li>
              <li><a href="category.php?cn=Food">Food</a></li>

						</ul>
					</li>
					<li><a href="about.php">About Us</a></li>
					<li><a href="contact.php">Contacts</a></li>

				</ul>
				<button class="nav-close nav-aside-close"><span></span></button>
			</div>
			<!-- /Aside Nav -->
		</div>
		<!-- /NAV -->
		<!-- PAGE HEADER -->
	<div class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-offset-1 col-md-10 text-center">
					<?php
						echo "<h1 class='text-uppercase'>".$username."</h1>";
					 ?>
					<p class="lead">Welcome to my page!</p>
				</div>
			</div>
		</div>
	</div>
	<!-- /PAGE HEADER -->

	</header>
	<!-- /HEADER -->
    <div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8"><?php
            if (isset($_GET['error']))
                echo "<div class='alert alert-danger' role='alert'>" . $_GET['error'] . "</div>";
            if (isset($_GET['success']))
                echo "<div class='alert alert-success' role='alert'>" . $_GET['success'] . "</div>";
            ?></div>
        <div class="col-md-2"></div>
    </div>
    </div>


	<!-- SECTION -->
	<div class="section">
		<div style="margin-left: 5%; margin-right: 5%; width: 90%">
			<div style="float: left; width: 66%; text-align: center;">
				<h2>Latest Blogs</h2>
			</div>
			<div style="float: right; width: 34%; text-align: center;">
				<h2>Statistics</h2>
			</div>
		</div>




		<!-- container -->
		<div class="container" style="margin-left: 5%; margin-right: 5%; width: 90%">
			<!-- row -->
			<div class="row">
				<div class="col-md-8" style="border-right: 1px solid #DDDDDD;">
					<!-- post -->
					<?php

                $query = "SELECT * FROM BLOG WHERE username = '$username' ORDER BY blogDate DESC";
                if (mysqli_connect_errno())
                    die("Cannot connect to database." . mysqli_connect_errno());
                $result = mysqli_query($conf, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                    //for($i = 0; $i < mysqli_num_rows($result); $i++){
                        //$row = mysqli_fetch_assoc($result);
                        $blogID = $row['blogID'];
                        $imgid = $row['imageID'];
                        if ($imgid > 0) {
                            echo "<div class='post post-row'>
									<a class='post-img' href='blog-post2.php?Bid=" . $blogID . "'><img src='displayImg.php?img=" . $imgid . "'></a>
									<div class='post-body' style='overflow: hidden; height: 200px;'>
										<div class='post-category'>
											<a href='category.php?cn=".$row['category']."'>" . $row['category'] . "</a>
										</div>
										<h3 class='post-title'><a href='blog-post2.php?Bid=" . $blogID . "'>" . $row["title"] . "</a></h3>
										<ul class='post-meta'>
											<li><a href='author.php?author=".$username."'>" . $username . "</a></li>
											<li>" . $row["blogDate"] . "</li>
										</ul>
										<p>" . $row["blogText"] . "</p>
									</div>
								</div>";
                        } else {
													$backgroundImage = "";
													switch (strtolower($row['category'])) {
														case 'technology':
															$backgroundImage = "./img/Tech-3.jpg";
															break;
														case 'health':
															$backgroundImage = "./img/health-1.jpg";
															break;
														case 'travel':
															$backgroundImage = "./img/Travel-2.jpg";
															break;
															case 'food':
															$backgroundImage = "./img/Food-3.jpg";
																break;
														default:
															// code...
															break;
													}
                            echo "<div class='post post-row'>
									<a class='post-img' href='blog-post.php?Bid=" . $blogID . "'><img src='".$backgroundImage."'></a>
									<div class='post-body' style='overflow: hidden; height: 200px;'>
										<div class='post-category'>
											<a href='category.php?cn=".$row['category']."'>" . $row['category'] . "</a>
										</div>
										<h3 class='post-title'><a href='blog-post.php?Bid=" . $blogID . "'>" . $row["title"] . "</a></h3>
										<ul class='post-meta'>
											<li><a href='author.php?author=".$username."'>" . $username . "</a></li>
											<li>" . $row["blogDate"] . "</li>
										</ul>
										<p>" . $row["blogText"] . "</p>
									</div>
								</div>";
                        }
                    }
                }
                ?>
				</div>
				<div class="col-md-4" style="float: right;">
					<div class="">
						<h3 style="text-align: center;">Top Rated Blog</h3>
							<?php
								$query = "SELECT blogid, TRUNCATE(avgrate,2) avgrate
													from (
														select r.blogid, avg(rating) as avgrate
														from rating r, blog b
														where r.blogid = b.blogid and b.username = '$username'
														group by r.blogid
													) s
													where avgrate = (
														select max(avgrate)
														from (
															select r.blogid, avg(rating) as avgrate
															from rating r, blog b
        											where r.blogid = b.blogid and b.username = '$username'
															group by r.blogid
														) r
													)";
								if(mysqli_connect_errno())
						    die("Cannot connect to database.".mysqli_connect_errno());
								$result = mysqli_query($conf , $query);
								if(mysqli_num_rows($result) == 1){
									$highestRow = mysqli_fetch_assoc($result);
									$query2 = "SELECT * FROM BLOG WHERE blogID = ".$highestRow['blogid'];
									$blogResults = mysqli_query($conf , $query2);
									$highestBlogRow = mysqli_fetch_assoc($blogResults);
										echo "<div style='height: 100%; background-color: #EEEEEE; overflow: auto;     padding-bottom: 10px;'><br>
											<div class='post-body' style='float: left; width: 50%; border-right: 1px solid #DDDDDD; margin-left:25px'>
												<div class='post-category'>
													<a href='category.php?cn=".$highestBlogRow['category']."'>" . $highestBlogRow['category'] . "</a>
												</div>
												<h4 class='post-title'><a href='blog-post.php'>".$highestBlogRow["title"]."</a></h4>
												<ul class='post-meta'>
													<li><a href='author.php?author=".$username."'>" . $username . "</a></li>
													<li>".$highestBlogRow["blogDate"]."</li>
												</ul>
											</div>
											<div style='float: right; width: 40%'>
												<h4>Rating</h4>
												<br>
												<h3>".$highestRow['avgrate']." / 5</h3>
											</div>
										</div>";
								}
								else{
									echo "<p class='alert-danger' style='text-align: center'>There are no rated blogs!</p>";
								}
							?>
						<br>
					</div>
					<div class="">
						<br>
						<h3 style="text-align: center;">Most Commented Blog</h3>
							<?php
								$query = "SELECT c.blogid, count(*) com
													from comments c, blog b
													where c.blogid = b.blogid and b.username = '$username'
													group by c.blogid
													having com = (
														select max(comm)
														from (
															select count(*) comm
        											from comments c, blog b
															where c.blogid = b.blogid and b.username = '$username'
															group by c.blogid
														) s
													)";
								if(mysqli_connect_errno())
						    die("Cannot connect to database.".mysqli_connect_errno());
								$result = mysqli_query($conf , $query);
								if(mysqli_num_rows($result) > 0){
									while($highestRow = mysqli_fetch_assoc($result)){
										$query2 = "SELECT * FROM BLOG WHERE blogID = ".$highestRow['blogid'];
										$blogResults = mysqli_query($conf , $query2);
										$highestBlogRow = mysqli_fetch_assoc($blogResults);
										echo "<div style='height: 100%; background-color: #EEEEEE; overflow: auto; padding-bottom: 10px;'><br>
											<div class='post-body' style='float: left; width: 50%; border-right: 1px solid #DDDDDD; margin-left:25px'>
												<div class='post-category'>
													<a href='category.php?cn=".$highestBlogRow['category']."'>" . $highestBlogRow['category'] . "</a>
												</div>
												<h4 class='post-title'><a href='blog-post.php'>".$highestBlogRow["title"]."</a></h4>
												<ul class='post-meta'>
													<li><a href='author.php?author=".$username."'>" . $username . "</a></li>
													<li>".$highestBlogRow["blogDate"]."</li>
												</ul>
											</div>
											<div style='float: right; width: 40%; padding-top: 30px'>
												<h4>".$highestRow['com']." Comments</h4>
												<br>
											</div>
										</div>";
									}
								}else
                  echo "<p class='alert-danger' style='text-align: center'>There are no commented blogs!</p>"
							?>
						<br>
					</div>
				</div>
					<?php mysqli_close($conf); ?>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

		<!-- FOOTER -->
		<footer id="footer">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-3">
						<div class="footer-widget">
							<div class="footer-logo">
								<a href="index.php" class="logo"><img src="./img/bb1.png" alt=""></a>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<p>Beta Blogs is a project for SWE-381 Course, it's the connector between a blogger and a user.</p>
						<ul class="contact-social">
							<li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA" class="social-facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA" class="social-twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA" class="social-google-plus"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA" class="social-instagram"><i class="fa fa-instagram"></i></a></li>
						</ul>

					</div>
					<div class="col-md-3">
						<div class="footer-widget">
							<h3 class="footer-title">Categories</h3>
							<div class="tags-widget">
								<ul>
									<li><a href="category.php?cn=Technology">Technology</a></li>
									<li><a href="category.php?cn=Health">Health</a></li>
									<li><a href="category.php?cn=Travel">Travel</a></li>
			            <li><a href="category.php?cn=Food">Food</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="footer-widget">
							<h3 class="footer-title">Newsletter</h3>
							<div class="newsletter-widget">
								<form>
									<p>Put tour Email and recieve the news blogs before anyone else!</p>
									<input class="input" name="newsletter" placeholder="Enter Your Email">
									<button class="primary-button">Subscribe</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->

				<!-- row -->
				<div class="footer-bottom row">
					<div class="col-md-6 col-md-push-6">
						<ul class="footer-nav">
							<li><a href="index.php">Home</a></li>
							<li><a href="about.php">About Us</a></li>
							<li><a href="contact.php">Contacts</a></li>
						</ul>
					</div>
					<div class="col-md-6 col-md-pull-6">
						<div class="footer-copyright" style="width: 610px;">
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
	Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made By <br/> Omar Nassar, Nawaf Alothman, Abdulrahman Alhomoud, Abdulrahman Abuabat
	<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</footer>
		<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
