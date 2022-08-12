<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:signIn.php?error=Please sign in first");
}
$username = $_SESSION['username'];
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
                    <a href="index.html" class="logo"><img src="./img/logoBeta.png" alt=""></a>
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
                    echo "<h1 class='text-uppercase'>" . $username . "</h1>";
                    ?>
                    <p class="lead">Create your own Blog!</p>
                </div>
            </div>
        </div>
    </div>
    <!-- /PAGE HEADER -->

</header>
<!-- /HEADER -->
<!--CREATE BLOG-->
<div class="section">
    <div class="container">
        <div class="section-row">
            <?php
            if (isset($_GET['error'])) {
                echo "<h1 class='failed'>" . $_GET['error'] . "</h1>";
            }
            if (isset($_GET['success']))
                echo "<h1 class='succeed'>" . $_GET['success'] . "</h1>";
            ?>
            <div class="section-title">
                <h3 class="title">New Blog</h3>
            </div>
            <form class="post-reply" method="post" action="processCreate.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title" class="form-label">Blog's Title:</label>
                            <input type="text" name="title" maxlength="50" id="title" class="form-control"
                                   placeholder="Ex. Top 5 JavaScript courses" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="image" class="form-label">Images:</label>
                            <input class="form-control" type="file" id="image" name="userImage">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                                <label for="video" class="form-label">Videos:</label>
                                <input class="form-control" type="file" id="video" name="video">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="category" class="form-label">Category:</label>
                            <select class="form-select form-control" aria-label="Default select example" id="category"
                                    name="category" required>
                                <option value="food">Food</option>
                                <option value="technology">Technology</option>
                                <option value="health">Health</option>
                                <option value="travel">Travel</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="text" class="form-label">Blog Text:</label>
                            <textarea class="form-control" id="text" name="text" maxlength="2000" rows="12" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="primary-button">Create Blog</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--/CREATE BLOG-->

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
