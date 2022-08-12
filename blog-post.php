<?php
    session_start();
    if(isset($_SESSION['username']) && isset($_GET['Bid']))
         header('Location:blog-post2.php?Bid='.$_GET['Bid'].'');
    if(!isset($_GET['Bid'])){
        header('location:index.php?error=There was no Bid in URL!');
    }
    $Bid = $_GET['Bid'];
include 'DB_CONFIG.php';
$con = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
if (mysqli_connect_errno())
    die("Cannot connect to database." . mysqli_connect_errno());
$query = 'SELECT * FROM BLOG WHERE BLOGID = ' . $Bid;
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$row1 = mysqli_fetch_assoc($result);
$username = $row['username'];
$title = $row['title'];
$bloggerName = $row['username'];
$text = $row['blogText'];
$category = $row['category'];
$bdate = $row['blogDate'];

$imgID = $row['imageID'];
$vidid = $row['videoID'];
if($vidid != ''){
    $query = "SELECT name FROM VIDEO WHERE id = '" . $vidid."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $vidname = $row['name'];
}
/*
$query = 'SELECT BLOGDATE FROM BLOG WHERE BLOGID = '.$Bid;
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array('');*/


$query = 'SELECT COUNT(*) AS NUM FROM COMMENTS WHERE blogID = ' . $Bid;
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$numOfComments = $row['NUM'];
$isSignedIn = false;
if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];
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
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</head>

