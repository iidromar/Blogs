<?php
session_start();
include 'DB_CONFIG.PHP';
$conf = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
$search = "";
if (!isset($_POST['search'])) {
    //header();
}
$search = $_POST['search'];
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
                        <form method="post" id="" action="search.php">
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


</header>
<div class="container">
    <div class="row">

        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php
            //$userCheckQuery = "SELECT * FROM blog WHERE  blogText= '%$search%'";
            $userCheckQuery = "select * from blog where blogText like '%" . $search . "%'
or title like '%" . $search . "%'";
            $result = mysqli_query($conf, $userCheckQuery);
            if (!$result)
                die("<p>error</p>");
                if (mysqli_num_rows($result) > 0) {
                  echo '<br><h4 style="text-align: center";">This is the result for "'.$search.'": </h4><br>';
                    while ($row = mysqli_fetch_assoc($result)) {
                    //for($i = 0; $i < mysqli_num_rows($result); $i++){
                        //$row = mysqli_fetch_assoc($result);
                        $blogID = $row['blogID'];
                        $imgid = $row['imageID'];
                        $title = $row['title'];
                        if ($imgid > 0) {
                            echo "<div class='post post-row'>
                  <a class='post-img' href='blog-post2.php?Bid=" . $blogID . "'><img src='displayImg.php?img=" . $imgid . "'></a>
                  <div class='post-body' style='overflow: hidden; height: 200px;'>
                    <div class='post-category'>
                      <a href='category.php?cn=".$row['category']."'>" . $row['category'] . "</a>
                    </div>
                    <h3 class='post-title'><a href='blog-post2.php?Bid=" . $blogID . "'>" . $row["title"] . "</a>    <a href='editBlog.php?Bid=" . $blogID . "'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>        <a href='#' onclick='ConfirmDelete(".$blogID.")'><i class='fa fa-trash-o'></i></a></h3>
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
                    <h3 class='post-title'><a href='blog-post.php?Bid=" . $blogID . "'>" . $row["title"] . "</a> <a href='editBlog.php?Bid=" . $blogID . "'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>    <a href='#' onclick='ConfirmDelete(".$blogID.")'><i class='fa fa-trash-o'></i></a></h3>
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
                else{
                  echo '<br><h4 style="text-align: center";">There is no result for "'.$search.'": </h4><br>';
                }
            ?>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>

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
