<?php
session_start();

$isSignedIn = false;
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $isSignedIn = true;
}
include 'DB_CONFIG.php';
$con = mysqli_connect(DBHOST, DBUSER, DBPWD, DBNAME);
if (mysqli_connect_errno())
    die("Cannot connect to database." . mysqli_connect_errno());
$query = "Select * from BLOG where blogText like '%top1%'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$bid1 = $row['blogID'];
$title1 = $row['title'];
$text1 = $row['blogText'];
$imageid1 = $row['imageID'];
$author1 = $row['username'];
$category1 = $row['category'];
$date1 = $row['blogDate'];

$query = "Select * from BLOG where blogText like '%top2%'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$bid2 = $row['blogID'];
$title2 = $row['title'];
$text2= $row['blogText'];
$imageid2 = $row['imageID'];
$author2 = $row['username'];
$category2 = $row['category'];
$date2 = $row['blogDate'];

$query = "Select * from BLOG where blogText like '%top3%'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$bid3 = $row['blogID'];
$title3 = $row['title'];
$text3 = $row['blogText'];
$imageid3 = $row['imageID'];
$author3 = $row['username'];
$category3 = $row['category'];
$date3 = $row['blogDate'];



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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
</header>
<!-- /HEADER -->
<?php
if (isset($_GET['error']))
    echo "<div class='alert alert-danger' role='alert'>" . $_GET['error'] . "</div>";
if (isset($_GET['success']))
    echo "<div class='alert alert-success' role='alert'>" . $_GET['success'] . "</div>"; ?>
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div id="hot-post" class="row hot-post">
            <div class="col-md-8 hot-post-left">
                <!-- post -->
                <div class="post post-thumb">
                    <a class="post-img" href="blog-post.php?Bid=<?php echo $bid1 ?>"><img src="displayImg.php?img=<?php echo $imageid1 ?>" alt=""></a>
                    <div class="post-body">
                        <div class="post-category">
                            <a href="category.php?cn=<?php echo $category1 ?>"><?php echo $category1 ?></a>
                        </div>
                        <h3 class="post-title title-lg"><a href="blog-post.php?Bid=<?php echo $bid1 ?>"><?php echo $title1 ?></a></h3>
                        <ul class="post-meta">
                            <li><a href="author.php?author=<?php echo $author1 ?>"><?php echo $author1 ?></a></li>
                            <li><?php echo $date1 ?></li>
                        </ul>
                    </div>
                </div>
                <!-- /post -->
            </div>
            <div class="col-md-4 hot-post-right">
                <!-- post -->
                <div class="post post-thumb">
                    <a class="post-img" href="blog-post.php?Bid=<?php echo $bid2 ?>"><img src="displayImg.php?img=<?php echo $imageid2 ?>" alt=""></a>
                    <div class="post-body">
                        <div class="post-category">
                            <a href="category.php?cn=<?php echo $category2 ?>"><?php echo $category2 ?></a>
                        </div>
                        <h3 class="post-title"><a href="blog-post.php?Bid=<?php echo $bid2 ?>"><?php echo $title2 ?></a></h3>
                        <ul class="post-meta">
                            <li><a href="author.php?author=<?php echo $author2?>"><?php echo $author2?></a></li>
                            <li><?php echo $date2?></li>
                        </ul>
                    </div>
                </div>
                <!-- /post -->

                <!-- post -->
                <div class="post post-thumb">
                    <a class="post-img" href="blog-post.php?Bid=<?php echo $bid3 ?>"><img src="displayImg.php?img=<?php echo $imageid3 ?>" alt=""></a>
                    <div class="post-body">
                        <div class="post-category">
                            <a href="category.php?cn=<?php echo $category3 ?>"><?php echo $category3 ?></a>
                        </div>
                        <h3 class="post-title"><a href="blog-post.php?Bid=<?php echo $bid3 ?>"><?php echo $title3 ?></a></h3>
                        <ul class="post-meta">
                            <li><a href="author.php?author=<?php echo $author3?>"><?php echo $author3?></a></li>
                            <li><?php echo $date3?></li>
                        </ul>
                    </div>
                </div>
                <!-- /post -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-8">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2 class="title">Recent Blogs</h2>
                        </div>
                    </div>
                    <?php
                    $query = 'SELECT * FROM BLOG ORDER BY blogid DESC';
                    $result = mysqli_query($con, $query);
                    if(!$result){
                        die('not result');
                    }
                    $i = 0;
                    while($row = mysqli_fetch_array($result)) {
                        //$row = mysqli_fetch_array($result);
                        if ($i < 4) {
                            $imgid = $row['imageID'];
                            if ($imgid > 0) {
                                echo "<div class='col-md-6'>
												<div class='post'>
													<a class='post-img' href='blog-post2.php?Bid=" . $row['blogID'] . "'><img src='displayImg.php?img=" . $imgid . "'></a>
													<div class='post-body'>
														<div class='post-category'>
															<a href='category.php?cn=" . $row['category'] . "'>" . $row['category'] . "</a>
														</div>
														<h3 class='post-title'><a href='blog-post2.php?Bid=" . $row['blogID'] . "'>" . $row['title'] . "</a></h3>
														<ul class='post-meta'>
															<li><a href='author.php?author=" . $row['username'] . "'>" . $row['username'] . "</a></li>
															<li>" . $row['blogDate'] . "</li>
														</ul>
													</div>
												</div>
											</div>";
                                $i++;
                            } else {
                                $Image = " ";
                                switch (strtolower($row['category'])) {
                                    case 'technology':
                                        $Image = "./img/Tech-3.jpg";
                                        break;
                                    case 'health':
                                        $Image = "./img/health-1.jpg";
                                        break;
                                    case 'travel':
                                        $Image = "./img/Travel-2.jpg";
                                        break;
                                    case 'food':
                                        $Image = "./img/Food-3.jpg";
                                        break;
                                    default:
                                        // code...
                                        break;
                                }
                                echo "<div class='col-md-6'>
												<div class='post'>
													<a class='post-img' href='blog-post2.php?Bid=" . $row['blogID'] . "'><img src='" . $Image . "'></a>
													<div class='post-body'>
														<div class='post-category'>
															<a href='category.php?cn=" . $row['category'] . "'>" . $row['category'] . "</a>
														</div>
														<h3 class='post-title'><a href='blog-post2.php?Bid=" . $row['blogID'] . "'>" . $row['title'] . "</a></h3>
														<ul class='post-meta'>
															<li><a href='author.php?author=" . $row['username'] . "'>" . $row['username'] . "</a></li>
															<li>" . $row['blogDate'] . "</li>
														</ul>
													</div>
												</div>
											</div>";
                                $i++;
                            }
                            if($i == 0 || $i == 2){
                                echo "<div class='clearfix visible-md visible-lg'></div>";
                            }
                        }else
                            break;
                    }
                    ?>
                    <!-- post
                    <div class='col-md-6'>
                        <div class='post'>
                            <a class='post-img' href='blog-post.php'><img src='./img/health-2.jpg' alt=''></a>
                            <div class='post-body'>
                                <div class='post-category'>
                                    <a href='category.php'>Health</a>
                                </div>
                                <h3 class='post-title'><a href='blog-post.php'>Kids Health, Is it important?</a></h3>
                                <ul class='post-meta'>
                                    <li><a href='author.php'>Ahmad Abdulrahman</a></li>
                                    <li>03 May 2022</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                     /post -->
                </div>
                <!-- /row -->


            </div>
            <div class="col-md-4">
                <!-- ad widget-->
                <div class="aside-widget text-center">
                    <a href="author.php" style="display: inline-block;margin: auto;">
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