<body>
<!-- HEADER -->
<header id="header">
    <!-- NAV -->
    <div id="nav">
        <!-- Top Nav -->
        <div id="nav-top">
            <div class="container">
                <!-- social -->
                <ul class="nav-social">
                    <li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA"><i
                                    class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA"><i
                                    class="fa fa-twitter"></i></a></li>
                    <li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA"><i
                                    class="fa fa-google-plus"></i></a></li>
                    <li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA"><i
                                    class="fa fa-instagram"></i></a></li>
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
                        <form method="post" action="search.php">
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
    <?php
    if (isset($_GET['error']))
        echo "<div class='alert alert-danger' role='alert'>" . $_GET['error'] . "</div>";
    if (isset($_GET['success']))
        echo "<div class='alert alert-success' role='alert'>" . $_GET['success'] . "</div>"; ?>
		<!-- PAGE HEADER -->
	<div id="post-header" class="page-header">
        <div class="page-header-bg" style="background-image: url('displayImg.php?img=<?php echo $imgID ?>');"
             data-stellar-background-ratio="0.5"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-10">
                    <div class="post-category">
                        <a href="category.php?cn=<?php echo $category; ?>"><?php echo $category; ?></a>
                    </div>
                    <h1><?php echo $title; ?></h1>
                    <ul class="post-meta">
                        <li><a href="author.php?username=<?php echo $username; ?>"><?php echo $username; ?></a></li>
                        <li><?php echo $bdate; ?></li>
                        <li><i class="fa fa-comments"></i><?php echo $numOfComments; ?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- /PAGE HEADER -->
	</header>
	<!-- /HEADER -->


	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-8">
					<!-- post share -->
					<div class="section-row">
						<div class="post-share">
							<a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA" class="social-facebook"><i class="fa fa-facebook"></i><span>Share</span></a>
							<a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA" class="social-twitter"><i class="fa fa-twitter"></i><span>Tweet</span></a>
							<a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA" class="social-pinterest"><i class="fa fa-pinterest"></i><span>Pin</span></a>
							<a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA" ><i class="fa fa-envelope"></i><span>Email</span></a>
						</div>
					</div>
					<!-- /post share -->

                    <!-- post content -->
                    <div class="section-row">
                        <h3><?php echo $title; ?></h3>
                        <p><?php echo $text; ?></p>




                        <!-- /post content -->

                        <!-- post tags -->
                        <div class="section-row">
                            <div class="post-tags">
                                <ul>
                                    <li>TAG:</li>

                                    <li><a href="#"><?php echo $category; ?></a></li>

                                </ul>
                            </div>
                        </div>
                        <!-- /post tags -->

                        <!-- post nav -->
                        <!--<div class="section-row">
                            <div class="post-nav">
                                <div class="prev-post">
                                    <a class="post-img" href="blog-post.php"><img src="./img/food-1.jpg" alt=""></a>
                                    <h3 class="post-title"><a href="#">Sed ut perspiciatis, unde omnis iste natus error sit</a>
                                    </h3>
                                    <span>Previous post</span>
                                </div>

                                <div class="next-post">
                                    <a class="post-img" href="blog-post.php"><img src="./img/food-3.jpg" alt=""></a>
                                    <h3 class="post-title"><a href="#">Postea senserit id eos, vivendo periculis ei qui</a></h3>
                                    <span>Next post</span>
                                </div>
                            </div>
                        </div>-->
                        <!-- /post nav  -->

                        <?php if($imgID != ''){echo
                            '<div class="section-row">
                        <div class="section-title">
                            <h3 class="title">Blog Image</h3>
                        </div>
                        <div class="media-middle">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8" style="top:5px">
                                        <div class="post-img">
                                            <figure><img src="displayImg.php?img='.$imgID.'" alt=""></figure>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>';
                        } ?>


                        <?php if($vidid != ''){echo
                            '<div class="section-row">
                        <div class="section-title">
                            <h3 class="title">Blog Video</h3>
                        </div>
                        <div class="media-middle">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe src="videos/'.$vidname.'" frameborder="0"
                                                    allowfullscreen></iframe>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>';
                        } ?>

                        <!-- post author -->
                        <div class="section-row">
                            <div class="section-title">
                                <h3 class="title">Blog Author</h3>
                            </div>
                            <div class="author media">
                                <!--<div class="media-left">
                                    <a href="author.php">
                                        <img class="author-img media-object" src="./img/person.jpg" alt="">
                                    </a>
                                </div>-->
                                <div class="media-body">
                                    <p class="text-uppercase"><a
                                                href="author.php?author=<?php echo $bloggerName; ?>"><?php echo $bloggerName; ?></a>
                                    </p>

                                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    <ul class="author-social">
                                        <li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA"><i
                                                        class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA"><i
                                                        class="fa fa-twitter"></i></a></li>
                                        <li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA"><i
                                                        class="fa fa-google-plus"></i></a></li>
                                        <li><a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA"><i
                                                        class="fa fa-instagram"></i></a></li>
                                    </ul>-->
                                </div>
                            </div>
                        </div>
                        <!-- /post author -->

                        <div class="section-row">
                            <div class="section-title">
                                <h3 class="title">Rate The Blog</h3>
                            </div>
                            <form action="rate.php?Bid=<?php echo $Bid; ?>" method="post">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="rate" class="form-label">Out of 5 stars</label>
                                                <select class="form-select form-control" aria-label="Default select example"
                                                        name="rate" id="rate">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5" selected>5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button class="disabled" disabled>Rate</button>
                                            </div>
                                                <p class="alert-info">You nead to log in first</p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- post comments -->
                        <div class="section-row">
                            <div class="section-title">
                                <?php
                                echo "<h3 class='title'>" . $numOfComments . " Comments</h3>";
                                ?>

                            </div>
                            <?php
                            if ($numOfComments > 0) {
                                echo "<div class='post-comments'>";
                                $query = 'SELECT * FROM COMMENTS WHERE BLOGID = ' . $Bid;
                                $result = mysqli_query($con, $query);
                                //for($i = 0; $i < $numOfComments; $i++) {
                                while ($row = mysqli_fetch_array($result)) {
                                    //$row = mysqli_fetch_array($result);
                                    if ($row['replyFor'] == null) {
                                        echo "<div class='media'>
                                <div class='media-left'><h4>" . $row['username'] . "</h4></div>
                                <div class='media-body'><p>" . $row['commentText'] . "</p></div>
                                <button id = " . $row['commentID'] . " onclick='showReply(" . $row['commentID'] . ")' class='reply btn'>Reply</button>
                                <a href='reply.php?comid='" . $row['commentID'] . " class='reply'>Reply</a>
                                </div>";
                                    }
                                }
                                echo "</div>";
                            }
                            ?>
                            <!--
                            <div class="post-comments">
                                 comment
                                <div class="media">
                                    <div class="media-author">
                                        <h4>ALI</h4>
                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <h4>Ali</h4>
                                            <span class="time">5 min ago</span>
                                        </div>
                                        <p>TEXT</p>
                                        <a href="reply.php?comid=" class="reply">Reply</a>

                                        <div class="media media-author">
                                            <div class="media-left">
                                                <h4>ALI</h4>
                                            </div>
                                            <div class="media-body">

                                                <p>TEXT</p>
                                                <a href="#" class="reply">Reply</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                 /comment -->

                            <!-- comment
                            <div class="media">
                                <div class="media-left">
                                    <img class="media-object" src="./img/person.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <h4>John Doe</h4>
                                        <span class="time">5 min ago</span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    <a href="#" class="reply">Reply</a>
                                </div>
                            </div>
                            /comment -->
                        </div>
                    </div>
                    <!-- /post comments -->

                    <!-- post reply -->
					<div class="section-row">
						<div class="section-title">
							<h3 class="title">Leave a reply</h3>
						</div>
						<form class="post-reply">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<textarea class="input" name="message" placeholder="Message"></textarea>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input class="input" type="text" name="name" placeholder="Name">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input class="input" type="email" name="email" placeholder="Email">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input class="input" type="text" name="website" placeholder="Website">
									</div>
								</div>
                                <div class="form-group">
								<div class="col-md-12">
									<button class="disabled" disabled>Submit</button>
								</div>
                                </div>
							</div>
						</form>
					</div>
                                <p class="alert-info">You nead to log in first</p>
					<!-- /post reply -->
				</div>
				<div class="col-md-4">
					<!-- ad widget -->
					<div class="aside-widget text-center">
						<a href="#" style="display: inline-block;margin: auto;">
							<img class="img-responsive" src="./img/getRated.png" alt="">
						</a>
					</div>
					<!-- /ad widget -->

					<!-- social widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Social Media</h2>
						</div>
						<div class="social-widget">
							<ul>
								<li>
									<a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA" class="social-facebook">
										<i class="fa fa-facebook"></i>
										<span>21.2K<br>Followers</span>
									</a>
								</li>
								<li>
									<a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA" class="social-twitter">
										<i class="fa fa-twitter"></i>
										<span>10.2K<br>Followers</span>
									</a>
								</li>
								<li>
									<a href="https://twitter.com/swe_omar?s=21&t=BxzCdzNV1Ujndmy6LVA4DA" class="social-google-plus">
										<i class="fa fa-google-plus"></i>
										<span>5K<br>Followers</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- /social widget -->



					<!-- newsletter widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Newsletter</h2>
						</div>
						<div class="newsletter-widget">
							<form>
								<p>get our blogs before anyone else!</p>
								<input class="input" placeholder="Enter Your Email">
								<button class="primary-button">Subscribe</button>
							</form>
						</div>
					</div>
					<!-- /newsletter widget -->





					<!-- Ad widget -->
					<div class="aside-widget text-center">
						<a href="#" style="display: inline-block;margin: auto;">
							<img class="img-responsive" src="./img/getRated.png" alt="">
						</a>
					</div>
					<!-- /Ad widget -->
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
